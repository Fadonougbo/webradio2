<div class="w-full flex  my-6 flex-col items-center ">
    <h2 class="text-xl md:text-2xl uppercase text-center my-4  rounded p-2 bg-green-900 text-basic_white_color font-semibold  w-full  md:w-3/4 lg:w-1/2" >Informations supplémentaires</h2>

    <section class="w-full flex flex-col md:w-3/4 lg:w-1/2" >

        <div class="w-full flex flex-col my-8" >

            <label for="communique_file" class='my-3 text-lg  font-bold' >Veuillez télécharger les fichiers requis pour la diffusion de ce communiqué (important).</label>
            
            @php
                $files=$communique->servicefiles;
                
            @endphp
            <ol class="my-2">  
                    
                @forelse ($files as $key=>$file)

                    @php
                        $path='storage/'. $file->path;
                    @endphp
                    <li class="list-decimal list-inside my-2" >
                        <a class="text-blue-900 underline my-6" href="{{asset($path)}}" download="{{$path}}" >
                        {{pathinfo($file->path,PATHINFO_BASENAME) }}
                        </a>
                    </li>
                @empty
                    
                @endforelse 
            </ol>

            
            
            <file-uploader type="update" service="communique" identifiant="{{$communique->id}}"></file-uploader>

            @error('communique_files')
                <p class="text-basic_primary_color my-2" >{{$message}}</p>
            @enderror
            
        </div>

        <div class="w-full flex flex-col" >

            <label for="detail" class='my-3 text-lg  font-bold' >Veuillez nous indiquer le sujet de votre communiqué. Fournissez des détails supplémentaires si vous en avez. (important) </label>

            <textarea name="communique_details" class="w-full rounded h-40" id="communique_details" required>{{old('communique_details',$communique?->communique_details)}}</textarea>

            @error('communique_details')
                <p class="text-basic_primary_color my-2" >{{$message}}</p>
            @enderror
        </div>
    </section>
</div>