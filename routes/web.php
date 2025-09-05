<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Frontend\BlogController;




Route::get('/', fn() => redirect('/blog'));


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Admin area
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('articles', controller: AdminArticleController::class)->except(['show']);

// new 
    Route::get('articles-trash', [AdminArticleController::class, 'trash'])->name('articles.trash');
    Route::patch('articles/{id}/restore', [AdminArticleController::class, 'restore'])->name('articles.restore');
    Route::delete('articles/{id}/force', [AdminArticleController::class, 'forceDelete'])->name('articles.force');


});