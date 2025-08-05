<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::with('category')->get();
        return view('posts.index',compact('posts'));
    }

    public function postsByCategory($id)
    {
        $category = \App\Models\Category::findOrFail($id);
        $posts = $category->posts;

        return view('posts.by_category', compact('category','posts'));
    }

    public function show($id)
    {
        $post = \App\Models\Post::with('category')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

}
