
@if (old('programmes'))

    @php
        $programes=old('programmes')
    @endphp

    @foreach ($programes as $key=>$programe)

        <!-- On ignore le programme avec la clé 0 car il est déja géré -->
        @if ($key===0)
            @continue
        @endif
        
        <section class="programme_{{$key}}" id="programme" >

            <div class="flex w-full justify-end">
                <button class='bg-black rounded-full text-basic_white_color text-xl size-8' 
                    hx-post={{route('service.communique.htmx')}}
                    hx-trigger="click"
                    hx-swap="outerHTML"
                    hx-target=".programme_{{$key}}"
                    hx-select="#empty"
                >
                    X
                </button>
            </div>
            
            @php
                $oldDate="programmes.$key.date";
                $oldHour="programmes.$key.hour";
            @endphp
            <input type="date" class="my-2 rounded w-full" value="{{old($oldDate)}}" name='programmes[{{$key}}][date]' />

            @error("programmes.$key.date")

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

            <select name='programmes[{{$key}}][hour]' id="communique_periode" class="my-2 rounded w-full" >
                @foreach ($hours as $hour=>$text)
                    <option value="{{$hour}}" @selected(old($oldHour)===$hour) >{{$text}}</option>
                @endforeach
            </select>

            <input type="hidden" name="communique_count" value="{{$key}}" id="communique_count"  >
            @error("programmes.$key.hour")

                <p class="text-basic_primary_color my-2" >{{$message}}</p>

            @enderror
            
        </section>
        
    @endforeach
    
@endif