<x-app-layout>

   


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

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-2 bg-blue-900 text-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-center font-bold text-lg uppercase sm:text-2xl" >Modification du prix</h1>
            </div>
        </div>
    </div>

    <div>
       
        <form action="{{route('dashboard.configuration.price')}}" method="POST" class="w-full flex justify-center" >

            @csrf

            @method('PATCH')

            <div class="flex flex-col w-[90%] space-y-6 md:w-1/2 lg:w-1/3" >

                <select name="name" id="">
                    @foreach ($services as $service)
                        <option value="{{$service->name}}">{{$service->name}}</option>
                    @endforeach
                
                </select>

                @error('name')
                    <p class="text-basic_primary_color my-2" >{{$message}}</p>
                @enderror

                <input type="number"  min="1" name="price" value="{{$services[0]->price}}">
                @error('price')
                    <p class="text-basic_primary_color my-2" >{{$message}}</p>
                @enderror

                <button class="btn btn-success text-lg text-white capitalize"  >valider</button>
                
            </div>
            
        </form>
    </div>



   
</x-app-layout>
