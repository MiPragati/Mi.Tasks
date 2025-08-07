@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl mb-4">Create New Post</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            @foreach ($errors->all() as $error)
                <div>- {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
        <label for="media" class="form-label">Upload Image/Video</label>
        <input type="file" name="media" class="form-control" accept="image/*,video/*">
        <small class="form-text text-muted">Accepted formats: jpg, png, gif, mp4, webm</small>
    </div>
        <div class="mb-4">
            <label>Title</label>
            <input type="text" name="title" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label>Content</label>
            <textarea name="content" rows="5" class="w-full p-2 border rounded" required></textarea>
        </div>

        <div class="mb-4">
            <label>Category</label>
            <select name="category_id" class="w-full p-2 border rounded">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">
    Create
</button>

</div>
@endsection
