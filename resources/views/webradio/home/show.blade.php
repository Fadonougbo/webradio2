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

               

                <div class="my-4 flex items-center flex-col" >
                    <!--  -->
                    <p class="text-center my-1 mx-4 text-lg underline decoration-basic_primary_color underline-offset-1 decoration-2 uppercase" >Partarger sur</p>

                    <div class="flex cursor-pointer space-x-3 items-center" >
                        @php

                            $encodeUrl=urlencode(route('home.show',['article'=>$article->id,'slug'=>$article->article_slug]));

                            $encodeTexte=urlencode($article->article_title);

                           
                            
                        @endphp
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{$encodeUrl}}">
                            <svg viewBox="126.445 2.281 589 589" class="size-12 cursor-pointer flex-none" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><circle cx="420.945" cy="296.781" r="294.5" fill="#3c5a9a"></circle><path d="M516.704 92.677h-65.239c-38.715 0-81.777 16.283-81.777 72.402.189 19.554 0 38.281 0 59.357H324.9v71.271h46.174v205.177h84.847V294.353h56.002l5.067-70.117h-62.531s.14-31.191 0-40.249c0-22.177 23.076-20.907 24.464-20.907 10.981 0 32.332.032 37.813 0V92.677h-.032z" fill="#ffffff"></path></g></svg>
                        </a>
                        
                        <a href=" //https://x.com/share?url={{$encodeUrl}}&text={{$encodeTexte}}">
                            <svg viewBox="126.444 2.281 589 589" class="size-12 cursor-pointer flex-none" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><circle cx="420.944" cy="296.781" r="294.5" fill="#2daae1"></circle><path d="M609.773 179.634c-13.891 6.164-28.811 10.331-44.498 12.204 16.01-9.587 28.275-24.779 34.066-42.86a154.78 154.78 0 0 1-49.209 18.801c-14.125-15.056-34.267-24.456-56.551-24.456-42.773 0-77.462 34.675-77.462 77.473 0 6.064.683 11.98 1.996 17.66-64.389-3.236-121.474-34.079-159.684-80.945-6.672 11.446-10.491 24.754-10.491 38.953 0 26.875 13.679 50.587 34.464 64.477a77.122 77.122 0 0 1-35.097-9.686v.979c0 37.54 26.701 68.842 62.145 75.961-6.511 1.784-13.344 2.716-20.413 2.716-4.998 0-9.847-.473-14.584-1.364 9.859 30.769 38.471 53.166 72.363 53.799-26.515 20.785-59.925 33.175-96.212 33.175-6.25 0-12.427-.373-18.491-1.104 34.291 21.988 75.006 34.824 118.759 34.824 142.496 0 220.428-118.052 220.428-220.428 0-3.361-.074-6.697-.236-10.021a157.855 157.855 0 0 0 38.707-40.158z" fill="#ffffff"></path></g></svg>
                        </a>

                        
                        <a href="https://api.whatsapp.com/send?text={{$encodeUrl}}">
                            <svg viewBox="-2.73 0 1225.016 1225.016" class="size-16 cursor-pointer flex-none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#E0E0E0" d="M1041.858 178.02C927.206 63.289 774.753.07 612.325 0 277.617 0 5.232 272.298 5.098 606.991c-.039 106.986 27.915 211.42 81.048 303.476L0 1225.016l321.898-84.406c88.689 48.368 188.547 73.855 290.166 73.896h.258.003c334.654 0 607.08-272.346 607.222-607.023.056-162.208-63.052-314.724-177.689-429.463zm-429.533 933.963h-.197c-90.578-.048-179.402-24.366-256.878-70.339l-18.438-10.93-191.021 50.083 51-186.176-12.013-19.087c-50.525-80.336-77.198-173.175-77.16-268.504.111-278.186 226.507-504.503 504.898-504.503 134.812.056 261.519 52.604 356.814 147.965 95.289 95.36 147.728 222.128 147.688 356.948-.118 278.195-226.522 504.543-504.693 504.543z"></path><linearGradient id="a" gradientUnits="userSpaceOnUse" x1="609.77" y1="1190.114" x2="609.77" y2="21.084"><stop offset="0" stop-color="#20b038"></stop><stop offset="1" stop-color="#60d66a"></stop></linearGradient><path fill="url(#a)" d="M27.875 1190.114l82.211-300.18c-50.719-87.852-77.391-187.523-77.359-289.602.133-319.398 260.078-579.25 579.469-579.25 155.016.07 300.508 60.398 409.898 169.891 109.414 109.492 169.633 255.031 169.57 409.812-.133 319.406-260.094 579.281-579.445 579.281-.023 0 .016 0 0 0h-.258c-96.977-.031-192.266-24.375-276.898-70.5l-307.188 80.548z"></path><image overflow="visible" opacity=".08" width="682" height="639" xlink:href="FCC0802E2AF8A915.png" transform="translate(270.984 291.372)"></image><path fill-rule="evenodd" clip-rule="evenodd" fill="#FFF" d="M462.273 349.294c-11.234-24.977-23.062-25.477-33.75-25.914-8.742-.375-18.75-.352-28.742-.352-10 0-26.25 3.758-39.992 18.766-13.75 15.008-52.5 51.289-52.5 125.078 0 73.797 53.75 145.102 61.242 155.117 7.5 10 103.758 166.266 256.203 226.383 126.695 49.961 152.477 40.023 179.977 37.523s88.734-36.273 101.234-71.297c12.5-35.016 12.5-65.031 8.75-71.305-3.75-6.25-13.75-10-28.75-17.5s-88.734-43.789-102.484-48.789-23.75-7.5-33.75 7.516c-10 15-38.727 48.773-47.477 58.773-8.75 10.023-17.5 11.273-32.5 3.773-15-7.523-63.305-23.344-120.609-74.438-44.586-39.75-74.688-88.844-83.438-103.859-8.75-15-.938-23.125 6.586-30.602 6.734-6.719 15-17.508 22.5-26.266 7.484-8.758 9.984-15.008 14.984-25.008 5-10.016 2.5-18.773-1.25-26.273s-32.898-81.67-46.234-111.326z"></path><path fill="#FFF" d="M1036.898 176.091C923.562 62.677 772.859.185 612.297.114 281.43.114 12.172 269.286 12.039 600.137 12 705.896 39.633 809.13 92.156 900.13L7 1211.067l318.203-83.438c87.672 47.812 186.383 73.008 286.836 73.047h.255.003c330.812 0 600.109-269.219 600.25-600.055.055-160.343-62.328-311.108-175.649-424.53zm-424.601 923.242h-.195c-89.539-.047-177.344-24.086-253.93-69.531l-18.227-10.805-188.828 49.508 50.414-184.039-11.875-18.867c-49.945-79.414-76.312-171.188-76.273-265.422.109-274.992 223.906-498.711 499.102-498.711 133.266.055 258.516 52 352.719 146.266 94.195 94.266 146.031 219.578 145.992 352.852-.118 274.999-223.923 498.749-498.899 498.749z"></path></g></svg>
                        </a>
            
                    </div>

                </div>

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

                <section class="w-full flex justify-center" >

                    <h2 class="text-xl w-full shadow-2xl my-4 p-1 rounded uppercase bg-basic_primary_color text-basic_white_color text-center font-semibold  md:text-2xl sm:w-[80%] lg:w-[60%]" >Dans la même rubrique</h2>

                </section>

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

        

        
        <!-- <audio src="https://stream.zeno.fm/qyfhx0ijbzuvv" controls>dddddddddddd</audio> -->
        <!-- https://stream.zeno.fm/d8cpkk9zsy8uv -->
    </main>

@endsection