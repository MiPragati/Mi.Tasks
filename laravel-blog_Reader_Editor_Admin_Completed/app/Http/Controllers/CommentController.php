<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        if (!auth()->check() || !in_array(auth()->user()->role, ['editor','admin'])) {
            abort(403);
        }

        $data = $request->validate([
            'body' => ['required','string','max:2000'],
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'body'    => $data['body'],
        ]);

        return back()->with('status', 'Comment added.');
    }

    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);

        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $data = $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $comment->update(['body' => $data['body']]);

        return redirect()
            ->route('editor.posts.show', $comment->post->slug)
            ->with('success', 'Comment updated.');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $post = $comment->post;
        $comment->delete();

        return redirect()
            ->route('editor.posts.show', $post->slug)
            ->with('success', 'Comment deleted.');
    }
}
