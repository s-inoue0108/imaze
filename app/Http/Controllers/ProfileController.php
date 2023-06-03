<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\Status;
use App\Models\Bookmark;
use App\Models\Quiz;
use App\Models\Correct;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $post_notice_status = Status::where('user_id', Auth::id())->first()->post_notice;

        return view('profile.edit', [
            'user' => $request->user(),
            'post_notice_status' => $post_notice_status,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        // ユーザーid
        $user_id = Auth::id();

        // Statusesテーブルから該当の行と，画像データを削除
        $status = Status::where('user_id', $user_id)->first();

        if ($status->icon_name !== 'default_icon.png') {
            Storage::disk('public')->delete('icons/' . $status->icon_name);
        }
        
        $status->forceDelete();

        // Bookmarksテーブルから該当の行を削除
        $bookmark = Bookmark::where('user_id', $user_id)->get();
        if ($bookmark->count() !== 0) {
            $bookmark->each->forceDelete();
        }

        // Correctsテーブルから該当の行を削除
        $correct = Correct::where('user_id', $user_id)->get();
        if ($correct->count() !== 0) {
            $correct->each->delete();
        }

        // Quizzesテーブルから該当の行を削除
        $quiz = Quiz::where('user_id', $user_id)->get();
        if ($quiz->count() !== 0) {
            $quiz->each->delete();
        }

        $user = $request->user();

        Auth::logout();

        $user->forceDelete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
