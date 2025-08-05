<html>
    <head>
        <title>Simple Blog</title>
        <style>
            body { font-family:Arial: background: white; padding:20px }
            .post {background:cream; padding: 15px; margin-bottom:20px; border-radius:8px;}
            h2 {color: magenta;}
            .category {font-size: 0.9em; color: brown;}
            </style>
    </head>
<body>
<h1>Blog Posts</h1>

@foreach($posts as $post)

<div class="post">

<h2>{{ $post->title}}</h2>

<p class="category">Category:

{{$post->category->name}}</p>

<p>{{$post->content}}</p>

</div>
@endforeach
</body>
</html>
