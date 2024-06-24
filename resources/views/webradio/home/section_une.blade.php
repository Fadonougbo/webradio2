<section class="sm:grid sm:grid-cols-2 lg:grid-cols-4" >

@php
    $listes=[
        [
            'date'=>'10 mai 2024',
            'img'=>'une1.jpg',
            'title'=>'Le premier ministre nigérien à propos du blocage de l’exportation du petrole',
            'author'=>'Arnaud Xavier AVODAGBE'
        ],
        [
            'date'=>'10 mai 2024',
            'img'=>'une2.jpg',
            'title'=>'Bénin-Niger : Cotonou ordonne l’interdiction d’embarquer du pétrole',
            'author'=>'Arnaud Xavier AVODAGBE'
        ],
        [
            'date'=>'12 mai 2024',
            'img'=>'une3.png',
            'title'=>'Vagues de Chaleur au Bénin : Des variations significatives attendues dans les schémas de précipitations les mois à venir',
            'author'=>'Natalie ALOTCHÉPKA'
        ],
        [
            'date'=>'4 mai 2024',
            'img'=>'une4.png',
            'title'=>'Recule des langues nationales en Afrique : Les principaux facteurs et conséquences de l’Assimilation Linguistique’’',
            'author'=>'Roland AZATASSOU'
        ],
        [
            'date'=>'13 mai 2024',
            'img'=>'une5.jpg',
            'title'=>'Marche contre la vie chère au Bénin : Le ras-le-bol des syndicalistes dans les rues de cotonou',
            'author'=>'Arneaud Xavier AVODAGBE'
        ],
        [
            'date'=>'9 mai 2024',
            'img'=>'une6.webp',
            'title'=>'19ème tour cycliste international du Bénin : La conquête pour le maillot jaune lancée à Boukoumbé',
            'author'=>'Natalie ALOTCHÉPKA'
        ]
    ]
@endphp

@php
    $articles=$categories[0]->articles; 
    
@endphp




@foreach ($articles as $article)
    @php
    (new DateTime)->format('');
    
        $img=$article->article_principal_image;
        $date=now('africa/porto-novo')->locale('fr-FR')->setDateTimeFrom(new DateTime($article->created_at))->format('d/m/Y');
        $title=Str::limit($article->article_title,'100');
        $author=$article->user->last_name .' '. $article->user->first_name;
        
    @endphp
    <div class="my-10  rounded mx-4 " >
        <section class="w-full  h-48 my-4 relative" >
            <img src='{{asset("storage/$img")}}' class="size-full " alt="actu image">
            <span class="absolute top-4 left-4 text-sm uppercase bg-basic_primary_color/80 text-basic_white_color px-2 rounded-full" >{{$date}}</span>
        </section>
        <section class="my-2" >
            <a class="text-2xl  font-extrabold text-center my-4 transition-all hover:text-basic_primary_color" href="{{route('home.show',['article'=>$article,'slug'=>$article->article_slug])}}" >{{$title}}</a>

            <p class="opacity-75  font-bold  text-sm flex items-center" > <i data-lucide="circle-user-round" class="mx-1 size-4" ></i> {{$author}}</p> 
        </section>
    </div>
@endforeach


</section>