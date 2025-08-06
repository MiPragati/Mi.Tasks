<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function create()
{
    $categories = Category::all();
    return view('posts.create', compact('categories'));
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category_id' => 'required|exists:categories,id',
    ]);

    Post::create([
        'title' => $request->title,
        'content' => $request->content,
        'category_id' => $request->category_id,
        'user_id' => Auth::id()
    ]);

    return redirect()->route('posts.index')->with('success', 'Post created successfully!');
}

    public function index()
    {
        //
        $posts = Post::where('user_id', Auth::id())->get();
    return view('posts.index', compact('posts'));
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
