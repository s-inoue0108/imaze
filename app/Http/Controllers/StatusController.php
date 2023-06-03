<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Quiz;
use App\Models\Status;
use App\Models\Correct;
use App\Models\Bookmark;
use App\Models\Notice;
use Illuminate\Http\Request;

// Carbon
use Carbon\Carbon;

// Authファサード
use Illuminate\Support\Facades\Auth;

// Storageファサード
use Illuminate\Support\Facades\Storage;

class StatusController extends Controller
{
    public function dashboard()
    {
        // 最新のおしらせを取得
        $notice = Notice::latest()->first();

        return view('dashboard', compact('notice'));
    } //

    public function icon(Request $request, $icon_id)
    {

        // 古いアイコンのデータをStatusesテーブルから取得し，デフォルトアイコンでなければ削除
        $icon_old = Status::find($icon_id);

        if ($icon_old->icon_name != 'default_icon.png') {
            Storage::disk('public')->delete('icons/' . $icon_old->icon_name);
        }

        // 新しいアイコンをStorageへ保存
        $icon_name = $request->file('icon')->getClientOriginalName();
        $icon = $request->file('icon');
        Storage::disk('public')->putFileAs('icons', $icon, $icon_name);

        // Statusesテーブルを更新
        $icon_old->update([
            'icon_name' => $icon_name,
            'icon_path' => '/storage/icons/' . $icon_name,
        ]);

        return redirect()->route('dashboard');
    }

    public function myposts()
    {
        // 自分の投稿（自動投稿除く）を取得
        $quizzes = Quiz::with('user.status')->where('user_id', Auth::id())->whereNull('automaticity')->latest()->paginate(12);
        
        // 全ユーザー数
        $user_counts = User::count() - 1;

        return view('quiz/myposts', compact('quizzes', 'user_counts')); //
    }

    public function bookmarks()
    {
        // Carbonインスタンス（現在時刻）
        $now = new Carbon();
        
        // 全ユーザー数
        $user_counts = User::count() - 1;
        
        // ブックマークされた投稿を取得
        $bookmarks = Bookmark::with(['quiz', 'quiz.corrects'])->where('user_id', Auth::id())->latest()->paginate(12);

        return view('quiz/bookmarks', compact('bookmarks', 'now', 'user_counts')); //
    }

    public function ranking(Request $request)
    {
        // Carbonインスタンス（現在時刻）
        $now = new Carbon();

        // ソート条件を取得
        $sort = $request->sort;

        // ぺジネーションのカットオフ値
        $onepage = 30;

        if ($sort === 'corrects') {

            // ランキング（正解数）
            $ranks = Status::with('user')->orderBy('number_of_corrects', 'desc')->paginate($onepage);
            // ランキングヘッダー
            $header_column = '正解数';

        }else if ($sort === 'posts') {
            
            // ランキング（投稿数）
            $ranks = Status::with('user')->orderBy('number_of_posts', 'desc')->paginate($onepage);
            // ランキングヘッダー
            $header_column = '投稿数';

        }else {

            // ランキング（トップ数）
            $ranks = Status::with('user')->orderBy('number_of_top', 'desc')->paginate($onepage);
            // ランキングヘッダー
            $header_column = 'トップ数';
        }

        return view('quiz.ranking', compact('ranks', 'header_column', 'now', 'onepage'));
    }

    public function admin()
    {
        // Carbonインスタンス（現在時刻）
        $now = new Carbon();

        // 総ユーザー数
        $all_users = User::count();

        // 総投稿数
        $all_posts = Quiz::count();

        // 総正解数
        $all_corrects = Correct::count();

        // 総ブックマーク数
        $all_bookmarks = Bookmark::count();

        // すべての投稿を取得
        $quizzes = Quiz::with(['user.status', 'corrects', 'bookmarks'])->latest()->paginate(12);

        // 最新のおしらせを取得
        $notice = Notice::latest()->first();

        return view('admin', compact('now', 'all_users', 'all_posts', 'all_corrects', 'all_bookmarks', 'quizzes', 'notice'));
    }

    public function notice(Request $request)
    {
        // Carbonインスタンス（現在時刻）
        $now = new Carbon();

        // バリデーション配列を作成
        $validated = $request->validate([
            'notice_1' => 'max:200',
            'notice_1_title' => 'max:20',
            'notice_2' => 'max:200',
            'notice_2_title' => 'max:20',
            'notice_3' => 'max:200',
            'notice_3_title' => 'max:20',
        ]);

        // Noticeインスタンス
        $notice = new Notice();

        // Noticesテーブルへ保存
        $notice->notice_1 = $validated['notice_1'];
        $notice->notice_1_title = $validated['notice_1_title'];
        $notice->notice_2 = $validated['notice_2'];
        $notice->notice_2_title = $validated['notice_2_title'];
        $notice->notice_3 = $validated['notice_3'];
        $notice->notice_3_title = $validated['notice_3_title'];

        $notice->save();

        return redirect()->route('dashboard');

    }

    public function post_notice(Request $request)
    {
        // Status post_noticeを更新
        $status = Status::where('user_id', Auth::id());

        $status->update([
            'post_notice' => $request->post_notice,
        ]);

        return redirect()->route('profile.edit');
    }
}
