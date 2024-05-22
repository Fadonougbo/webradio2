@extends('webradio.service.shared.paiment.base')

@section('title',"Page de payment")

@section('content')
    

    <main class="p-4" >

        <form action="" method="POST" class="bg-gray-200 rounded-md shadow p-6 my-8 flex flex-col items-center mx-auto lg:w-[90%] xl:w-[80%] " enctype="multipart/form-data">

           
            @csrf
           
        </form>

        <paiment-module demande_id="{{session('demande_id')}}" backurl="{{session('backUrl')}}" amount="{{session('amount')}}" nb_demande="{{session('nb_demande')}}"></paiment-module>
    </main>

@endsection