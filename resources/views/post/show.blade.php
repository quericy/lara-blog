<html>
<head>
    <title>{{ config('app.name') }}</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>文章列表</h1>
    <h5>Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</h5>
    <hr>
    <ul>
        @foreach ($posts as $post)
            <li>
                <a href="/blog/{{ $post->slug }}">{{ $post->title }}</a>
                <p>
                    &nbsp;分类:
                    <a class="category" href="{{ route('category.show',$post->category->id) }}">
                        {{$post->category->category_name}}
                    </a>
                    @if ($post->tags->count() )
                        &nbsp;标签:
                        @foreach ($post->tags as $each_tag)
                            <a class="tag" href="{{ route('tag.show',$each_tag->id) }}">{{$each_tag->tag_name}}</a>
                            @if ($post->tags->last() !== $each_tag)
                                ,
                            @endif
                        @endforeach
                    @endif
                    &nbsp;最后更新:{{ $post->updated_at }}
                </p>
                <p>
                    {{ str_limit($post->content) }}
                </p>
            </li>
            <hr>
        @endforeach
    </ul>
    <hr>
    {!! $posts->render() !!}
</div>
</body>
</html>