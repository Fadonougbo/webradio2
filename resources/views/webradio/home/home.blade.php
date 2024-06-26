@extends('webradio.home.base')

@section('title',"Radio Trait d'Union")

@section('specifique_resource')
  @vite(['resources/webradio_frontend/home/ActuCarouselComponent.tsx'])  
@endsection


@section('content')

    <main class="p-1 overflow-x-hidden" >
        <!-- Carousel -->
         <div class="mt-20 tm:mt-32 min-h-44 " >
            <!-- Cet element sera remplacer par le carousel  -->
           <section class="w-full flex justify-evenly"
             hx-get="{{route('home.carousel.htmx')}}"
             hx-swap="outerHTML"
             hx-trigger="load"
            >

                <div class="skeleton size-60 bg-slate-600 hidden lg:block lg:w-[30%]"></div>

                <div class="skeleton size-60 bg-slate-600 hidden tm:block tm:w-[40%] lg:w-[30%]"></div>

                <div class="skeleton h-60 bg-slate-600  w-full tm:w-[40%] lg:w-[30%]"></div>

            </section>

         </div>


        @if (!$firstCategorie->articles->isEmpty())

            <div class="my-10 " id="actu" >
                
                    {{--<section class="w-full flex justify-center" >
                        <h2 class="text-xl w-full shadow-2xl my-4 p-1 rounded uppercase bg-basic_primary_color text-basic_white_color text-center font-semibold  md:text-2xl sm:w-[90%]" >{{$firstCategorie->name}}</h2>
                    </section>--}}
                    
                    <div class="divider divider-center divider-error p-6 font-semibold before:h-2 after:h-2 before:bg-basic_primary_color/90 after:bg-basic_primary_color/90 uppercase text-lg">
                    
                        {{$firstCategorie->name}}
                    </div>
                    
            
                

            @include('webradio.home.section_une')

                <section class="flex justify-center uppercase" >
                    <a class="text-basic_primary_color border-solid border-[1px] border-basic_primary_color font-semibold  p-2 rounded-sm text-lg text-center hover:opacity-75 " href="{{route('home.show.categorie',['categorie'=>$firstCategorie,'name'=>$firstCategorie->name])}}" >Afficher plus </a>
                </section>
                
            </div>

        @endif

        
        @include('webradio.home.other_section')

        <div class="w-full flex justify-center flex-wrap"  >

           {{--  <a class="p-1 bg-indigo-800 text-basic_white_color rounded  inline-block" href="{{route('home.show.categorie',['categorie'=>$firstCategorie->id,'name'=>$firstCategorie->name])}}">{{$firstCategorie->name}}</a>

            @foreach ($otherCategories as $other) 

                <a class="p-1 bg-indigo-800 text-basic_white_color rounded  inline-block" href="{{route('home.show.categorie',['categorie'=>$other->id,'name'=>$other->name])}}">{{$other->name}}</a>

            @endforeach --}}

        </div>
       

       {{--  <div class="my-6" id="replay" >
            <p class="text-2xl text-center" >Retrouver ici en replay les revues de presse en français et en langue fon</p>
        </div>

        <section class="my-6 grid sm:grid-cols-2 lg:grid-cols-3" >
            <div class="w-full    my-8 h-40 bg-[url('../../../../public/images/radio2.jpg')] bg-contain bg-center bg-no-repeat relative p-2 flex justify-center sm:mx-4" >
                    <audio src="{{asset('audios/opinion1.mp3')}}" class=" absolute bottom-2  h-8" controls ></audio>
                    <span class="absolute top-4 left-[20%] text-sm uppercase bg-basic_primary_color text-basic_white_color px-2 rounded-full" >7 mai 2024</span>
            </div>

            <div class="w-full  my-8 h-40 bg-[url('../../../../public/images/radio2.jpg')] bg-contain bg-center bg-no-repeat relative p-2 flex justify-center sm:mx-4 "  >
                    <audio src="{{asset('audios/fr2.mp3')}}" class=" absolute bottom-2  h-8" controls ></audio>
                    <span class="absolute top-4 left-[20%] text-sm uppercase bg-basic_primary_color text-basic_white_color px-2 rounded-full" >7 mai 2024</span>
            </div>

            <div class="w-full   my-8 h-40 bg-[url('../../../../public/images/radio2.jpg')] bg-contain bg-center bg-no-repeat relative p-2 flex justify-center sm:mx-4" >
                    <audio src="{{asset('audios/opinion1.mp3')}}" class=" absolute bottom-2  h-8" controls ></audio>
                    <span class="absolute top-4 left-[20%] text-sm uppercase bg-basic_primary_color text-basic_white_color px-2 rounded-full" >7 mai 2024</span>
            </div>

            <div class="w-full  my-8 h-40 bg-[url('../../../../public/images/radio2.jpg')] bg-contain bg-center bg-no-repeat relative p-2 flex justify-center sm:mx-4 "  >
                    <audio src="{{asset('audios/fr2.mp3')}}" class=" absolute bottom-2  h-8" controls ></audio>
                    <span class="absolute top-4 left-[20%] text-sm uppercase bg-basic_primary_color text-basic_white_color px-2 rounded-full" >7 mai 2024</span>
            </div>
            
        </section> --}}

        <div class="my-6 bg-[url('../../../../public/images/pic5.jpg')]  bg-center bg-cover p-4 rounded flex flex-col items-center  text-basic_white_color lg:w-[90%] lg:mx-auto" >
            <h2 class=" my-2 text-2xl text-center font-bold lg:text-4xl" >Abonnez-vous à la notre newsletter</h2>
            <p class=" my-2 text-base text-center lg:text-lg" >Restez informé de toutes les actualités de votre radio préférée en temps réél</p>
            <div class="my-1 w-3/4 md:w-2/3 lg:w-2/5" >
                <input type="email" class="rounded-lg w-full p-2" name="newsletter_email" id="">
            </div>
            <div class="my-1 w-3/4 md:w-2/3 lg:w-2/5 " >
                <button type="submit" class="p-2 rounded-lg text-lg shadow w-full bg-black text-basic_white_color "  >S'abonner</button>
            </div>

        </div>
 
    </main>

@endsection