<div class="w-full flex  my-6 flex-col items-center ">
    <h2 class="text-2xl uppercase text-center my-4  rounded p-2 bg-green-900 text-basic_white_color font-semibold  w-full  md:w-3/4 lg:w-1/2" >Informations supplémentaires</h2>

    <section class="w-full flex flex-col md:w-3/4 lg:w-1/2" >

        <div class="w-full flex flex-col my-4" >

            <label for="pub_file" class='my-3 text-lg  font-bold' >Veuillez télécharger les fichiers nécessaires à la réalisation du spot (required) </label>
            
            @php
                $path='storage/'. $publicite->pub_file
            @endphp

            @if ($publicite->pub_file)
                
            <a class="text-blue-900 underline my-6" href="{{asset($path)}}" download="{{$publicite->pub_file}}" >
                Voir le document ajouté précedement
            </a>
                
            @endif
            

            <input type="file" name="pub_file" id="pub_file" >

            @error('pub_file')
                <p class="text-basic_primary_color my-2" >{{$message}}</p>
            @enderror 
            
        </div>

        <div class="w-full flex flex-col" >

            <label for="detail" class='my-3 text-lg  font-bold' >Information complémentaire</label>

            <textarea name="pub_detail" class="w-full rounded h-40" id="pub_detail">{{old('pub_detail',$publicite?->pub_detail)}}</textarea>

            @error('pub_detail')
                <p class="text-basic_primary_color my-2" >{{$message}}</p>
            @enderror
        </div>
    </section>
</div>