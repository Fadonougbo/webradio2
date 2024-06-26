@extends('webradio.home.base')

@section('title',$categorie->name)



@section('content')
    

    <main class="pt-20 tm:pt-32 min-h-screen w-full " >
        
            <section class="w-full p-4 " >
                <details>
                    <summary>
                        <em class="text-lg" ><span class="font-semibold cursor-pointer text-blue-500 hover:text-blue-500/40" >Categories</span> / <span >{{$categorie->name}}</span></em>
                    </summary>
                    <ul class="ml-8 my-2 flex flex-wrap" >
                        @foreach ($categories as $cat)
                            <li class="my-1 capitalize font-semibold bg-blue-600 inline-block rounded-sm mx-1" > 
                                <a class="p-2 text-basic_white_color "  href="{{route('home.show.categorie',['categorie'=>$cat->id,'name'=>$cat->name])}}">
                                    {{$cat->name}}
                                </a>
                            </li>
                        @endforeach
                        
                    </ul>
                </details>
                
            </section>

            @php
                $articles=$categorie->articles()->where('isOnline',true)->orderByDesc('created_at')->paginate(20);  
            @endphp

            {{$articles->links()}}

            <section class="px-6 sm:grid sm:grid-cols-2 lg:grid-cols-4" >

                @if (!$articles->isEmpty())
                
                    @foreach ($articles as $article)

                        @php
                        
                            $img=$article->article_principal_image;

                            $date=now('africa/porto-novo')->locale('fr-FR')->setDateTimeFrom(new DateTime($article->created_at))->format('d/m/Y');

                            $title=Str::limit($article->article_title,'100');

                            $author=$article->user?$article->user->last_name .' '. $article->user->first_name:'';

                            
                        @endphp

                        @include('webradio.home.article_card')
                    @endforeach

            
                @endif


            </section>
            {{$articles->links()}}

            @if ($articles->isEmpty())
                <h1 class="text-2xl text-center w-full" >Vide</h1>
            @endif
        <!-- <audio src="https://stream.zeno.fm/qyfhx0ijbzuvv" controls>dddddddddddd</audio> -->
        <!-- https://stream.zeno.fm/d8cpkk9zsy8uv -->
    </main>

@endsection