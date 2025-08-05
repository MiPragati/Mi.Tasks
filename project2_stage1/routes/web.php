<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\Post;

//Route::get('/', [PostController::class,'index']);

Route::get('/',function(){
    $categories = Category::all();
    return view('home', compact('categories'));
});

Route::get('/category/{id}',[PostController::class, 'postsByCategory'])->name('category.posts');

Route::get('/post/{id}', [PostController::class, 'show'])->name('posts.show');
