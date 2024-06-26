<div class="w-full my-8" >
    @php
        $inter_listes=[
            [
                'date'=>'1 mai 2024',
                'img'=>'poli1.jpg',
                'title'=>'Bassirou Diomaye Faye : cinq choses à savoir sur le nouveau président du Sénégal',
                'author'=>'Roland AZATASSOU'
            ],
            [
                'date'=>'23 avril 2024',
                'img'=>'inter1.jpg',
                'title'=>'Art : le Bénin illumine la Biennale de Venise',
                'author'=>'Roland AZATASSOU'
            ],
            [
                'date'=>'22 mai 2024',
                'img'=>'inter2.jpg',
                'title'=>'SIAM : le Maroc face au défi du changement climatique',
                'author'=>'Roland TOHOUMON'
            ],
            [
                'date'=>'17 mai 2024',
                'img'=>'inter4.jpg',
                'title'=>'Libye : l’émissaire de l’ONU Abdoulaye Bathily démissionne',
                'author'=>'Natalie ALOTCHÉPKA'
            ]
            ];

        $poli_listes=[
            [
                'date'=>'20 mars 2024',
                'img'=>'poli2.jpg',
                'title'=>'Complémentarité entre démocratie et développement',
                'author'=>'Roland AZATASSOU'
            ],
            [
                'date'=>'22 mars 2024',
                'img'=>'poli3.jpg',
                'title'=>'Lutte contre le terrorisme : les Etats-Unis volent au secours du Bénin',
                'author'=>'Natalie ALOTCHÉPKA'
            ],
            [
                'date'=>'7 mars 2024',
                'img'=>'poli4.jpg',
                'title'=>'	Projet Pipeline : Le Bénin répond au Niger',
                'author'=>'Arneaud Xavier AVODAGBÉ'
            ]
            ];


        $sports=[
            [
                'date'=>'20 mars 2024',
                'img'=>'sport1.jpg',
                'title'=>'Football : Désiré Sègbè Azankpo au CS Bilingue Le Triangle Divin',
                'author'=>'Roland AZATASSOU'
            ],
            [
                'date'=>'3 mai 2024',
                'img'=>'sport2.jpg',
                'title'=>'	Football - UFOA-B U17 : Désiré Sègbè Azankpo encourage les jeunes',
                'author'=>'Roland AZATASSOU'
            ],
            [
                'date'=>'3 mai 2024',
                'img'=>'sport3.jpg',
                'title'=>'	France : Steve Mounié élu joueur du mois d’avril à Brest !',
                'author'=>'Natalie ALOTCHÉPKA'
            ],
            [
                'date'=>'9 mai 2024',
                'img'=>'sport4.jpg',
                'title'=>'	LDC : Du chaud au froid, Dortmund se qualifie pour les ½ finales !',
                'author'=>'Arnaud Xavier AVODAGBÉ'
            ],
            [
                'date'=>'17 avril 2024',
                'img'=>'sport5.jpg',
                'title'=>'		LDC : Renversant, Paris se qualifie pour les demi-finales !',
                'author'=>'Arnaud Xavier AVODAGBÉ'
            ]
            
        ]
    @endphp

        <section class="flex flex-col w-full justify-center sm:flex-row" >

        @foreach ($otherCategories as $otherCategorie)

            @php
                $articles=$otherCategorie->articles()->where('isOnline',true)->orderByDesc('created_at')->limit(5)->get();  
                //dump($articles);
            @endphp

            @if (!$articles->isEmpty())                
            
            <div class="my-6 mx-2" >
                    
                <section class="w-full flex justify-center" >
                    <h2 class="text-xl w-full  my-4 p-1 rounded uppercase bg-basic_primary_color text-basic_white_color text-center font-semibold  md:text-2xl " >{{$otherCategorie->name}}</h2>
                </section>

                

                <section class="sm:grid  lg:grid-cols-2" >
                
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

                <section class="flex justify-center uppercase" >
                    <a class="text-basic_primary_color border-solid border-[1px] border-basic_primary_color font-semibold  p-2 rounded-sm text-lg text-center hover:opacity-75 " href="{{route('home.show.categorie',['categorie'=>$firstCategorie,'name'=>$firstCategorie->name])}}" >Afficher plus </a>
                </section>
        
            </div>
            @endif
        @endforeach


        
        </section>
            
        
</div>