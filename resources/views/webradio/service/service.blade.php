@extends('webradio.service.base')

@section('title',"Nos services")

@section('content')
    

    <main class="p-4" >
       
        <h2 class="my-6 text-4xl font-semibold underline decoration-solid underline-offset-2 md:text-center " > Voici une liste des services variés offerts par la <abbr title="Radio Trait d'Union">RTU</abbr>  pour répondre aux besoins et aux intérêts de notre public. </h2>
        
        <div class=" w-full sm:items-center sm:flex sm:flex-col " >
            <ul class="list-disc p-6 text-lg sm:w-1/2 " >
                <li class="my-4 hover:text-basic_primary_color uppercase" >
                    <a href="{{route('service.publicite')}}">Diffusion de spot publicitaire</a>
                </li>
                <li class="my-4 hover:text-basic_primary_color uppercase " >
                    <a href="#">Avis de recherche</a>
                </li>
                <li class="my-4 hover:text-basic_primary_color uppercase " >
                    <a href="#">Dedicace du dimanche</a>
                </li>
                <li class="my-4 hover:text-basic_primary_color uppercase " >
                    <a href="#">Avis de Remerciement</a>
                </li>
                <li class="my-4 hover:text-basic_primary_color uppercase" >
                    <a href="#">Annonce néclrologique</a>
                </li>
                <li class="my-4 hover:text-basic_primary_color uppercase" >
                    <a href="#">Communuqué, avis</a>
                </li>
                <li class="my-4 hover:text-basic_primary_color uppercase" >
                    <a href="#">Communiqué politique</a>
                </li>
                <li class="my-4 hover:text-basic_primary_color uppercase" >
                    <a href="#">Couverture mediatique</a>
                </li>
                <li class="my-4 hover:text-basic_primary_color uppercase" >
                    <a href="#">Invité du journal ordinaire</a>
                </li>
                <li class="my-4 hover:text-basic_primary_color uppercase" >
                    <a href="#">Invité du journal politique</a>
                </li>
                <li class="my-4 hover:text-basic_primary_color uppercase" >
                    <a href="#">Invité du journal commercial</a>
                </li>
            </ul>
        </div>
    </main>

@endsection