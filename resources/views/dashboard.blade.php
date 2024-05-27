<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-2  dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-center font-bold text-4xl uppercase" >La liste de vos demandes</h1>
            </div>
        </div>
    </div>

   <div class="w-full overflow-x-scroll sm:overflow-x-hidden p-4" >

        @session('is_delete')
            <message-toast type="success" msg="Suppression reussie" delay="3000" ></message-toast>
        @endsession

        @session('paiment_success')
            <message-toast type="success" msg="Paiement effectiue avec success" delay="3000" ></message-toast>
        @endsession

        <h3 class="text-xl flex items-center font-semibold" > <i data-lucide="arrow-big-right" class="size-8" ></i> Demande de spot publicitaire </h3>

        <table class="w-full my-8 border-collapse " >
            <thead class="bg-green-600 text-basic_white_color " >
                <tr class="" >
                    <th class=" uppercase  p-2  text-center text-lg" >ID</th>
                    <th class=" uppercase  p-2  text-center text-lg" >programme de diffusion</th>
                    <th class=" uppercase  p-2  text-center text-lg" >Information</th>
                    <th class=" uppercase  p-2  text-center text-lg" >paiement effectué ?</th>
                    <th class=" uppercase  p-2  text-center text-lg" >status</th>
                    <th class=" uppercase  p-2  text-center text-lg" >Action</th>
                </tr>
            </thead>
            <tbody class="bg-gray-700" >
                @forelse ($publicites as $publicite )

                    @php
                       
                        $periodes=$publicite->periodes;
                    @endphp

                    <tr>
                        <td class="border-solid border p-2 border-black text-center text-basic_white_color text-lg" >#{{$publicite->id}}</td>
                        <td class="border-solid border p-2 border-black text-center text-lg" >
                            <ul class="text-basic_white_color" >
                                @foreach ($periodes as $periode)
                                    <li class="list-disc list-inside" > {{$periode->periode_date}} {{$periode->periode_hour}}   </li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="border-solid border p-2 border-black text-center text-lg" >
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
                                    <li class="text-basic_white_color" >Detaille supplementaire: <br/>  {{$publicite->pub_detail}}</li>
                                @endif
                            </ul>
                        </td>
                        <td class="border-solid border p-2 border-black text-center text-lg" >

                            @if ($publicite->isPaid)
                                <span class="text-basic_white_color" >OUI</span> 
                            @else
                                
                                <span class="text-basic_white_color" >NON</span> <br> <a href="{{route('service.paiment.redirect',['publicite'=>$publicite])}}" class="text-blue-300 underline" target="_blank" >cliqué ici pour payer</a>
                            @endif

                        </td>
                        <td class="capitalize border-solid border text-orange-500 p-2 border-black text-center text-lg  " >{{$publicite->status}}</td>

                        <td class="border-solid border p-2 border-black text-center text-lg" >

                            <form action="{{route('service.publicite.delete',['publicite'=>$publicite])}}" method="POST" >
                                @csrf 
                                @method('delete')
                                <button type="submit" class="bg-red-600 text-basic_white_color p-1 rounded" > Supprimé</button>
                            </form>

                        </td>

                    </tr>
                @empty
                    
                @endforelse
               
            </tbody>
        </table>
   </div>
</x-app-layout>
