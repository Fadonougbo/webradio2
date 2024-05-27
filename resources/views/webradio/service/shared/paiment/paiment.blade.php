@extends('webradio.service.shared.paiment.base')

@section('title',"Page de payment")

@section('content')
    

    <main class="p-4" >

        <form action="" method="POST" >
            @csrf
            @method('patch')
            <input type="hidden" name="demande_id" value="{{session('demande_id')}}">
            <input type="hidden" name="demande_type" value="{{session('demande_type')}}">
           
        </form>
        
        <paiment-module 
            demande_id="{{session('demande_id')}}" 
            demande_type="{{session('demande_type')}}" 
            on_error_url="{{session('on_error_url')}}" 
            on_success_url="{{session('on_success_url')}}" 
            amount="{{session('amount')}}" 
            tel="{{session('tel')}}" 
            email="{{session('email')}}"  >
        </paiment-module>
    </main>

@endsection