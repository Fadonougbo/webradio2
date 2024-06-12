<div class="my-6 w-full flex  flex-col items-center" >
    <h2 class="text-2xl uppercase rounded text-center p-2  my-4 font-semibold inline-block bg-green-900 text-basic_white_color w-full  md:w-3/4 lg:w-1/2" >Informations sur le demandeur</h2> 

    <section class="flex flex-col w-full items-center" >

        <div class="flex flex-col my-3 w-full md:w-3/4 lg:w-1/2 " >

            <label for="communique_email" class="my-3 text-lg   font-bold" >Email </label>

            <input type="email" id="communique_email" value="{{old('communique_email',Auth::user()->email)}}" class="rounded w-full" name="communique_email" >

            @error('communique_email')
                <p class="text-basic_primary_color my-2" >{{$message}}</p>
            @enderror

        </div>

        <div class="flex flex-col my-3 w-full md:w-3/4 lg:w-1/2" >

            <label for="communique_tel" class="my-3 text-lg   font-bold" >Telephone (important) </label>

            <input type="tel" class="rounded w-full" value="{{old('communique_tel',$communique?->pub_tel)}}" placeholder="ex: 918100" name="communique_tel" id="communique_tel"  required>

            @error('communique_tel')
                <p class="text-basic_primary_color my-2" >{{$message}}</p>
            @enderror
        </div> 
        
    </section>
</div>