<div class="my-6 w-full flex flex-col items-center" >

    <h2 class="text-xl uppercase text-center my-4 font-semibold p-2 rounded bg-green-900 text-basic_white_color w-full md:text-2xl  md:w-3/4 lg:w-1/2" >Programme de diffusion</h2>

    @if ($communique->id)
        <div class="my-4 w-full md:w-3/4 lg:w-1/2">
            <p class="text-red-600 text-lg text-center m-1" >Attention ! Vous ne serez pas remboursé si vous supprimez un programme de diffusion.</p>
        </div>
    @endif
    
    <!-- Utiliser pour le cas d'un create -->
    @if (empty($communique->id))
        <div class="my-4 w-full md:w-3/4 lg:w-1/2" id="programmes">
            
            <!-- Programme avec la clé 0 -->
            <section>
                <input type="date" class="my-2 rounded w-full" value="{{old('programmes.0.date')}}" name='programmes[0][date]' required/>

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

                <select name='programmes[0][hour]'   class="my-2 rounded w-full" required>
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
    @endif

    @if (!empty($communique->id))

        @php
            $programmes=$communique->programmes
        @endphp

        <div class="my-4 w-full md:w-3/4 lg:w-1/2" id="programmes">
        @foreach ($programmes as $key=>$programme)
                        
            <section class="programme_{{$programme->id}}  my-2" >
                
                @if ($key!==0)
                    <div class="flex w-full justify-end">
                        <button class='bg-black rounded-full text-basic_white_color text-xl size-8' 
                            hx-patch={{route('service.communique.htmx')}}
                            hx-trigger="click"
                            hx-swap="outerHTML"
                            hx-target=".programme_{{$programme->id}}"
                            hx-select="#empty"
                        >
                            X
                        </button>
                    </div>
                @endif
                

                @php
                    $dateKey="programmes.$programme->id.date";
                    $inputNameKey="programmes[$programme->id][date]";

                    $hourNameKey="programmes[$programme->id][hour]";
                    $hourKey="programmes.$programme->id.hour";

                   
                @endphp


                <input type="date" class="my-2 rounded w-full" value="{{old($dateKey,$programme->programme_date)}}" name={{$inputNameKey}} required  />

                @error($dateKey)

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

                <select name={{$hourNameKey}}   class="my-2 rounded w-full" required >
                    @foreach ($hours as $hour=>$text)
                        <option value="{{$hour}}" @selected(old($hourKey,$programme->programme_hour)===$hour) >{{$text}}</option>
                    @endforeach
                </select>

                @error($hourKey)

                    <p class="text-basic_primary_color my-2" >{{$message}}</p>

                @enderror

            </section>           
            
       
         @endforeach
         </div>
        
    @endif


    <!-- Utiliser pour un create -->
    @if (empty($communique->id))
        <section class="w-full flex justify-center" >

            <span id="indicator"  class="bg-blue-600 animate-pulse htmx-indicator opacity-35 p-4  rounded text-basic_white_color">
            loading
            </span>

            <span
            
            class="bg-blue-600 p-1 text-center rounded text-basic_white_color cursor-pointer parent"
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
    @endif
    
    
</div>