<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $post->comments()->create([
            'name'=>auth()->user()->name,
            'email'=>auth()->user()->email,
            'comment'=>$request->content,
            'post_id'=>$post->id
        ]);

        return back()->with('success', 'Comment added successfully.');
    }
}
