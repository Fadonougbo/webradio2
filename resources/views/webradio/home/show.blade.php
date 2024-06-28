@extends('webradio.home.base')

@section('title',$article->article_title)

@section('specifique_resource')
    @vite(['resources/webradio_frontend/home/ShowEditorContentComponent.tsx','resources/css/show_article_loader.css'])
@endsection

@section('content')
    

    <main class="p-2 sm:p-4 min-h-screen w-full flex flex-col" >

        @if(!empty($article->categorie_id))

        <div class="w-full flex flex-col items-center" >

            <section class="w-full flex flex-col items-center lg:w-[75%] xl:w-[65%] " >

                <div class="mt-20 w-full tm:mt-28 " >

                    <h1 class="text-3xl lg:text-4xl font-semibold" >{{$article->article_title}}</h1>

                    @php
                        $author=$article->user?$article->user->last_name .' '. $article->user->first_name:'rtu';
                        $date=now('africa/porto-novo')->locale('fr-FR')->setDateTimeFrom(new DateTime($article->created_at))->format('d/m/Y');
                        $img=$article->article_principal_image;
                    @endphp

                    <p class="my-4 flex text-sm items-center flex-wrap gap-2" >
                        <span class="flex items-center capitalize font-medium mr-3" >
                            <i data-lucide="circle-user-round" class="mx-2 size-6 text-basic_primary_color" ></i>
            
                            {{$author}}
                        </span>
                       
                        <span class="flex items-center capitalize  " >
                            <i data-lucide="calendar-days" class="mx-2 size-6 text-basic_primary_color"></i>
                            {{$date}}
                        </span>

                        <span class="flex items-center capitalize  " >
                            <i data-lucide="album" class="mx-2 size-6 text-basic_primary_color"></i>
                            <a class="underline" href="{{route('home.show.categorie',['categorie'=>$article->categorie->id,'name'=>$article->categorie->name])}}">{{$article->categorie->name}}</a>
                            
                        </span>

                        @can('show_administration')
                            <a class="text-white bg-green-600 p-1 lg:p-2 rounded mx-2" href="{{route('dashboard.blog.update.article',['article'=>$article->id])}}">
                                Modifier
                            </a>
                        @endcan
                    </p>

                    
                </div>
                
                <div class="w-full h-52 my-8 sm:h-80"  >
                    <img src="{{asset("storage/$img")}}" loading="lazy" class="w-full h-full" alt="image principale de l'article">
                </div>
                
                <!-- Affiche le contenu -->
                <div
                    hx-get="{{route('home.show.htmx',['article'=>$article])}}"
                    hx-trigger="load"
                    class="min-h-72 w-full"
                    hx-indicator="#indicator"
                >

                    <div id="indicator" class="htmx-indicator w-full" >
                        <div class="skeleton h-8 w-[20%] bg-black/60 my-4"></div>
                        <div class="skeleton h-8 w-full bg-black/60 my-4"></div>
                        <div class="skeleton h-2 w-full bg-black/60 my-4"></div>
                        <div class="skeleton h-8 w-[50%] bg-black/60 my-4"></div>
                        <div class="skeleton h-8 w-full bg-black/60 my-4"></div>
                        <div class="skeleton h-4 w-2/6 bg-black/60 my-4"></div>
                        <div class="skeleton h-8 w-full bg-black/60 my-4"></div>
                        <div class="skeleton h-20 w-3/6 bg-black/60 my-4"></div>

                        <div class="skeleton h-3 w-[20%] bg-black/60 my-4"></div>
                        <div class="skeleton h-36 w-[70%] bg-black/60 my-4"></div>
                        <div class="skeleton h-2 w-full bg-black/60 my-4"></div>
                    </div>

                </div>

                @if ($nextArticle)
                    <div class="w-full mb-16 flex justify-center sm:justify-end" >
                 
                        <button class="join-item btn btn-outline w-auto">
                            <a href="{{route('home.show',['article'=>$nextArticle->id,'slug'=>$nextArticle->article_slug])}}" class="flex items-center" >
                                {{Str::limit($nextArticle->article_title,30)}}
                                
                                <i data-lucide="arrow-right" class="mx-2 size-6 text-basic_primary_color"></i>
                            </a>
                            
                        </button>
                    </div>
                @endif
                

               @include('webradio.home.share_logo')

            </section>

        </div>
        @endif

        <!-- Afficher d'autre articles à l'utilisateur -->
        @php
            $categorieID=$article->categorie->id;

            $categories=(new App\Models\webradio\Categorie())->with(['articles'])->findOrFail($categorieID);

            $articles=$categories->articles()->limit(4)->where('isOnline',true)->where('categorie_id','!=',null)->where('id','!=',$article->id)->get();

            
        @endphp

        @if (!$articles->isEmpty())

            <div class="my-10 ">

                <!-- <section class="w-full flex justify-center" >

                    <h2 class="text-xl w-full shadow-2xl my-4 p-1 rounded uppercase bg-basic_primary_color text-basic_white_color text-center font-semibold  md:text-2xl sm:w-[80%] lg:w-[60%]" >Dans la même rubrique</h2>

                </section> -->
                <div class="divider divider-start  p-6 font-semibold before:h-2 after:h-2 before:bg-basic_primary_color/90 after:bg-basic_primary_color/90 uppercase text-lg">
                    Dans la même rubrique
                </div>

                <section class=" p-4 sm:grid sm:grid-cols-2 lg:grid-cols-4" >

                    @foreach ($articles as $article)
                        @php
                    
                            $img=$article->article_principal_image;
                            $date=now('africa/porto-novo')->locale('fr-FR')->setDateTimeFrom(new DateTime($article->created_at))->format('d/m/Y');
                            $title=Str::limit($article->article_title,'100');
                            $author=$article->user?$article->user->last_name .' '. $article->user->first_name:'rtu';
                    
                        @endphp
                        
                        @include('webradio.home.article_card')

                    @endforeach
                </section>

            </div>

        @endif

        
    </main>

@endsection