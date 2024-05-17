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
        <section class="flex flex-col w-full sm:flex-row" >
            <div class="my-6 " >
                <section class="w-full flex justify-center" >
                    <h2 class="text-xl w-full  my-4 p-1 rounded uppercase bg-basic_primary_color text-basic_white_color text-center font-semibold  md:text-2xl " >INTER</h2>
                </section>
                <section class="sm:grid  lg:grid-cols-2" >
                
                    @foreach ($inter_listes as $liste)
                        @php
                            $img=$liste['img'];
                            $date=$liste['date'];
                            $title=$liste['title'];
                            $author=$liste['author'];
                        @endphp
                        <div class="my-10 mx-2 lg:mx-6" >
                            <section class="w-full h-48 my-4 relative" >
                                <img src='{{asset("images/$img")}}' class="size-full " alt="actu image">
                                <span class="absolute text-sm top-4 left-4 uppercase bg-basic_primary_color text-basic_white_color px-2 rounded-full" >{{$date}}</span>
                            </section>
                            <section class="my-2" >
                                <a class="text-2xl transition-all font-extrabold text-center my-4 hover:text-basic_primary_color" href="#" >{{$title}}</a>
                                <p class="opacity-75  font-bold  text-sm flex items-center" > <i data-lucide="circle-user-round" class="mx-1 size-4" ></i> {{$author}}</p> 
                            </section>
                        </div>
                    @endforeach
        
        
                </section>
        
            </div>
            <div class="my-6 " >
                <section class="w-full flex justify-center" >
                    <h2 class="text-xl w-full   my-4 p-1 rounded uppercase bg-basic_primary_color text-basic_white_color text-center font-semibold  md:text-2xl sm:w-[90%]" >politique</h2>
                </section>
                <section class="sm:grid  lg:grid-cols-2" >
                @foreach ($poli_listes as $liste)
                        @php
                            $img=$liste['img'];
                            $date=$liste['date'];
                            $title=$liste['title'];
                            $author=$liste['author'];
                        @endphp
                        <div class="my-10  mx-2 lg:mx-6" >
                            <section class="w-full h-48 my-4 relative" >
                                <img src='{{asset("images/$img")}}' class="size-full " alt="actu image">
                                <span class="absolute top-4 text-sm left-4 uppercase bg-basic_primary_color text-basic_white_color px-2 rounded-full" >{{$date}}</span>
                            </section>
                            <section class="my-2" >
                                <a class="text-2xl transition-all font-extrabold text-center my-4 hover:text-basic_primary_color" href="#" >{{$title}}</a>
                                <p class="opacity-75  font-bold  text-sm flex items-center" > <i data-lucide="circle-user-round" class="mx-1 size-4" ></i> {{$author}}</p> 
                            </section>
                        </div>
                    @endforeach
        
        
                </section>
            </div>
        
        </section>
            <div class="my-6 " >
                <section class="w-full flex justify-center" >
                    <h2 class="text-xl w-full   my-4 p-1 rounded uppercase bg-basic_primary_color text-basic_white_color text-center font-semibold  md:text-2xl sm:w-[90%]" >sport</h2>
                </section>
                <section class="sm:grid  lg:grid-cols-2" >
                    @foreach ($sports as $liste)
                        @php
                            $img=$liste['img'];
                            $date=$liste['date'];
                            $title=$liste['title'];
                            $author=$liste['author'];
                        @endphp
                        <div class="my-10  mx-2 lg:mx-6" >
                            <section class="w-full h-48 my-4 relative" >
                                <img src='{{asset("images/$img")}}' class="size-full " alt="actu image">
                                <span class="absolute top-4 text-sm left-4 uppercase bg-basic_primary_color text-basic_white_color px-2 rounded-full" >{{$date}}</span>
                            </section>
                            <section class="my-2" >
                                <a class="text-2xl transition-all font-extrabold text-center my-4 hover:text-basic_primary_color" href="#" >{{$title}}</a>
                                <p class="opacity-75  font-bold  text-sm flex items-center" > <i data-lucide="circle-user-round" class="mx-1 size-4" ></i> {{$author}}</p> 
                            </section>
                        </div>
                    @endforeach
        
                </section>
            </div>
    
        

        <div class="flex justify-center" >
                    <a class="text-basic_primary_color border-solid border-[1px] border-basic_primary_color font-semibold  p-2 rounded-sm text-lg text-center hover:opacity-75 " href="#" >Voir tous les actualités </a>
        </div>
</div>