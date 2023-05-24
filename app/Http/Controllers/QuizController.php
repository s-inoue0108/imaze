<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Quiz;
use App\Models\Status;
use App\Models\Correct;
use App\Models\Bookmark;
use Illuminate\Http\Request;

// Carbon
use Carbon\Carbon;

// Authファサード
use Illuminate\Support\Facades\Auth;

// Storageファサード
use Illuminate\Support\Facades\Storage;

// Httpファサード
use Illuminate\Support\Facades\Http;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Carbonインスタンス（現在時刻）
        $now = new Carbon();
        
        // 全ユーザー数
        $user_counts = User::count() - 1;

        // 掲出期限内の投稿を取得
        $quizzes = Quiz::with(['user.status', 'corrects', 'bookmarks'])->where('deadline', '>=', $now)->latest()->paginate(12);

        return view('quiz.index', compact('quizzes', 'now', 'user_counts')); //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quiz.create'); //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Carbonインスタンス（現在時刻）
        $now = new Carbon();

        // 新しく投稿されたクイズのインスタンス
        $quiz = new Quiz();

        // ユーザーidと名前をQuizzesテーブルへ保存
        $user_id = Auth::id();
        $quiz->user_id = $user_id;

        // タイトル，答え，説明のバリデーション配列を作成
        $validated = $request->validate([
            'title' => 'required|max:20',
            'answer' => 'required|max:20',
            'explanation' => 'max:200',
        ]);

        // タイトル，答え，説明をQuizzesテーブルへ保存
        $quiz->title = $validated['title'];
        $quiz->answer = $validated['answer'];
        $quiz->explanation = $validated['explanation'];

        // クイズの掲出期限をQuizzesテーブルへ保存
        if ($request->deadline === 'one_day') {

            $deadline = $now->addDay(1);

        }else if ($request->deadline === 'three_days') {

            $deadline = $now->addDay(3);

        }else if ($request->deadline === 'one_week') {

            $deadline = $now->addDay(7);
            
        }else if ($request->deadline === 'two_weeks') {

            $deadline = $now->addDay(14);

        }else {

            $deadline = $now->addMonth(1);

        }
        
        $quiz->deadline = $deadline;

        // 画像をStorageへ保存
        $image_name = $request->file('image')->getClientOriginalName();
        $image = $request->file('image');
        Storage::disk('public')->putFileAs('images', $image, $image_name);

        // 画像の情報をQuizzesテーブルへ保存
        $quiz->image_name = $image_name;
        $quiz->image_path = '/storage/images/' . $image_name;

        // Quizzesテーブルへ保存
        $quiz->save();

        // Status number_of_postsを+1する
        $status = Status::where('id', $user_id)->first();
        $status->number_of_posts = $status->value('number_of_posts') + 1;
        $status->save();

        return redirect()->route('quiz.index'); //
    }

    // gpt-3.5-turbo
    public function gpt($system, $user)
    {
        // Endpoint URL
        $url = "https://api.openai.com/v1/chat/completions";

        // APIキー
        $api_key = env('CHAT_GPT_KEY');

        // ヘッダー
        $headers = array(
            "Content-Type" => "application/json",
            "Authorization" => "Bearer $api_key"
        );

        // パラメータ
        $data = array(
            "model" => "gpt-3.5-turbo",
            "messages" => [
                [
                    "role" => "system",
                    "content" => $system
                ],
                [
                    "role" => "user",
                    "content" => $user
                ]
            ]
        );

        $response = Http::withHeaders($headers)->post($url, $data);

        if ($response->json('error')) {
            // エラー
            return $response->json('error')['message'];
        }

        return $response->json('choices')[0]['message']['content'];
    }

    public function generate(Request $request)
    {
        $question = $request->question;

        // gpt-turbo-3.5にthrow
        $gpt_response = $this->gpt("すべての内容について，日本語で応答してください．", $question);

        if (mb_strpos($gpt_response, 'クイズ：') !== false && mb_strpos($gpt_response, '解答：') !== false && mb_strpos($gpt_response, '解説：') !== false) {

            // 文字列の位置
            $sentence_pos = mb_strpos($gpt_response, 'クイズ：');
            $solution_pos = mb_strpos($gpt_response, '解答：');
            $explanation_pos = mb_strpos($gpt_response, '解説：');

            // フラグメント
            $sentence_fragment = mb_strstr($gpt_response, 'クイズ：');
            $solution_fragment = mb_strstr($gpt_response, '解答：');
            $explanation_fragment = mb_strstr($gpt_response, '解説：');

            // 文字列を切り出し
            $sentence = mb_substr($sentence_fragment, 4, $solution_pos-4);
            $solution = mb_substr($solution_fragment, 3, $explanation_pos-$solution_pos-3);
            $explanation = mb_substr($explanation_fragment, 3);

            // Carbonインスタンス（現在時刻）
            $now = new Carbon();

            // 新しく投稿されたクイズのインスタンス
            $quiz = new Quiz();

            // 自動生成されたことを明記
            $quiz->automaticity = 'true';

            // ユーザーidと名前をQuizzesテーブルへ保存
            $user_id = Auth::id();
            $quiz->user_id = $user_id;

            // タイトル，答え，説明をQuizzesテーブルへ保存
            $quiz->title = $sentence;
            $quiz->answer = $solution;
            $quiz->explanation = $explanation . '（ChatGPTによる自動生成）';

            // 掲出期限
            $deadline = $now->addDay(1);
            $quiz->deadline = $deadline;

            // 画像の情報をQuizzesテーブルへ保存
            $image_name = 'openai-logomark.png';
            $quiz->image_name = $image_name;
            $quiz->image_path = '/storage/logo/' . $image_name;

            // Quizzesテーブルへ保存
            $quiz->save();

            return redirect()->route('quiz.index');

        }else {

            return back()->with('err_mes', 'クイズの生成に失敗しました．後ほどお試しください．');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        // 該当の投稿を取得
        $post = Quiz::find($quiz->id);

        // 該当の投稿のブックマーク情報を削除
        $bookmark = Bookmark::where('quiz_id', $quiz->id)->get();

        if ($bookmark->count() !== 0) {
            $bookmark->each->delete();
        }

        // 該当の投稿の画像を削除
        if ($post->automaticity !== 'true') {
            Storage::disk('public')->delete('images/' . $post->image_name);
        }

        // 該当の投稿を削除
        $post->delete();
        
        return back();//
    }

    public function answer(Request $request)
    {
        // 認証しているユーザのid
        $user_id = Auth::id();

        // クイズのidと解答をAjaxから取得
        $quiz_id = $request->get('quiz_id');
        $solution = $request->get('solution');

        // クイズの正解をQuizzesテーブルから取得
        $answer = Quiz::find($quiz_id)->answer;

        // Carbonインスタンス（現在時刻）
        $now = new Carbon();

        // クイズの掲出期限をQuizzesテーブルから取得
        $deadline = Quiz::find($quiz_id)->deadline;

        // このクイズに正答者がいるか（真偽値）
        $cor_user_exists = Correct::where('quiz_id', $quiz_id)->exists();

        // リクエストしたユーザはこのクイズを正答しているか（真偽値）
        $cor_ans_exists = Correct::where('quiz_id', $quiz_id)->where('user_id', $user_id)->exists();

        // 正誤判定，および期限を過ぎたクイズへの解答をエスケープ
        if ($now > $deadline) {

            $message = "このクイズへの解答は締め切られています";

        }else if ($solution == $answer) {

            $message = "正解！";

            // Correctsテーブルにクイズのidと正解者のidを登録
            $correct = new Correct();
            $correct->quiz_id = $quiz_id;
            $correct->user_id = $user_id;
            $correct->save();

            // 正解したユーザのStatus
            $status = Status::where('id', $user_id)->first();

            // もし先の正答者が存在していなかったら，Status number_of_topを+1する
            if ($cor_user_exists === false) {
                $status->number_of_top = $status->value('number_of_top') + 1;

                $message = "あなたが最初の正解者です！";
            }

            // もし先の正答のレコードが存在していなかったら，Status number_of_correctsを+1する
            if ($cor_ans_exists === false) {
                $status->number_of_corrects = $status->value('number_of_corrects') + 1;
            }

            // Statusesテーブルに登録
            $status->save();

        }else {

            $message = "不正解";

        }

        // jsonで渡すデータ
        $json = [
            'quiz_id' => $quiz_id,
            'message' => $message,
            'now' => $now,
        ];

        return response()->json($json); //
    }

    public function bookmark(Request $request) {

        // 認証しているユーザのid
        $user_id = Auth::id();

        // ブックマークするクイズのidをAjaxから取得
        $quiz_id = $request->get('quiz_id');

        // Bookmarksテーブルにクイズのidとリクエストユーザのidを登録
        $bookmark_exists = Bookmark::where('user_id', $user_id)->where('quiz_id', $quiz_id)->exists();

        if ($bookmark_exists === false) {
            $bookmark = new Bookmark();
            $bookmark->user_id = $user_id;
            $bookmark->quiz_id = $quiz_id;
            $bookmark->save();
        }

        // jsonで渡すデータ
        $json = [
            'quiz_id' => $quiz_id,
        ];

        return response()->json($json);
    }
}
