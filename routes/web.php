<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('feedback.create');
});

Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
    
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');
        Route::get('/entries', [AdminController::class, 'entries'])->name('admin.entries');
        Route::get('/entries/{id}', [AdminController::class, 'showEntry'])->name('admin.entry.show');
        Route::get('/suggestions', [AdminController::class, 'suggestions'])->name('admin.suggestions');
        Route::get('/export', [AdminController::class, 'export'])->name('admin.export');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});
