@php
    $id=(int)request()->route()->parameter('article');

    $article=(new App\Models\webradio\Article())->find($id);
@endphp

@if ($isHtmxRequest)
    
    @if ($article->exists())
    <blog-editor articlecontent="{{$article->content}}" ></blog-editor>
    @endif
@else
    <h1>ERROR</h1>
@endif
