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
                <span class="text-black text-2xl underline" >Fichier</span>
                <ul>
                    @foreach ($files as $key=>$file)
                        @php
                            $path='storage/'. $file->path
                        @endphp
                        <li class="my-2" >
                            <a class="text-blue-900 " href="{{asset($path)}}" download="{{$file->path}}" >
                            {{$key+1}}. Ouvrire le fichier
                            </a>
                        </li>
                    @endforeach 
                </ul>
                
            </section>
            <section class="my-8" >
                <span class="text-black text-2xl underline" >Informations supplémentaires</span>
                <p class="py-4 text-black">{{$communique->communique_details}}</p>
            </section>
            
        </div>
    </dialog>