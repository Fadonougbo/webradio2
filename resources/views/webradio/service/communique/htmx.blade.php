@php
    $count=(int) request()->input('communique_count');
    $count=is_int($count)?$count+1:1;
@endphp


@if ($isHtmxRequest)

    <section class="programme_{{$count}}" id="programme" >

        <div class="flex w-full justify-end">
            <button class='bg-black rounded-full text-basic_white_color text-xl size-8' 
                hx-patch={{route('service.communique.htmx')}}
                hx-trigger="click"
                hx-swap="outerHTML"
                hx-target=".programme_{{$count}}"
                hx-select="#empty"
            >
                X
            </button>
        </div>
        

        <input type="date" class="my-2 rounded w-full" name='programmes[{{$count}}][date]' />
        <select name='programmes[{{$count}}][hour]' id="communique_periode" class="my-2 rounded w-full" >
            <option value="6:45:00">6h 45 (en français et en fongbé)</option>
            <option value="13:20:00">13h 20 (en français )</option>
            <option value="13:45:00">13h 40 (en fongbé )</option>
            <option value="18:45:00">18h 45 (en français et en fon)</option>
            <option value="19:20:00">19h 20 (en français </option>
            <option value="19:45:00">19h 45 ( en fongbé)</option>
            <option value="21:45:00">21h 45 (en français et en fongbé)</option>
        </select>
        <input type="hidden" name="communique_count" value="{{$count}}" id="communique_count"  >
    </section>
    
@else
    <section  id="programme" ></section>
@endif


<!-- 
-------------------------- -->

<span id="" ></span>