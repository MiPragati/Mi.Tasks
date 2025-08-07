@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Post</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="5" required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="media" class="form-label">Upload Image/Video</label>
            <input type="file" name="media" class="form-control">

            @if($post->media)
                <p class="mt-2">Current Media:</p>
                @if(Str::endsWith($post->media, ['.jpg','.jpeg','.png','.gif']))
                    <img src="{{ asset('storage/media/' . $post->media) }}" width="200" alt="Post media">
                @elseif(Str::endsWith($post->media, ['.mp4','.webm']))
                    <video width="320" height="240" controls>
                        <source src="{{ asset('storage/media/' . $post->media) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
@endsection
