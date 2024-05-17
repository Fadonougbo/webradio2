@extends('webradio.programme.base')

@section('title',"Grille des programmes")

@section('content')
    

    <main class="p-4" >
        <div>
            <h1 class='text-4xl uppercase text-center my-4 font-semibold' >lundi</h1>
            <section class="w-1/2 h-[50rem] flex items-center " >
                <img  class="size-full mx-2" src="{{asset('images/prog1.jpg')}}" alt="programmation ">
                <img class="size-full" src="{{asset('images/prog1_suite.jpg')}}" alt="programmation ">
            </section>
        </div>
        <div  class='flex flex-col items-center'  >
            <h1 class='text-4xl uppercase text-center my-4 font-semibold' >mardi</h1>
            <section class="w-1/2 h-[40rem] flex flex-col items-center" >
                <img  class="size-full" src="{{asset('images/prog3.jpg')}}" alt="programmation ">
            </section>
        </div>
        <div class='flex flex-col items-center' >
            <h1 class='text-4xl uppercase text-center my-4 font-semibold' >mercredi</h1>
            <section class="w-1/2 h-[40rem] flex flex-col items-center" >
                <img  class="size-full" src="{{asset('images/prog4.jpg')}}" alt="programmation ">
            </section>
        </div>
        <div class='flex flex-col items-center' >
            <h1 class='text-4xl uppercase text-center my-4 font-semibold' >jeudi</h1>
            <section class="w-1/2 h-[40rem] flex flex-col items-center" >
                <img  class="size-full" src="{{asset('images/prog5.jpg')}}" alt="programmation ">
            </section>
        </div>
        <div class='flex flex-col items-center' >
            <h1 class='text-4xl uppercase text-center my-4 font-semibold' >vendredi</h1>
            <section class="w-1/2 h-[40rem] flex flex-col items-center" >
                <img  class="size-full" src="{{asset('images/prog6.jpg')}}" alt="programmation ">
            </section>
        </div>
        <div class='flex flex-col items-center' >
            <h1 class='text-4xl uppercase text-center my-4 font-semibold' >samedi</h1>
            <section class="w-1/2 h-[40rem] flex flex-col items-center" >
                <img  class="size-full" src="{{asset('images/prog7.jpg')}}" alt="programmation ">
            </section>
        </div>
        <div class='flex flex-col items-center' >
            <h1 class='text-4xl uppercase text-center my-4 font-semibold' >dimanche</h1>
            <section class="w-1/2 h-[40rem] flex flex-col items-center" >
                <img  class="size-full" src="{{asset('images/prog8.jpg')}}" alt="programmation ">
            </section>
        </div>
    </main>

@endsection