<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Models\Category;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', function () {
    $categories = Category::all();
    return view('home', compact('categories'));
})->middleware('auth')->name('home');

Route::get('/category/{id}', [PostController::class, 'postsByCategory'])->name('category.posts');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/posts/{post}/comments',[CommentController::class,'store'])->name('comments.store');
    Route::resource('posts', PostController::class);
});

require __DIR__.'/auth.php';
