@can('show_superadmin_interface')
    

<x-app-layout  >

    @if($errors->any())
        <message-toast type="info" msg="Une erreur est surevenue, veuillez  réessayer à nouveau." delay="15000" ></message-toast>
        <!--  @foreach ($errors->all() as $err)
                <p>{{$err}}</p>
            @endforeach  -->
    @endif

    @session('success')
            <message-toast type="success" msg="{{session('success')}}" delay="3000" ></message-toast>
    @endsession

    @session('error')
            <message-toast type="error" msg="{{session('error')}}" delay="3000" ></message-toast>
    @endsession

   

    <section class="flex flex-col w-full lg:flex-row lg:items-start space-y-16 lg:space-y-0" >
        <div class="w-full" >
            <div class="py-12 ">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 sm:w-[80%] " >
                    <div class="p-2 bg-blue-900 text-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <h1 class="text-center font-bold text-lg uppercase sm:text-2xl" >Modification des prix</h1>
                    </div>
                </div>
            </div>
            <form action="{{route('dashboard.configuration.price')}}" method="POST" class="w-full flex justify-center" >
                @csrf
                @method('PATCH')
                <div class="flex flex-col w-[80%] sm:px-6  space-y-6 " >
                    <select name="name" required >
                        @foreach ($services as $service)
                            <option value="{{$service->name}}">{{$service->name}}</option>
                        @endforeach
        
                    </select>
                    @error('name')
                        <p class="text-basic_primary_color my-2" >{{$message}}</p>
                    @enderror
                    <label for="price" class="text-lg font-semibold" >Saisissez le prix  (important) </label>
                    <input type="number"    min="1" name="price" id="price" value="{{old('price',$services[0]->price) }}" required>
                    @error('price')
                        <p class="text-basic_primary_color my-2" >{{$message}}</p>
                    @enderror
                    <button class="btn btn-success text-2xl text-white capitalize"  >valider</button>
        
                </div>
        
            </form>
        </div>
        
        <div class="pb-10 w-full" id="create_categorie" >

            <div class="py-12 ">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 sm:w-[80%] ">
                    <div class="p-2 bg-blue-900 text-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <h1 class="text-center font-bold text-lg uppercase sm:text-2xl" >Creation des catégories</h1>
                    </div>
                </div>
            </div>

            <form action="{{route('dashboard.configuration.create.categorie')}}" method="POST" class="w-full flex justify-center" id="categorie_form" >
                @csrf
                <div class="flex flex-col w-[80%] sm:px-6 space-y-6 " >

                    <label for="categorie_name" class="text-lg font-semibold" >Saisissez le nom de la categorie  (important) </label>

                    <input type="text"  name="categorie_name" id="categorie_name" value="{{old('categorie_name') }}" required>

                    @error('categorie_name')
                        <p class="text-basic_primary_color my-2" >{{$message}}</p>
                    @enderror

                    <button class="btn btn-success text-2xl text-white capitalize"   >Créer</button>
        
                </div>
        
            </form>

        </div>
    </section>


    <div class="py-20" >

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 sm:w-[80%] ">
                <div class="p-2 bg-blue-900 text-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <h1 class="text-center font-bold text-lg uppercase sm:text-2xl" >Gestion des rôles</h1>
                </div>
            </div>
        </div>

        <section class="w-full flex flex-col ite  sm:flex-row" >

            <form action="" method="POST" class="w-full  flex justify-center sm:w-2/3 lg:w-1/2" >
                @csrf
                <div class="flex flex-col w-full space-y-6 p-4" >

                    <label for="identifiant" class="text-lg font-semibold" >
                        Saisissez  l'identifiant de l'utilisateur  (important) 
                    </label>

                    <input type="number"  min="1" name="identifiant" value="1" id="identifiant" value="{{old('identifiant') }}" required>

                    @error('identifiant')
                        <p class="text-basic_primary_color my-2" >{{$message}}</p>
                    @enderror

                    <button class="btn btn-success text-2xl text-white capitalize"  
                            hx-post="{{route('dashboard.configuration.role.htmx')}}"
                            hx-swap="outerHTML"
                            hx-include="#identifiant"
                            hx-target="#card"
                            hx-trigger="click"
                            
                    >
                        Rechercher
                    </button>
            
                </div>
            
            </form>

            <div class="p-4 space-y-4  bg-gray-800 flex-grow rounded-lg " id="card" >
                <p class="text-xl text-white" >ID: <span class="mx-4 text-lg" >xxxx</span></p>
                <p class="text-xl text-white" >Nom: <span class="mx-4 text-lg" >xxxx</span> </p>
                <p class="text-xl text-white" >Prenom:<span class="mx-4 text-lg" >xxxxx</span></p>
                <p class="text-xl text-white" >Email:  <span class="mx-4 text-lg" >xxx@xxx.com</span></p>
                <p class="text-xl text-white" >Role:  <span class="mx-4 text-lg" >xxx</span></p>
            </div>

        </section>

        </div>



   
</x-app-layout>

@endcan
