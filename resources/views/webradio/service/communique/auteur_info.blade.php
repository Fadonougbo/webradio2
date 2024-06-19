@php
    $ID='my_auth_modal_'.$communique->id;
@endphp
<div class="flex flex-col items-center whitespace-nowrap text-center lg:flex-row lg:justify-center" >
    <span class="capitalize mr-4 font-semibold" >{{auth()->user()->last_name}} {{auth()->user()->first_name}}</span>
    <button class="btn btn-neutral btn-sm w-full rounded-none lg:w-1/4" onclick="{{$ID}}.showModal();" type="button"> <!-- type="button" est ajouté pour ne pas déclencher la soumission du formulaire -->
            Info
    </button>
</div>

<dialog id="{{$ID}}" class="modal">
    <div class="modal-box">
        @php
            $u=uniqid();
        @endphp
        <form method="dialog" >
            <button class="btn btn-sm btn-circle btn-ghost bg-black absolute right-2 top-2 " 
            onclick="{{$ID}}.close();" 
            type="button"  >✕</button>  <!-- type="button" est ajouté pour ne pas déclencher la soumission du formulaire -->
        </form>
        
        <ul class="text-black" >
            <li class="capitalize text-start" >{{auth()->user()->last_name}} {{auth()->user()->first_name}}</li>
            <li class="text-start" ><a href="mailto:{{$communique->communique_email}}">{{$communique->communique_email}}</a> </li>
            <li class="text-start" >{{$communique->communique_tel}}</li>
        </ul>
        
    </div>
</dialog>