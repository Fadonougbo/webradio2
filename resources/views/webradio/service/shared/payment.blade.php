@extends('webradio.service.shared.base')

@section('title','Procédure de paiement')

@section('content')



    @session('success') 

        @php
            $session=session('success');
            $type=$session['type'];
            $id=$session['id'];
        @endphp


        <form action="" class="w-full h-screen grid place-content-center spiner" id="parent_form" >
            @csrf
            <i data-lucide="loader-circle" id="indicator"  class="htmx-indicator loader" ></i>

            <div hx-post="{{route('service.payment.htmx',['id'=>$id,'type'=>$type])}}" 
                hx-trigger="load" 
                hx-swap="outerHTML" 
                hx-indicator="#indicator"
                hx-target="#parent_form"
                hx-select="#htmx_target"
            >
            </div>
            
        </form>
    
    @endsession
 

@endsection