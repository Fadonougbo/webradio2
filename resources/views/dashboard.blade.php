<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-2 bg-blue-900 text-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-center font-bold text-2xl uppercase" >La liste de vos demandes</h1>
            </div>
        </div>
    </div>

    @session('success_update')
            <message-toast type="success" msg="Les modifications ont été prises en compte" delay="3000" ></message-toast>
    @endsession

   <div class="w-full overflow-x-scroll sm:overflow-x-hidden p-4" >

        @session('is_delete')
            <message-toast type="success" msg="Suppression reussie" delay="3000" ></message-toast>
        @endsession

        @session('paiment_success')
            <message-toast type="success" msg="Paiement effectiue avec success" delay="3000" ></message-toast>
        @endsession

        <h3 class="text-xl flex items-center font-semibold" > <i data-lucide="arrow-big-right" class="size-8" ></i> Demande de spot publicitaire </h3>

        <table class="w-full my-8 border-collapse " >
            <thead class="bg-blue-600 text-basic_white_color " >
                <tr>
                    <th class=" uppercase  p-2  text-center text-lg" >ID</th>
                    <th class=" uppercase  p-2  text-center text-lg" >programme de diffusion</th>
                    <th class=" uppercase  p-2  text-center text-lg" >Information</th>
                    <th class=" uppercase  p-2  text-center text-lg" >paiement effectué ?</th>
                    <th class=" uppercase  p-2  text-center text-lg" >status</th>
                    <th class=" uppercase  p-2  text-center text-lg" >Action</th>
                </tr>
            </thead>
            <tbody class="bg-gray-900" >
                @forelse ($publicites as $publicite )

                    @php
                       
                        $periodes=$publicite->periodes;
                    @endphp

                    <tr class="border-solid border-b-4 p-2 border-blue-400 text-center text-basic_white_color text-lg h-full" >
                        <td class="border-solid  p-2 border-black text-center text-basic_white_color text-lg" >#{{$publicite->id}}</td>
                        <td class="border-solid  p-2 border-black text-center text-lg" >
                            <ul class="text-basic_white_color" >
                                @foreach ($periodes as $periode)
                                    <li class="list-disc list-inside" > {{$periode->periode_date}} {{$periode->periode_hour}}   </li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="border-solid  p-2 border-black text-center text-lg" >
                            <ul>
                                @php
                                    $path='storage/'. $publicite->pub_file
                                @endphp
                                <li> 
                                    <a class="text-blue-300 underline" href="{{asset($path)}}" download="{{$publicite->pub_file}}" >
                                        Voir le document ajouté
                                    </a>
                                </li>
                                @if ($publicite->pub_detail)
                                    <li class="text-basic_white_color" >
                                        <details class="my-4" >
                                            <summary>Details supplementaire</summary>
                                            {{$publicite->pub_detail}}
                                        </details>
                                    </li>
                                @endif
                            </ul>
                        </td>
                        <td class="border-solid  p-2 border-black text-center text-lg" >

                            @if ($publicite->isPaid)
                                <span class="text-basic_white_color" >OUI</span> 
                            @else
                                
                                <span class="text-basic_white_color" >NON</span> 

                                @if ($publicite->status==='accepté')
                                    <br/>
                                    <a href="{{route('service.paiment.redirect',['publicite'=>$publicite])}}" class="text-blue-300 underline" target="_blank" >cliquez ici pour payer</a>
                                @endif
                                
                            @endif
                           
                                

                        </td>
                        @php
                            
                            $class='capitalize border-solid  text-orange-500 p-2 border-black text-center text-lg';
                            if($publicite->status==='accepté') {
                                $class='capitalize border-solid  text-green-500 p-2 border-black text-center text-lg';
                            }else if($publicite->status==='refusé') {
                                $class='capitalize border-solid  text-red-500 p-2 border-black text-center text-lg';
                            }
                        @endphp
                        <td  class="{{$class}}" >

                            @if($publicite->status==='accepté') 
                                Demande acceptée
                            @elseif($publicite->status==='refusé') 
                                Demande refusée
                            @else  
                                Demande en attente de validation
                            @endif
                        
                        </td>

                        <td class="border-solid  p-2 border-black text-center text-lg items-center lg:flex  " >

                            <a href="{{route('service.publicite.update',['publicite'=>$publicite])}}" class="bg-green-900 my-4  text-basic_white_color px-4 py-1 rounded lg:mx-4" >Modifier</a>

                            <form action="{{route('service.publicite.delete',['publicite'=>$publicite])}}" method="POST" >
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


   <!-- Avis de recherche -->
   <div class="w-full overflow-x-scroll sm:overflow-x-hidden p-4" >

        @session('is_delete')
            <message-toast type="success" msg="Suppression reussie" delay="3000" ></message-toast>
        @endsession

        @session('paiment_success')
            <message-toast type="success" msg="Paiement effectué avec success" delay="3000" ></message-toast>
        @endsession

        @session('paiment_error')
            <message-toast type="error" msg="Paiement non effectué " delay="3000" ></message-toast>
        @endsession

        <h3 class="text-xl flex items-center font-semibold" > <i data-lucide="arrow-big-right" class="size-8" ></i> Avis de recherche</h3>

        <table class="w-full my-8 border-collapse " >
        <thead class="bg-blue-600 text-basic_white_color " >
            <tr class="" >
                <th class=" uppercase  p-2  text-center text-lg" >ID</th>
                <th class=" uppercase  p-2  text-center text-lg" >programme de diffusion</th>
                <th class=" uppercase  p-2  text-center text-lg" >Information</th>
                <th class=" uppercase  p-2  text-center text-lg" >paiement effectué ?</th>
                <th class=" uppercase  p-2  text-center text-lg" >status</th>
                <th class=" uppercase  p-2  text-center text-lg" >Action</th>
            </tr>
        </thead>
        <tbody class="bg-gray-900" >
            @forelse ($adr as $avis )

                @php
                
                    $periodes=$avis->periodes;
                @endphp

                <tr class="border-solid border-b-4 p-2 border-blue-400 text-center text-basic_white_color text-lg h-full" >
                    <td class="border-solid  p-2 border-black text-center text-basic_white_color text-lg" >#{{$avis->id}}</td>
                    <td class="border-solid  p-2 border-black text-center text-lg" >
                        <ul class="text-basic_white_color" >
                            @foreach ($periodes as $periode)
                                <li class="list-disc list-inside" > {{$periode->periode_date}} {{$periode->periode_hour}}   </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="border-solid  p-2 border-black text-center text-lg" >
                        <ul>
                            @php
                                $path='storage/'. $avis->adr_file
                            @endphp
                            <li> 
                                <a class="text-blue-300 underline" href="{{asset($path)}}" download="{{$avis->adr_file}}" >
                                    Voir le document ajouté
                                </a>
                            </li>
                            @if ($avis->adr_detail)
                                <li class="text-basic_white_color" >
                                    <details class="my-4" >
                                        <summary>Details supplementaire</summary>
                                        {{$avis->adr_detail}}
                                    </details>
                                </li>
                            @endif
                        </ul>
                    </td>
                    <td class="border-solid  p-2 border-black text-center text-lg" >

                        @if ($avis->isPaid)
                            <span class="text-basic_white_color" >OUI</span> 
                        @else
                            
                            <span class="text-basic_white_color" >NON</span> 

                            @if ($avis->status==='accepté')
                                <br/>
                                <a href="{{route('service.adr.paiment.redirect',['avisDeRecherche'=>$avis])}}" class="text-blue-300 underline" target="_blank" >cliquez ici pour payer</a>
                            @endif
                            
                        @endif
                    
                            

                    </td>


                    @php
                            
                        $class='capitalize border-solid  text-orange-500 p-2 border-black text-center text-lg';
                        if($avis->status==='accepté') {
                            $class='capitalize border-solid  text-green-500 p-2 border-black text-center text-lg';
                        }else if($avis->status==='refusé') {
                            $class='capitalize border-solid  text-red-500 p-2 border-black text-center text-lg';
                        }
                    @endphp
                    <td  class="{{$class}}" >
                        {{$avis->status}}
                    </td>

                <td class="border-solid  p-2 border-black text-center text-lg items-center lg:flex  " >
                        
                        <a href="{{route('service.adr.update',['avisDeRecherche'=>$avis])}}" class="bg-green-900 my-4  text-basic_white_color px-4 py-1 rounded lg:mx-4" >Modifier</a>
                        
                        <form action="{{route('service.adr.delete',['avisDeRecherche'=>$avis])}}" method="POST" >
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
