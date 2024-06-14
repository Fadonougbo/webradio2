@php
    $ID='my_modal_'.$communique->id;
@endphp
<button class="btn btn-neutral" onclick="{{$ID}}.showModal()">
        Afficher
    </button>

    <dialog id="{{$ID}}" class="modal">
        <div class="modal-box">
            <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost bg-black absolute right-2 top-2">✕</button>
            </form>
            @php
                $files=$communique->servicefiles;

            @endphp
            <section class="flex flex-col" >
                <span class="text-black text-2xl underline my-2" >Fichier</span>
                <ol>
                    @foreach ($files as $key=>$file)
                        @php
                            $path='storage/'. $file->path
                        @endphp
                        <li class="my-1 list-decimal list-outside text-start" >
                            <a class="text-blue-900 text-sm" href="{{asset($path)}}" download="{{$file->path}}" >
                            <span class="text-xl" >&RightArrowBar;</span>  {{pathinfo($file->path,PATHINFO_BASENAME)}}
                            
                            </a>
                        </li>
                    @endforeach 
                </ol>
                
            </section>
            <section class="my-8" >
                <span class="text-black text-2xl underline" >Informations supplémentaires</span>
                <p class="py-4 text-black">{{$communique->communique_details}}</p>
            </section>
            
        </div>
    </dialog>