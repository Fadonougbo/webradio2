
    
<!-- Formulaire pour modifier une categorie -->
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

    <div class="pb-10"  >
        <div class="py-12 ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 sm:w-[80%] ">
                <div class="p-2 bg-blue-900 text-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <h1 class="text-center font-bold text-lg uppercase sm:text-2xl" >Modifier le nom d'une categorie</h1>
                </div>
            </div>
        </div>

        <form action="{{route('dashboard.update.categorie',['categorie'=>$categorie])}}" method="POST" class="w-full flex justify-center" id="categorie_form" >

            @csrf
            @method('PATCH')

            <div class="flex flex-col w-[90%] space-y-6 md:w-1/2 lg:w-1/3" >

                <label for="categorie_name" class="text-lg font-semibold" >Saisissez le nom de la categorie    (important) </label>

                <input type="text"  name="categorie_name" id="categorie_name" value="{{old('categorie_name',$categorie->name) }}">
                @error('categorie_name')
                    <p class="text-basic_primary_color my-2" >{{$message}}</p>
                @enderror

                <button class="btn btn-success text-xl text-white capitalize"   >Valider les modifications</button>
                
            </div>
            
        </form>
    </div>


</x-app-layout>

