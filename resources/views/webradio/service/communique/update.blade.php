@extends('webradio.service.communique.base')

@section('title',"Modifier les informations de votre communiqué")

@section('content')
    
    <main class="p-4 mt-20" >
       <div class="" >
           <h2 class="my-6 text-4xl font-semibold uppercase text-center " > Communiqué </h2>
            <p class="text-center text-2xl" >Remplissez le formulaire ci-dessous pour Modifier les informations de votre communiqué</p>
       </div>


        <form action="" method="POST" class="bg-gray-200 rounded-md shadow p-6 my-8 flex flex-col items-center mx-auto lg:w-[90%] xl:w-[80%] " enctype="multipart/form-data">

           
            @csrf
            @method('patch')
            
            @if($errors->any())
                <message-toast type="error" msg="Le formulaire est invalide. Veuillez vérifier vos informations et réessayer." delay="15000" ></message-toast>
                <!--  @foreach ($errors->all() as $err)
                     <p>{{$err}}</p>
                 @endforeach  -->
            @endif
           
            @include('webradio.service.communique.info_demandeur')

            @include('webradio.service.communique.info_programme')

            @include('webradio.service.communique.info_detail')

            
            @if ($communique->communique_status==='pending')
                <div class="w-full flex my-6 justify-center" >
                    <button type="submit" class="w-full bg-green-900 hover:bg-green-900/80  md:w-3/4 lg:w-1/2 p-2 text-basic_white_color text-xl rounded-sm" >Soumettre</button>
                </div>
            @endif

        </form>
        
    </main>

@endsection