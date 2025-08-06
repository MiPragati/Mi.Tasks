<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>
    <h1>Welcome, {{ $user->name }}</h1>
    <p>Email: {{ $user->email }}</p>

    <h2>Create a New Post</h2>
    <form method="POST" action="{{ route('profile.posts.store') }}">
        @csrf
        <input type="text" name="title" placeholder="Post title" required><br>
        <textarea name="content" placeholder="Post content" required></textarea><br>
        <select name="category_id">
            @foreach(\App\Models\Category::all() as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select><br>
        <button type="submit">Create Post</button>
    </form>

    <h2>Your Posts</h2>
    @foreach($posts as $post)
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->content }}</p>

            <a href="{{ route('profile.posts.edit', $post->id) }}">Edit</a> |
            <form method="POST" action="{{ route('profile.posts.destroy', $post->id) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this post?')">Delete</button>
            </form>
        </div>
    @endforeach
</body>
</html>
