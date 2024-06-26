@extends('webradio.service.base')

@section('title',"Nos services")

@section('content')
    

    <main class="p-4 my-24 min-h-screen" >
       
        <h2 class="my-6 text-lg lg:text-2xl font-semibold underline decoration-solid underline-offset-2 md:text-center leading-relaxed " > Voici une liste des divers services offerts par la <abbr title="Radio Trait d'Union">RTU</abbr>  pour répondre aux besoins et aux intérêts de son auditoire.</h2>
        
        <div class=" w-full sm:items-center sm:flex sm:flex-col " >
            <ul class="list-disc p-6 text-lg sm:w-1/2 " >
                <li class="my-4  text-blue-700 hover:text-basic_primary_color uppercase" >
                    <a href="{{route('service.communique')}}" class="underline" >Diffusion de communiqués</a>
                </li>
                <li class="my-4 hover:text-basic_primary_color uppercase " >
                    <a href="#">Avis de recherche</a> <span class="text-sm text-orange-600" >(Ce service est indisponible sur le site pour le moment)</span>
                </li>
                <li class="my-4 hover:text-basic_primary_color uppercase " >
                    <a href="#">Dedicace du dimanche</a> <span class="text-sm text-orange-600" >(Ce service est indisponible sur le site pour le moment)</span>
                </li>
                <li class="my-4 hover:text-basic_primary_color uppercase " >
                    <a href="#">Avis de Remerciement</a> <span class="text-sm text-orange-600" >(Ce service est indisponible sur le site pour le moment)</span>
                </li>
                <li class="my-4 hover:text-basic_primary_color uppercase" >
                    <a href="#">Annonce néclrologique</a> <span class="text-sm text-orange-600" >(Ce service est indisponible sur le site pour le moment)</span>
                </li>
                <li class="my-4 hover:text-basic_primary_color uppercase" >
                    <a href="#">Couverture mediatique</a> <span class="text-sm text-orange-600" >(Ce service est indisponible sur le site pour le moment)</span>
                </li>
                <li class="my-4 hover:text-basic_primary_color uppercase" >
                    <a href="#">Invité du journal ordinaire</a> <span class="text-sm text-orange-600" >(Ce service est indisponible sur le site pour le moment)</span>
                </li>
                <li class="my-4 hover:text-basic_primary_color uppercase" >
                    <a href="#">Invité du journal politique</a> <span class="text-sm text-orange-600" >(Ce service est indisponible sur le site pour le moment)</span>
                </li>
                <li class="my-4 hover:text-basic_primary_color uppercase" >
                    <a href="#">Invité du journal commercial</a> <span class="text-sm text-orange-600" >(Ce service est indisponible sur le site pour le moment)</span>
                </li>
            </ul>
        </div>
    </main>

@endsection