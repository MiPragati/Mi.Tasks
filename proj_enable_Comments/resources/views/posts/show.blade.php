<html>
    <head>
        <title>{{ $post->title }}</title>
        <style>
            body {
                font-family: Arial;
                background: #f0f0f0;
                padding: 30px;
            }
            .post {
                background: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                max-width: 800px;
                margin: auto;
            }
            .meta {
                font-size: 0.8em;
                color: #666;
            }
            .comment {
                background: #fff;
                border-radius: 5px;
                padding: 10px;
                margin-bottom: 10px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            }
            .comment-form textarea {
                width: 100%;
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 8px;
                resize: vertical;
            }
            .comment-form button {
                margin-top: 5px;
                padding: 8px 15px;
                background: #007bff;
                border: none;
                color: #fff;
                border-radius: 5px;
                cursor: pointer;
            }
            .comment-form button:hover {
                background: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class="post">
            <h1>{{ $post->title }}</h1>
            <div class="meta">
                Category: {{ $post->category->name ?? 'Uncategorized' }} |
                Posted on: {{ $post->created_at->format('M d, Y h:i A') }}
            </div>
            <p>{{ $post->content }}</p>
            <p><a href="/"> &larr; Back to Home</a></p>
        </div>

        {{-- Comments Section --}}
        <div class="post" style="margin-top: 20px;">

        <h3>Comments ({{ $post->comments->count() }})</h3>

@forelse($post->comments as $comment)
    <div style="background: #fff; padding: 10px; margin-bottom: 10px; border-radius: 5px;">
        <strong>{{ $comment->name }}</strong> <small>({{ $comment->email }})</small><br>
        <p>{{ $comment->comment }}</p>
        <small>Posted on {{ $comment->created_at->format('M d, Y h:i A') }}</small>
    </div>
@empty
    <p>No comments yet. Be the first to comment!</p>
@endforelse


            {{-- Comment form --}}
            <div style="margin-top: 30px;">
    <h3>Leave a Comment</h3>
    <form action="{{ route('comments.store', $post->id) }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Your Name" required><br><br>
        <input type="email" name="email" placeholder="Your Email" required><br><br>
        <textarea name="comment" placeholder="Your Comment" required></textarea><br><br>
        <button type="submit">Submit Comment</button>
    </form>
</div>
        </div>
    </body>
</html>
