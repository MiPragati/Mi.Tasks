@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('content')
<h1>All Posts</h1>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>

@foreach($posts as $post)
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->content }}</p>

            <p><strong>Category:</strong> {{ $post->category?->name ?? 'Uncategorized' }}</p>
            <p><strong>Author:</strong> {{ $post->user->name }}</p>

            {{-- Display media --}}
            @if ($post->media_path)
                @php
                    $extension = pathinfo($post->media_path, PATHINFO_EXTENSION);
                @endphp

                @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                    <img src="{{ asset('storage/' . $post->media_path) }}" alt="Post Media" style="max-width: 400px;">
                @elseif (in_array($extension, ['mp4', 'mov', 'avi']))
                    <video controls width="400">
                        <source src="{{ asset('storage/' . $post->media_path) }}" type="video/{{ $extension }}">
                        Your browser does not support the video tag.
                    </video>
                @else
                    <p><em>Unsupported media type.</em></p>
                @endif
            @else
                {{-- Default image if no media --}}
                <img src="{{ asset('images/default-placeholder.png') }}" alt="No media" style="max-width: 400px;">
            @endif

            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning mt-3">Edit</a>

            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger mt-3">Delete</button>
            </form>
        </div>
    </div>
@endforeach
@endsection
