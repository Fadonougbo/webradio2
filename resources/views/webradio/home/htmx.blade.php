

@if ($isHtmxRequest)

    @if ($article->exists())
        <editor-content editorcontent="{{$article->content}}" ></editor-content>
    @endif
    
@else
    <span>Not found</span>
@endif