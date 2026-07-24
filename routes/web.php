<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\CounselorController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [ForumController::class, 'index'])->middleware('auth')->name('forum.index');
Route::get('/forum/{post}', [ForumController::class, 'show'])->name('forum.show');

Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class)->except(['index','show']);
    Route::post('/forum/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/reactions/toggle', [ReactionController::class, 'toggle'])->name('reactions.toggle');

    Route::get('/counselors', [CounselorController::class, 'index'])->name('counselors.index');
    Route::resource('conversations', ConversationController::class)->only(['index','store','show']);
    Route::post('/conversations/{conversation}/messages', [MessageController::class, 'store'])->name('messages.store');

    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
});