<div class="w-full flex  my-6 flex-col items-center ">
    <h2 class="text-2xl uppercase text-center my-4  rounded p-2 bg-green-900 text-basic_white_color font-semibold  w-full  md:w-3/4 lg:w-1/2" >Informations supplémentaires</h2>

    <section class="w-full flex flex-col md:w-3/4 lg:w-1/2" >

        <div class="w-full flex flex-col my-4" >

            <label for="pub_file" class='my-3 text-lg  font-bold' >Veuillez télécharger les fichiers nécessaires à la réalisation du spot (required) </label>

            <input type="file" name="pub_file" id="pub_file" multiple >

            @error('pub_file')
                <p class="text-basic_primary_color my-2" >{{$message}}</p>
            @enderror 
            
        </div>

        <div class="w-full flex flex-col" >

            <label for="detail" class='my-3 text-lg  font-bold' >Information complémentaire</label>

            <textarea name="pub_detail" class="w-full rounded h-40" id="pub_detail">{{old('pub_detail')}}</textarea>

            @error('pub_detail')
                <p class="text-basic_primary_color my-2" >{{$message}}</p>
            @enderror
        </div>
    </section>
</div>