<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{

    use AuthorizesRequests;

    public function edit(Post $post)
{
    $this->authorize('update', $post);
    $categories = Category::all();
    return view('posts.edit', compact('post', 'categories'));
}

public function destroy(Post $post)
{
    $this->authorize('delete', $post);
    if ($post->media_path) {
        Storage::disk('public')->delete($post->media_path);
    }

    $post->delete();

    return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
}


    public function index()
    {
        $posts = Post::with(['user', 'category'])->latest()->get();
        return view('posts.index', compact('posts'));
    }

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
            'media' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,webm|max:20480',
        ]);

        $mediaPath = null;

        if ($request->hasFile('media')) {
            $mediaPath = $request->file('media')->store('uploads', 'public');
        }

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'media_path' => $mediaPath,
            'user_id' => Auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function show($id)
    {
        $post = Post::with([
            'category',
            'comments.user'
        ])->findOrFail($id);

        return view('posts.show', compact('post'));
    }

    public function postsByCategory($id)
    {
        $category = Category::findOrFail($id);
        $posts = $category->posts;
        return view('posts.by_category', compact('category', 'posts'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,webm|max:20480'
        ]);

        $mediaPath = $post->media_path;

        if ($request->hasFile('media')) {
            // Delete old file if exists
            if ($mediaPath){
            Storage::disk('public')->delete($mediaPath);
            }
            // Upload new media
            $mediaPath = $request->file('media')->store('uploads', 'public');
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'media_path' => $mediaPath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }
}
