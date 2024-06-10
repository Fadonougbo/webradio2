<div class="my-6 w-full flex flex-col items-center" >

    <h2 class="text-2xl uppercase text-center my-4 font-semibold p-2 rounded bg-green-900 text-basic_white_color w-full  md:w-3/4 lg:w-1/2" >Programme de diffusion</h2>

    <div class="my-4 w-full md:w-3/4 lg:w-1/2" id="programmes">
		
        <!-- Programme avec la clé 0 -->
        <section>
            <input type="date" class="my-2 rounded w-full" value="{{old('programmes.0.date')}}" name='programmes[0][date]' />

            @error('programmes.0.date')

                <p class="text-basic_primary_color my-2" >{{$message}}</p>

            @enderror

            @php
                $hours=[
                    '6:45:00'=>'6h 45 (en français et en fongbé)',
                    '13:20:00'=>'13h 20 (en français )',
                    '13:45:00'=>'13h 45 (en fongbé )',
                    "18:45:00"=>'18h 45 (en français et en fon)',
                    "19:20:00"=>'19h 20 (en français',
                    '19:45:00'=>'19h 45 ( en fongbé)',
                    '21:45:00'=>'21h 45 (en français et en fongbé)'

                ]
            @endphp

            <select name='programmes[0][hour]'   class="my-2 rounded w-full" >
                @foreach ($hours as $hour=>$text)
                    <option value="{{$hour}}" @selected(old('programmes.0.hour')===$hour) >{{$text}}</option>
                @endforeach
            </select>

            <input type="hidden" name="communique_count" value="0" id="communique_count"  >

            @error('programmes.0.hour')

                <p class="text-basic_primary_color my-2" >{{$message}}</p>

            @enderror

        </section>

        <!-- Affiche  les ancients programmes en cas d'erreur -->
        @include('webradio.service.communique.programme_error_fields')
        
    </div>

    <section class="w-full flex justify-center" >

         <span id="indicator"  class="bg-blue-600 animate-pulse htmx-indicator opacity-35 p-4  rounded text-basic_white_color">
            loading
         </span>

        <span
            
            class="bg-blue-600 p-1 rounded text-basic_white_color cursor-pointer parent"
            hx-post={{route('service.communique.htmx')}}
            hx-trigger="click"
            hx-swap="beforeend"
            hx-target="#programmes"
            hx-include="#communique_count"
            hx-select="#programme"
            hx-disabled-elt="this"
            hx-indicator="#indicator"


        >
            Ajouter un nouveau programme <i data-lucide="circle-plus" class="inline-block" ></i>
        </span>

        
    </section>
    
</div>