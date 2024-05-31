<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-2 bg-blue-900 text-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-center font-bold text-2xl uppercase" >La liste demande en attente de validation</h1>
            </div>
        </div>
    </div>
   
   <div class="w-full overflow-x-scroll  xl:overflow-x-hidden p-4" >

        <h3 class="text-xl flex items-center font-semibold" >
             <i data-lucide="arrow-big-right" class="size-8" ></i> 
             Demande de spot publicitaire 
        </h3>

        <table class="w-full my-8 border-collapse " >
            <thead class="bg-blue-600 text-basic_white_color " >

                <tr>

                    <th class=" uppercase  p-2  text-center text-lg" >ID</th>

                    <th class=" uppercase  p-2  text-center text-lg" >auteur</th>

                    <th class=" uppercase  p-2  text-center text-lg" >rogramme de diffusion</th>

                    <th class=" uppercase  p-2  text-center text-lg" >Information</th>

                    <th class=" uppercase  p-2  text-center text-lg" >paiement effectué ?</th>

                    <th class=" uppercase  p-2  text-center text-lg" >status</th>

                </tr>

            </thead>

            <tbody class="bg-gray-900" >
                @forelse ($publicites as $publicite )

                    @php
                        $periodes=$publicite->periodes;
                    @endphp

                    <tr class="border-solid border-b-4 p-2 border-blue-400 text-center text-basic_white_color text-lg h-full" >
                        <!-- ID -->
                        <td class="border-solid  p-2 border-black text-center text-basic_white_color text-lg" >#{{$publicite->id}}</td>

                        <td class="border-solid  p-2 border-black text-center text-basic_white_color text-lg" >
                            {{$publicite->user()->get()->first()->name}}
                        </td>

                        <!-- Programme de diffusion -->
                        <td class=" w-[30%]  p-2  text-lg     " >
                            <table class="w-full  bg-gray-700 " >
                                <tr>
                                    <td>Date/Heure</td>
                                    <td>Déja diffusé ?</td>
                                </tr>
                               
                                @foreach ($periodes as $periode)
                                    <tr class="" >
                                        <td class="" >
                                            {{$periode->periode_date}} / {{$periode->periode_hour}} 
                                        </td>
                                        <td>
                                            <input type="checkbox" name="" id="">  
                                        </td>
                                        
                                    </tr> 
                                @endforeach
                            </table>
                            </td>

                        <td class="  p-2   text-lg" >
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
                                    <li class="text-basic_white_color  w-full" >
                                        <details class="my-4 w-full" >
                                            <summary>Detaille supplementaire</summary>
                                            <p ><!-- class=" h-[5rem] overflow-y-scroll"  -->
                                                {{$publicite->pub_detail}}
                                            </p>
                                            
                                        </details>
                                    </li>
                                @endif
                            </ul>
                        </td>
                        
                        <td class="border-solid w-[10%] p-2 border-black text-center text-lg" >

                            @if ($publicite->isPaid)
                                <span class="text-basic_white_color" >OUI</span> 
                            @else
                                
                                <span class="text-basic_white_color" >NON</span> 
                            @endif
                           
                        </td>

                        <td class="capitalize border-solid w-[10%]  p-2 text-center text-lg  " >
                        
                            @php
                                $status_liste=['en attente','accepté','refusé'];
                            @endphp
                            <select name="status" class="bg-amber-800 border-none">
                                @foreach ($status_liste as $status)
                                    <option value="{{$status}}" @selected($status===$publicite->status) >
                                        {{$status}}
                                    </option>
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
   </div>


   <!-- Avis de recherche -->
   <div class="w-full overflow-x-scroll sm:overflow-x-hidden p-4" >

        @session('is_delete')
            <message-toast type="success" msg="Suppression reussie" delay="3000" ></message-toast>
        @endsession

        @session('paiment_success')
            <message-toast type="success" msg="Paiement effectiue avec success" delay="3000" ></message-toast>
        @endsession

        <h3 class="text-xl flex items-center font-semibold" > <i data-lucide="arrow-big-right" class="size-8" ></i> Avis de recherche</h3>

        
</div>

</x-app-layout>
