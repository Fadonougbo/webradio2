<div class="w-full my-8" >


        <section class="flex flex-col w-full justify-center   sm:flex-row" >

        @foreach ($otherCategories as $otherCategorie)

            @php
                $articles=$otherCategorie->articles()->where('isOnline',true)->orderByDesc('created_at')->limit(5)->get();  
                //dump($articles);
            @endphp

            @if (!$articles->isEmpty())                
            
            <div class="my-6 mx-2 w-full  tm:w-[48%]" >
                    
                <!-- <section class="w-full flex justify-center" >
                    <h2 class="text-xl w-full  my-4 p-1 rounded uppercase bg-basic_primary_color text-basic_white_color text-center font-semibold  md:text-2xl " >{{$otherCategorie->name}}</h2>
                </section> -->
                <div class="divider divider-start divider-error p-6 font-semibold before:h-2 after:h-2 before:bg-basic_primary_color/90 after:bg-basic_primary_color/90 uppercase text-lg">
                    
                    {{$otherCategorie->name}}
                </div>

                

                <section class="sm:grid  lg:grid-cols-2" >
                
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

                <section class="flex justify-center uppercase" >
                    <a class="text-basic_primary_color border-solid border-[1px] border-basic_primary_color font-semibold  p-2 rounded-sm text-lg text-center hover:opacity-75 " href="{{route('home.show.categorie',['categorie'=>$firstCategorie,'name'=>$firstCategorie->name])}}" >Afficher plus </a>
                </section>
        
            </div>
            @endif
        @endforeach


        
        </section>
            
        
</div>