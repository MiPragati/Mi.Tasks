@php use Illuminate\Support\Str; @endphp

<html>
    <head>
        <title>Posts in {{$category->name}}</title>
        <style>
            body { font-family: Arial, background:#f8f8f8; padding: 20px;}
            .post {
                background: rgba(0.1,0,0,0.1);
                padding: 15px;
                margin-bottom: 20px;
                border-radius: 8px;
                box-shadow: 0 0 5px rgba(0,0,0,0.1);
            }
            h2 {color: #444;}
        </style>
    </head>
    <body>
        <h1>Posts in {{ $category->name }}</h1>
        @forelse($posts as $post)
        <div class="post">
            <h2>{{$post->title}}</h2>
            <p><small>Posted On {{$post->created_at->format('M d, Y')}}</small></p>
            <p>{{Str::limit($post->content, 150)}}</p>
            <a href="{{route('posts.show',$post->id)}}">Read More -> </a>
        </div>
        @empty
        <p> No Posts available in this category.</p>
        @endforelse
    </body>
</html>
