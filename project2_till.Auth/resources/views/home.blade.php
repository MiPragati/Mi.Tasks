<html>
    <head>
        <title>Fritter's Blog</title>
        <style>
            body{
                font-family:Arial, sans-serif; background:#ffb6c1 ; margin: 0;
            }

            .banner {
                background: url('https://tse1.mm.bing.net/th/id/OIP.cGS8XJ9U7TCt9TpLsx4qCAHaEK?pid=Api&rs=1&c=1&qlt=95&w=183&h=103') no-repeat center center;
                background-size:cover;
                height: 300px;
                color: white;
                display: flex;
                justify-content: center;
                align-items: center;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
                font-size: 2em;
                text-align: center;
            }

            .categories {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                padding: 30px;
            }

            .category {
                background: white;
                border-radius: 10px;
                margin: 10px;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                transition: transform 0.2s ease;
                text-align: center;
                width: 200px;
            }
            .category:hover {
                transform: scale(1.05);
                background-color: rgba(0,0.1,0,0.1);
            }

        </style>
    </head>
    <body>
        <div class="banner">
            <div>
                <h1>Welcome to my blog</h1>
                <p>Discover Posts By Category Below!!</p>
        </div>
</div>
<div class="categories">
    @foreach($categories as $category)
    <div class="category">
        <a href="{{ route('category.posts', $category->id)}}">
            <h3>{{$category->name}}</h3>
    </div>
    @endforeach
</div>
    </body>
</html>
