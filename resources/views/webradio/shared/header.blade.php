<header class="p-2 shadow  bg-black  items-center h-16 tm:h-24 fixed top-0 z-10 w-full  " >

        <div class="w-full flex justify-between items-start" >

            <div class="h-12 w-16 flex items-center" >
                <img src="{{asset('images/rtulogo1.jpg')}}" loading="lazy" class="size-full flex-none" alt="RTU logo">
                <span class="text-basic_white_color uppercase font-bold text-xl mx-2 " >95.3 FM</span>
            </div>
            
            <nav class="  w-[93%] " >
             
                    <section class="w-full text-basic_white_color uppercase hidden items-center tm:flex tm:justify-evenly" >
                        <a href="{{route('home')}}"  @class(['transition-all font-bold hover:text-basic_primary_color',
                        'decoration-solid underline underline-offset-4 decoration-4 decoration-basic_primary_color'=>request()->routeIs('home')]) >
                            Accueil
                        </a>
                        <menu-deroulant></menu-deroulant>
                        <a href="{{asset('pdf/prog.pdf')}}" class="transition-all font-bold hover:text-basic_primary_color" download="programme.pdf" >
                            Grille des programmes
                        </a>
                        <a href="{{route('grille')}}"  @class(['transition-all font-bold hover:text-basic_primary_color',
                        'decoration-solid underline underline-offset-4 decoration-4 decoration-basic_primary_color'=>request()->routeIs('grille')]) >Grille tarifaire</a>


                        @auth
                            <div class="border-l items-center border-solid hidden border-basic_white_color text-sm xl:flex " >
                                <a href="/dashboard" class="mx-2 transition-all font-bold hover:text-basic_primary_color" >dashboard</a>
                                <form action="/logout" method="POST" class=" items-center " >
                                @csrf
                                    <button class="font-bold mx-3 bg-basic_primary_color p-1 rounded" >Deconnexion</but>
                                </form>
                            </div>
                        @endauth
                        @guest
                            <div class="border-l items-center border-solid hidden border-basic_white_color text-sm xl:flex " >
                                <a href="/login" class="mx-2 transition-all font-bold hover:text-basic_primary_color" >se connecter</a>
                                <a href="/register" class="transition-all font-bold bg-basic_primary_color p-1 rounded" >Créer un compte</a>
                            </div>
                        @endguest
                    </section>
                  
                    <section class="flex justify-center w-full mt-4" >
                        <online-radio ></online-radio>
                    </section>
            </nav>

            <menu-burger class="xl:hidden" ></menu-burger>
        </div>
  
    </header>