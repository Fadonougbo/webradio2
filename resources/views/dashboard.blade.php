<x-app-layout>


    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-2 bg-blue-900 text-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-center font-bold text-2xl uppercase" >La liste de vos demandes</h1>
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

        @session('paiment_success')
            <message-toast type="success" msg="Paiement effectiue avec success" delay="3000" ></message-toast>
        @endsession

        <h3 class="text-xl flex items-center font-semibold" > <i data-lucide="arrow-big-right" class="size-8" ></i> Communiqué </h3>

        <table class="w-full my-8 border-collapse " >
            <thead class="bg-blue-600  text-basic_white_color " >
                <tr class="" >
                    <th class=" uppercase  p-2  text-center text-lg" >ID</th>
                    <th class=" uppercase  p-2  text-center text-lg" >programme de diffusion</th>
                    <th class=" uppercase  p-2  text-center text-lg" >Information</th>
                    <th class=" uppercase  p-2  text-center text-lg" >déja payé ?</th>
                    <th class=" uppercase  p-2  text-center text-lg" >Action</th>
                </tr>
            </thead>
            <tbody class="bg-gray-900" >
                @forelse ($communiques as $communique )

                    @php
                       
                        $programmes=$communique->programmes;
                        
                    @endphp

                    <tr class="border-solid border-b-4 p-2 border-blue-400 text-center text-basic_white_color text-lg h-full" >

                        <td class="border-solid  p-2 border-black text-center text-basic_white_color text-lg" >#{{$communique->id}}</td>

                        <td class="border-solid  p-2 border-black text-center text-lg" >
                            <ul class="text-basic_white_color" >
                                @foreach ($programmes as $programme)
                                    <li class="list-disc list-inside" > {{$programme->programme_date}} {{$programme->programme_hour}}   </li>
                                @endforeach
                            </ul>
                        </td>

                        <td class="border-solid  p-2 border-black text-center text-lg" >
                                
                            @include('webradio.service.communique.detail')
                        </td>
                        <td class="border-solid  p-2 border-black text-center text-lg" >

                            @if ($communique->isPaid)
                                <span class="text-basic_white_color" >OUI</span> 
                            @else
                                
                                <span class="text-basic_white_color" >NON</span> 

                                <a href="{{route('service.payment.old.payment.validation',['id'=>$communique->id,'type'=>'communique'])}}" class="text-blue-300 underline block" target="_blank" >cliquez ici pour payer</a>
                                
                            @endif
                           
                                

                        </td>
                        
                        <td class="border-solid  p-2 border-black text-center text-lg items-center justify-center lg:flex  " >

                            <a href="{{route('service.communique.update.view',['communique'=>$communique])}}" class="bg-green-900 my-4  text-basic_white_color px-4 py-1 rounded lg:mx-4" >Modifier</a>

                            <form action="{{route('service.communique.delete',['communique'=>$communique])}}" method="POST" >
                                @csrf 
                                @method('delete')
                                <button type="submit" class="bg-red-800 my-6 text-basic_white_color p-1 rounded" > Supprimer</button>
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
