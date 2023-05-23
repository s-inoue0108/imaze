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

class StatusController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }//

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

        return view('quiz/myposts', compact('quizzes')); //
    }

    public function bookmarks()
    {
        // Carbonインスタンス（現在時刻）
        $now = new Carbon();
        
        // ブックマークされた投稿を取得
        $bookmarks = Bookmark::with(['quiz', 'quiz.corrects'])->where('user_id', Auth::id())->latest()->paginate(12);

        return view('quiz/bookmarks', compact('bookmarks', 'now')); //
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
        $quizzes = Quiz::with(['user.status', 'corrects', 'bookmarks'])->latest()->paginate(30);

        return view('admin', compact('now', 'all_users', 'all_posts', 'all_corrects', 'all_bookmarks', 'quizzes'));
    }
}
