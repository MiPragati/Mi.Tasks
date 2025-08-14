<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostApiController extends Controller
{
    public function index()
    {
        $posts = Post::with('author','category','tags')->latest()->paginate(10);
        return response()->json($posts);
    }

    public function show(Post $post)
    {
        $post->load('author','category','tags','comments');
        return response()->json($post);
    }
}
