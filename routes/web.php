<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* !!! Varidated Pages !!! */

Route::middleware(['auth', 'verified'])->group(function() {

    // Quiz Resource Controller
    Route::resource('quiz', QuizController::class)->except(['show', 'edit', 'update']);

    // Dashboard Page
    Route::get('/dashboard', [StatusController::class, 'dashboard'])->name('dashboard');

    // Myposts Page
    Route::get('myposts', [StatusController::class, 'myposts'])->name('myposts');

    // Bookmarks Page
    Route::get('bookmarks', [StatusController::class, 'bookmarks'])->name('bookmarks');

    // Ranking Page
    Route::get('ranking', [StatusController::class, 'ranking'])->name('ranking');

    // Answer
    Route::post('quiz/answer/{quiz_id}', [QuizController::class, 'answer'])->name('quiz.answer');

    // Automatic Generate Powered by gpt-3.5-turbo
    Route::post('quiz/generate', [QuizController::class, 'generate'])->name('quiz.generate');

    // Bookmark
    Route::post('quiz/bookmark/{quiz_id}', [QuizController::class, 'bookmark'])->name('quiz.bookmark');

    // Change Icon
    Route::patch('/dashboard/icon/{icon_id}', [StatusController::class, 'icon'])->name('dashboard.icon');
});

// Admin Page
Route::get('/admin', [StatusController::class, 'admin'])->middleware(['auth', 'verified', 'admin'])->name('admin');

// Notice
Route::post('/admin/notice', [StatusController::class, 'notice'])->middleware(['auth', 'verified', 'admin'])->name('admin.notice');


/* !!! Resource Pages !!! */


// Welcome Page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Privacy Policy
Route::get('/info/privacy', function () {
    return view('info/privacy');
})->name('info.privacy');

// About This Site
Route::get('/info/about', function () {
    return view('info/about');
})->name('info.about');

// Profile
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
