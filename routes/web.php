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
use App\Http\Controllers\BookingController;
use App\Http\Controllers\IntakeController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/home', function () {
    return redirect('/');
});

Auth::routes();

Route::get('/forum', [ForumController::class, 'index'])->middleware('auth')->name('forum.index');
Route::get('/forum/{post}', [ForumController::class, 'show'])->name('forum.show');

Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class)->except(['index','show']);
    Route::post('/forum/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/reactions/toggle', [ReactionController::class, 'toggle'])->name('reactions.toggle');

    Route::get('/counselors', [CounselorController::class, 'index'])->name('counselors.index');
    Route::resource('conversations', ConversationController::class)->only(['index','store','show']);
    Route::post('/conversations/{conversation}/messages', [MessageController::class, 'store'])->name('messages.store');

    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');

    // CampusMind routes
    Route::get('/campusmind', [BookingController::class, 'index'])->name('campusmind.index');
    Route::post('/campusmind/book-slot', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/campusmind/intake', [IntakeController::class, 'create'])->name('intake.create');
    Route::post('/campusmind/intake', [IntakeController::class, 'store'])->name('intake.store');
    Route::get('/campusmind/stories', [StoryController::class, 'index'])->name('stories.index');
    Route::post('/campusmind/stories', [StoryController::class, 'store'])->name('stories.store');

    // Admin routes
    Route::prefix('admin')->middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::put('/counselors/{user}/slots', [AdminController::class, 'updateSlots'])->name('admin.counselors.slots.update');
    });
});