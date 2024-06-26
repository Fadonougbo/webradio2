@use(App\Models\webradio\Article)

@php
    
    $carouselArticles=Article::where('isOnline',true)->where('categorie_id','!=',null)->orderByDesc('id')->limit(6)->get();

    $carouselData=$carouselArticles->map(function(Article $article) {

        $date=now('africa/porto-novo')->locale('fr-FR')->setDateTimeFrom(new DateTime($article->created_at))->format('d/m/Y');

        return [
            'title'=>Str::limit($article->article_title,75),
            'image'=>asset('storage/'.$article->article_principal_image),
            'url'=>route('home.show',['article'=>$article->id,'slug'=>$article->article_slug]),
            'date'=>$date

        ];

    })->toJson();


@endphp

@if ($isHtmxRequest)
    @if(!$carouselArticles->isEmpty())
        <actu-carousel class="my-6   md:text-xl" carouseldata="{{$carouselData}}"  ></actu-carousel>
    @endif
    
@else
    
@endif