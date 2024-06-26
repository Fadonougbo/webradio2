@php
    $ID='my_auth_modal_'.$communique->id;
@endphp
<div class="flex flex-col items-center whitespace-nowrap text-center lg:flex-row lg:justify-center" >

    <span class="capitalize mr-4 font-semibold" >{{$communique->user->last_name}} {{$communique->user->first_name}}</span>

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
        
        <ul class="text-black space-y-3" >
            <li class="capitalize text-start flex items-center" >
                <i data-lucide="user" class="size-8 mr-4" ></i> 
                {{auth()->user()->last_name}} {{auth()->user()->first_name}}
            </li>

            <li class="text-start flex items-center" >
                <i data-lucide="at-sign" class="size-8 mr-4" ></i>
                <a href="mailto:{{$communique->communique_email}}" class="text-blue-500 underline">{{$communique->communique_email}}</a> 
            </li>
            <li class="text-start flex items-center" >
                 <i data-lucide="phone" class="size-8 mr-4" ></i>
                {{$communique->communique_tel}}
            </li>
        </ul>
        
    </div>
</dialog>