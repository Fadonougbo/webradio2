<section class="sm:grid sm:grid-cols-2 lg:grid-cols-4" >


@php
    $articles=$firstCategorie->articles()->where('isOnline',true)->where('categorie_id','!=',null)->orderByDesc('created_at')->limit(8)->get();  
    //dump($articles);
@endphp



@foreach ($articles as $article)

    @php
    
        $img=$article->article_principal_image;
        $date=now('africa/porto-novo')->locale('fr-FR')->setDateTimeFrom(new DateTime($article->created_at))->format('d/m/Y');
        $title=Str::limit($article->article_title,'100');
        $author=$article->user->last_name .' '. $article->user->first_name;
        
    @endphp

    @include('webradio.home.article_card')
@endforeach


</section>