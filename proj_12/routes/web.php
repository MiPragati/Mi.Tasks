<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function(){
    return view('welcome');
})->name('welcome');


Route::get('/home',function(){
    $categories = \App\Models\Category::all();
    return view('home', compact('categories'));
})->middleware('auth')->name('home');

Route::get('/category/{id}',[PostController::class, 'postsByCategory'])->name('category.posts');


Route::get('/post/{id}',[PostController::class,'show'])->name('posts.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

require __DIR__.'/auth.php';
