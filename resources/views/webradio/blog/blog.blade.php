<x-app-layout>



    @session('success')
            <message-toast type="success" msg="{{session('success')}}" delay="3000" ></message-toast>
    @endsession

    @session('error')
            <message-toast type="error" msg="{{session('error')}}" delay="3000" ></message-toast>
    @endsession

    <h3 class="text-xl mt-4 flex items-center font-semibold" > 
        <i data-lucide="arrow-big-right" class="size-8" ></i> Articles de blog 
        <a href="{{route('dashboard.blog.create.article')}}" class="mx-6 text-lg text-blue-800 underline" >Créer un article de blog</a>
    </h3>
    
    <h3 class="text-xl mt-4 flex items-center font-semibold" > 
        <i data-lucide="arrow-big-right" class="size-8" ></i> Categories 
        <a href="{{route('dashboard.configuration')}}#create_categorie" class="mx-6 text-lg text-blue-800 underline" >Créer une categorie</a>
    </h3>

    <div class="w-full flex flex-col items-center overflow-x-scroll md:overflow-x-hidden p-4 " ><!-- overflow-x-scroll md:overflow-x-hidden -->

        <table class="w-full my-4 border-collapse  sm:w-1/2" >
            <thead class="bg-blue-600  text-basic_white_color " >
                <tr class="" >
                    <th class=" uppercase  p-2  text-center text-lg" >Nom</th>
                    <th class=" uppercase  p-2  text-center text-lg" >Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-900" >
                @forelse ($categories as $categorie )

                    <tr class="border-solid border-b-4 p-2 border-blue-400 text-center text-basic_white_color text-lg h-full" >

                        <td class="border-solid  p-2 border-black  text-center text-xl" >
                                
                            {{$categorie->name}}
                        </td>
                        
                        <td class="border-solid space-x-4 p-2 border-black text-center text-lg items-center justify-center flex " >
                                <a href="{{route('dashboard.update.categorie',['categorie'=>$categorie])}}" class="bg-green-900 my-4   text-basic_white_color px-4 py-1 rounded lg:mx-4" >Modifier</a>

                                <form action="{{route('dashboard.delete.categorie',['categorie'=>$categorie])}}" method="POST" >
                                        @csrf 
                                        @method('delete')
                                        <delete-button></delete-button>
                                </form>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="py-4 text-2xl capitalize font-bold bg-basic_white_color  text-center" >vide</td>
                    </tr>

                @endforelse
               
            </tbody>
        </table>
   </div>
    
    

</x-app-layout>
