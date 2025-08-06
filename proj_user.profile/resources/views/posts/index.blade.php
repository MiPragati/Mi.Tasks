@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl mb-4">My Posts</h2>

    @foreach($posts as $post)
        <div class="mb-4 border-b pb-2">
            <h3 class="text-xl">{{ $post->title }}</h3>
            <p>{{ $post->content }}</p>
            <small class="text-gray-600">Category: {{ $post->category->name ?? 'None' }}</small>
        </div>
    @endforeach

    @if($posts->isEmpty())
        <p>You haven't created any posts yet.</p>
    @endif
</div>
@endsection
