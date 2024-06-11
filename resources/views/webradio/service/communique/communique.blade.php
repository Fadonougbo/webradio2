@extends('webradio.service.communique.base')

@section('title',"Déposer un communiqué")

@section('content')
    
    <main class="p-4" >
       <div class="mt-40" >
           <h2 class="my-6 text-4xl font-semibold uppercase text-center " > Communiqué </h2>
            <p class="text-center text-2xl" >Remplissez le formulaire ci-dessous pour faire votre demande</p>
       </div>

       @include('webradio.service.communique.info_table')

        <form action="" method="POST" class="bg-gray-200 rounded-md shadow p-6 my-8 flex flex-col items-center mx-auto lg:w-[90%] xl:w-[80%] " enctype="multipart/form-data">

           
            @csrf
          
            @if($errors->any())
                <!-- <message-toast type="info" msg="Le formulaire n'est pas valide, veuillez vérifier vos informations et réessayer à nouveau." delay="15000" ></message-toast> -->
                 @foreach ($errors->all() as $err)
                     <p>{{$err}}</p>
                 @endforeach 
            @endif
           
            @include('webradio.service.communique.info_demandeur')

            @include('webradio.service.communique.info_programme')

            @include('webradio.service.communique.info_detail')

            <div class="w-full flex my-6 justify-center" >
                <button type="submit" class="w-full bg-green-900 hover:bg-green-900/80  md:w-3/4 lg:w-1/2 p-2 text-basic_white_color text-xl rounded-sm" >Soumettre</button>
            </div>
        </form>
        
    </main>

@endsection