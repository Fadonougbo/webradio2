<header class="p-2 shadow  bg-black  items-center h-28 " >

        <div class="w-full flex justify-between items-center" >

            <div class="h-12 w-16 flex items-center" >
                <img src="{{asset('images/rtulogo1.jpg')}}" class="size-full" alt="RTU logo">
                <span class="text-basic_white_color uppercase font-bold text-xl mx-2 " >95.3 FM</span>
            </div>
            
            <nav class="text-basic_white_color uppercase hidden items-center tm:flex tm:justify-evenly  w-[93%] " >
             
                    <a href="{{route('home')}}"  @class(['transition-all font-bold hover:text-basic_primary_color',
                    'decoration-solid underline underline-offset-4 decoration-4 decoration-basic_primary_color'=>request()->routeIs('home')]) >
                        Accueil
                    </a>
            
                    <menu-deroulant></menu-deroulant>
                    <a href="{{route('home')}}#actu" class="transition-all font-bold hover:text-basic_primary_color" >Actualités</a>

                    <a href="{{asset('pdf/prog.pdf')}}" class="transition-all font-bold hover:text-basic_primary_color" download="programme.pdf" >
                        Grille des programmes
                    </a>
            
                    <a href="#" class="transition-all font-bold hover:text-basic_primary_color" >Grille tarifaire</a>

                    <a href="{{route('home')}}#replay" class="transition-all font-bold hover:text-basic_primary_color hidden xl:block" >Podcast</a>

                    @auth
                    
                        <form action="/logout" method="POST" class="border-l items-center border-solid hidden border-basic_white_color text-sm xl:flex" >
                            @csrf
                            <button class="font-bold mx-3 bg-basic_primary_color p-1 rounded" >Deconnexion</button>
                        </form>
                    @endauth

                    @guest
                        <div class="border-l items-center border-solid hidden border-basic_white_color text-sm xl:flex " >
                            <a href="/login" class="mx-2 transition-all font-bold hover:text-basic_primary_color" >se connecter</a>
                            <a href="/register" class="transition-all font-bold bg-basic_primary_color p-1 rounded" >Créer un compte</a>
                        </div>
                    @endguest
            </nav>

            <menu-burger fcsrf='{{csrf_token()}}' fuser_status='{{Auth::check()}}' class="xl:hidden" ></menu-burger>
        </div>
        <div class="flex justify-center w-full mt-4" >
            <online-radio ></online-radio>
        </div>
    </header>