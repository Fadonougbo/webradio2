<a class=" transition-all group block " href="{{route('home.show',['article'=>$article,'slug'=>$article->article_slug])}}" >

    <div class="my-10  rounded mx-6 hover:opacity-85 " >
        <section class="w-full  h-48 my-4 relative" >
            <img src='{{asset("storage/$img")}}' loading="lazy" class="size-full " alt="actu image">
            <span class="absolute top-4 left-4 text-sm uppercase bg-basic_primary_color/80 text-basic_white_color px-2 rounded-full" >{{$date}}</span>
        </section>
        <section class="my-2" >
            <span class="text-xl  font-extrabold text-center my-4 group-hover:text-basic_primary_color"  >{{$title}}</span>
            <p class="opacity-75  font-bold  text-sm flex items-center" > <i data-lucide="circle-user-round" class="mx-1 size-4" ></i> {{$author}}</p>
        </section>
    </div>

</a>