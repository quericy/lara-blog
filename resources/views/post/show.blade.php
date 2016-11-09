<html>
<head>
    <title>{{ config('app.name') }}</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>{{$show_post->title}}</h1>
    <br>
    &nbsp;分类:
    <a class="category" href="{{ route('category.show',$show_post->category->id) }}">
        {{$show_post->category->category_name}}
    </a>
    @if ($show_post->tags->count() )
        &nbsp;标签:
        @foreach ($show_post->tags as $each_tag)
            <a class="tag" href="{{ route('tag.show',$each_tag->id) }}">{{$each_tag->tag_name}}</a>
            @if ($show_post->tags->last() !== $each_tag)
                ,
            @endif
        @endforeach
    @endif
    &nbsp;最后更新:{{ $show_post->updated_at }}
    <hr>
    {{$show_post->content}}

</div>
</body>
</html>