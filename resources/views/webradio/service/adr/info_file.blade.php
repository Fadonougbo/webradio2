<div class="w-full flex  my-6 flex-col items-center ">
    <h2 class="text-2xl uppercase text-center my-4  rounded p-2 bg-blue-900 text-basic_white_color font-semibold  w-full  md:w-3/4 lg:w-1/2" >Informations supplémentaires</h2>

    <section class="w-full flex flex-col md:w-3/4 lg:w-1/2" >

        <div class="w-full flex flex-col my-4" >

            <label for="adr_file" class='my-3 text-lg  font-bold' >Veuillez ajouter les fichiers nécessaires </label>
            
            @php
                $path='storage/'. $adr->adr_file
            @endphp

            @if ($adr->adr_file) 
                
            <a class="text-blue-900 underline my-6" href="{{asset($path)}}" download="{{$adr->adr_file}}" >
                Voir le document ajouté précedement
            </a>
                
            @endif
            

            <input type="file" name="adr_file" id="adr_file" >

            @error('adr_file')
                <p class="text-basic_primary_color my-2" >{{$message}}</p>
            @enderror 
            
        </div>

        <div class="w-full flex flex-col" >

            <label for="detail" class='my-3 text-lg  font-bold' >Information complémentaire</label>

            <textarea name="adr_detail" class="w-full rounded h-40" id="adr_detail">{{old('adr_detail',$adr?->adr_detail)}}</textarea>

            @error('adr_detail')
                <p class="text-basic_primary_color my-2" >{{$message}}</p>
            @enderror
        </div>
    </section>
</div>