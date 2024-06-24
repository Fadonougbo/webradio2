@extends('webradio.home.base')

@section('title',$article->article_title)

@section('specifique_resource')
    @vite(['resources/webradio_frontend/home/ShowEditorContentComponent.tsx'])
@endsection

@section('content')
    

    <main class="p-4 min-h-screen w-full" >
        
        <div class="mt-20 w-full" >
            <h1 class="text-3xl font-semibold" >{{$article->article_title}}</h1>
            @php
                $author=$article->user->last_name .' '. $article->user->first_name;
                $date=now('africa/porto-novo')->locale('fr-FR')->setDateTimeFrom(new DateTime($article->created_at))->format('d/m/Y');
                $img=$article->article_principal_image;
            @endphp
            <p class="my-4 flex text-sm" >
                Publié par :
                <span class="flex items-center capitalize  mx-2 font-medium text-black" > {{$author}} </span>
                -
                <span class="flex items-center capitalize  mx-2" >{{$date}}</span>
            </p>
        </div>

        <div class="w-full h-52 my-8" >
            <img src="{{asset("storage/$img")}}" class="w-full h-full" alt="image principale de l'article">
        </div>
        
        <div
            hx-get="{{route('home.show.htmx',['article'=>$article])}}"
            hx-trigger="load"
        >   
        </div>
        <!-- <audio src="https://stream.zeno.fm/qyfhx0ijbzuvv" controls>dddddddddddd</audio> -->
        <!-- https://stream.zeno.fm/d8cpkk9zsy8uv -->
    </main>

@endsection