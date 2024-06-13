@extends('webradio.service.shared.base')

@section('title','Payment procédure')

@section('content')

 @session('created_successfully') 

    @php
        $session=session('created_successfully');
        $type=$session['type'];
        $id=$session['id'];
    @endphp

    <div></div>

    <form action="" class="w-full h-screen grid place-content-center spiner" id="parent_form" >
        @csrf
        <i data-lucide="loader-circle" id="indicator"  class="htmx-indicator size-48  animate-spin" ></i>

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