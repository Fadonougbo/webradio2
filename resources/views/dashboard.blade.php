<x-app-layout>


    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-2 bg-blue-900 text-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-center font-bold text-lg uppercase sm:text-2xl" >La liste de vos demandes</h1>
            </div>
        </div>
    </div>


    @session('success')
            <message-toast type="success" msg="{{session('success')}}" delay="3000" ></message-toast>
    @endsession

    @session('error')
            <message-toast type="error" msg="{{session('error')}}" delay="3000" ></message-toast>
    @endsession

   <div class="w-full overflow-x-scroll md:overflow-x-hidden p-4 " ><!-- overflow-x-scroll md:overflow-x-hidden -->


        <h3 class="text-xl flex items-center font-semibold" > <i data-lucide="arrow-big-right" class="size-8" ></i> Communiqué </h3>

        <table class="w-full my-8 border-collapse " >
            <thead class="bg-blue-600  text-basic_white_color " >
                <tr class="" >
                    <th class=" uppercase  p-2  text-center text-lg" >ID</th>
                    <th class=" uppercase  p-2  text-center text-lg" >Information</th>
                    <th class=" uppercase  p-2  text-center text-lg" >déja payé ?</th>
                    <th class=" uppercase  p-2  text-center text-lg" >prix</th>
                    <th class=" uppercase  p-2  text-center text-lg" >Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-900" >
                @forelse ($communiques as $communique )

                    

                    <tr class="border-solid border-b-4 p-2 border-blue-400 text-center text-basic_white_color text-lg h-full" >

                        <td class="border-solid  p-2 border-black text-center text-basic_white_color text-lg" >#{{$communique->id}}</td>

                        <td class="border-solid  p-2 border-black text-center text-lg" >
                                
                            @include('webradio.service.communique.detail')
                        </td>
                        <td class="border-solid  p-2 border-black text-center text-lg" >
            
                            
                            @if ($communique->isPaid)
                                 <span class="text-basic_white_color bg-green-500 p-2" >OUI</span>
                            @else
                                
                                <span class="text-basic_white_color bg-red-500 p-1" >NON</span>

                                <a href="{{route('service.payment.old.payment.validation',['id'=>$communique->id,'type'=>'communique'])}}" class="text-blue-300  whitespace-nowrap underline block" target="_blank" >cliquez ici pour payer</a>
                                
                            @endif
                           

                        </td>
                        <td class="border-solid whitespace-nowrap  p-2 border-black text-center text-lg" >
                            @if ($communique->isPaid)
                                {{$communique->price}} fcfa
                            @else
                                {{ ( new App\Models\Service() )->getAmount('communique',$communique->id)}} fcfa
                            @endif
                        </td>

                       
                        
                        <td class="border-solid  p-2 border-black text-center text-lg items-center justify-center lg:flex  " >
                            @if ($communique->communique_status==='broadcast')
                                <span class="text-amber-600" >La diffusion de ce communiqué à déja debuté</span>
                            @endif

                            @if (in_array($communique->communique_status,['pending']))
                                <a href="{{route('service.communique.update.view',['communique'=>$communique])}}" class="bg-green-900 my-4  text-basic_white_color px-4 py-1 rounded lg:mx-4" >Modifier</a>
                            @endif

                            @if (in_array($communique->communique_status,['pending','broadcast_completed']))
                                <form action="{{route('service.communique.delete',['communique'=>$communique])}}" method="POST" >
                                    @csrf 
                                    @method('delete')
                                    @if ($communique->communique_status==='broadcast_completed')
                                        <span class="text-green-600 block w-96" >La diffusion de ce communiqué sur la période choisie à été éffectué</span>
                                    @endif
                                    <delete-button></delete-button>
                                </form>
                            @endif

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
