<x-app-layout>

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-2 bg-blue-900 text-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-center font-bold text-lg uppercase sm:text-2xl" >Gestion des communiqués</h1>
            </div>
        </div>
    </div>


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

   

    <form action="{{route('dashboard.administration.action')}}" method="POST" id="validation_formulaire" >
        @csrf
        @method('PATCH')

        <div class="flex w-full justify-center sm:justify-end" >
            <button class="btn btn-success  text-white mx-4" >Valider les modifications</button>
        </div>
            
        <div class="w-full overflow-x-scroll md:overflow-x-hidden p-4 " >
            {{$communiques->links()}}
            <table class="w-full my-8 border-collapse " >
                <thead class="bg-blue-600  text-basic_white_color " >
                    <tr class="" >
                        <th class=" uppercase  p-2  text-center text-lg" >ID</th>
                        <th class=" uppercase  p-2  text-center text-lg" >Auteur</th>
                        <th class=" uppercase  p-2  text-center text-lg" >Information</th>
                        <th class=" uppercase  p-2  text-center text-lg whitespace-nowrap" >déja payé ?</th>
                        <th class=" uppercase  p-2  text-center text-lg" >status</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-900" >
                    @forelse ($communiques as $communique )
                        
                        <tr class="border-solid border-b-4 p-2  border-blue-400 text-center text-basic_white_color text-lg h-full" >
                            <td class="border-solid  p-2 border-black text-center text-basic_white_color text-lg" >
                                <em>#{{$communique->id}}</em>
                            </td>
                            
                            <td class="border-solid  p-2 border-black text-center  text-lg" >
            
                                @include('webradio.service.communique.auteur_info')
                            </td>
                            <td class="border-solid  p-2 border-black text-center text-lg" >
            
                                @include('webradio.service.communique.detail')
                            </td>
                            <td class="border-solid  p-2 border-black text-center text-lg" >
                                @if ($communique->isPaid)
                                    <span class="text-basic_white_color bg-green-500 p-2" >OUI</span>
                                @else
                                    <span class="text-basic_white_color bg-red-500 p-1" >NON</span>
                                @endif
            
                            </td>
                            <td class="border-solid  p-2 border-black text-center text-lg flex justify-center " >
                                @php
                                    $options=[
                                     'pending'=>'en attente',
                                     'broadcast'=>'en cours de diffusion',
                                     'broadcast_completed'=>'diffusion terminé'
                                    ];
            
                                @endphp
                                <select name="status[{{$communique->id}}]" class=" uppercase bg-green-950 text-center text-sm " >
                                   @foreach ($options as $key=>$option)
                                        <option class="uppercase text-sm " value="{{$key}}" @selected($key===$communique->communique_status)  >{{$option}}</option>
                                   @endforeach
                                </select>
            
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 text-2xl capitalize font-bold bg-basic_white_color  text-center" >vide</td>
                        </tr>
                    @endforelse
            
                </tbody>
            </table>
            {{$communiques->links()}}
            </div>
        </form>
   
</x-app-layout>
