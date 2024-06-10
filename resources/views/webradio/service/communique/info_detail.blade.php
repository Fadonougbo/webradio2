<div class="w-full flex  my-6 flex-col items-center ">
    <h2 class="text-2xl uppercase text-center my-4  rounded p-2 bg-green-900 text-basic_white_color font-semibold  w-full  md:w-3/4 lg:w-1/2" >Informations supplémentaires</h2>

    <section class="w-full flex flex-col md:w-3/4 lg:w-1/2" >

        <div class="w-full flex flex-col my-8" >

            <label for="communique_file" class='my-3 text-lg  font-bold' >Veuillez télécharger les fichiers nécessaires pour la diffusion de ce communiqué (important) </label>
            
            @php
                $path='storage/'. $communique->pub_file
            @endphp

            @if ($communique->pub_file) 
                
            <a class="text-blue-900 underline my-6" href="{{asset($path)}}" download="{{$communique->pub_file}}" >
                Voir le document ajouté précedement
            </a>
                
            @endif
            

            <input type="file" name="communique_file" class="cursor-pointer border-2 border-solid border-black rounded p-2" id="communique_file" accept=".pdf,.docx,.txt,audio/*" >

            @error('communique_file')
                <p class="text-basic_primary_color my-2" >{{$message}}</p>
            @enderror 
            
        </div>

        <div class="w-full flex flex-col" >

            <label for="detail" class='my-3 text-lg  font-bold' >Veuillez nous indiquer le sujet de votre communiqué. Fournissez des détails supplémentaires si vous en avez. (important) </label>

            <textarea name="communique_detail" class="w-full rounded h-40" id="communique_detail">{{old('communique_detail',$communique?->communique_detail)}}</textarea>

            @error('communique_detail')
                <p class="text-basic_primary_color my-2" >{{$message}}</p>
            @enderror
        </div>
    </section>
</div>