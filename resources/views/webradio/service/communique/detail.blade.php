@php
    $ID='my_modal_'.$communique->id;
@endphp
<button class="btn btn-neutral" onclick="{{$ID}}.showModal()" type="button">
    Afficher
</button>

<dialog id="{{$ID}}" class="modal">
    <div class="modal-box">
        <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost bg-black absolute right-2 top-2" onclick="{{$ID}}.close()" type="button">✕</button>
        </form>

        <section class="my-8" >

            @php
                $programmes=$communique->programmes;
            @endphp
            <span class="text-black text-2xl underline font-semibold" >Programme de diffusion</span>
            <ul class="text-black my-3" >
                @foreach ($programmes as $programme)
                    <li class="list-disc list-inside " > {{$programme->programme_date}} {{$programme->programme_hour}}   </li>
                @endforeach
            </ul>

        </section>

        @php
            $files=$communique->servicefiles;

        @endphp
        <section class="flex flex-col" >
            <span class="text-black text-2xl underline my-2 font-semibold" >Fichier</span>
            <ol>
                @foreach ($files as $key=>$file)
                    @php
                        $path='storage/'. $file->path
                    @endphp
                    <li class="my-1 list-decimal list-outside " >
                        <a class="text-blue-900 text-sm" href="{{asset($path)}}" download="{{$file->path}}" >
                        <span class="text-xl" >&RightArrowBar;</span>  {{pathinfo($file->path,PATHINFO_BASENAME)}}
                        
                        </a>
                    </li>
                @endforeach 
            </ol>
            
        </section>

        

        <section class="my-8" >
            <span class="text-black text-2xl underline font-semibold" >Informations supplémentaires</span>
            <p class="py-4 text-black">{{$communique->communique_details}}</p>
        </section>
        
    </div>
</dialog>