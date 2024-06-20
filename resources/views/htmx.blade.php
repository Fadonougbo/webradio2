

@if($isHtmxRequest) 

    @php
        $id=(int)request()->input('identifiant')??0;

        request()->validate([
        'identifiant'=>['integer','min:0']
        ]);

        $user=App\Models\User::find($id);
    @endphp

    @if ($user?->exists() && $user?->role!=='boss')

            @php
                $roles=[
                    'user'=>'user',
                    'admin'=>'admin',
                    'superadmin'=>'superadmin'
                ]
            @endphp
        
             <div class="p-4 space-y-4  bg-gray-800 flex-grow rounded-lg " id="card" >

                <p class="text-xl text-white flex" >ID: <span class="mx-4 text-lg" >{{$user->id}}</span></p>

                <p class="text-xl text-white flex" >Nom: <span class="mx-4 text-lg" >{{$user->last_name}}</span> </p>

                <p class="text-xl text-white flex" >Prenom:<span class="mx-4 text-lg" >{{$user->first_name}}</span></p>

                <p class="text-xl text-white flex" >Email:  <span class="mx-4 text-lg" >{{$user->email}}</span></p>

                <form action="{{route('dashboard.configuration.role',['user'=>$user])}}" method="POST" class="flex items-center">
                    @csrf 
                    @method('PATCH')
                    <p class="text-xl text-white" >Role:  </p>

                    <select name="role" class="mx-4 h-10">

                        @foreach ($roles as $key=>$role)
                            <option value="{{$key}}" @selected($key===$user->role) >{{$role}}</option>
                        @endforeach

                    </select>

                    <button class="p-2 bg-green-500 text-white text-lg rounded w-20 text-center"  >ok</button>

                </form>
                
                
            </div>
        

    @else 
        <div class="p-4 space-y-4  bg-gray-800 flex-grow rounded-lg " id="card" >
            <p class="text-xl text-white" >ID: <span class="mx-4 text-lg" >{{$id}}</span></p>
            <p class="text-xl text-white" >Nom: <span class="mx-4 text-lg" >Null</span> </p>
            <p class="text-xl text-white" >Prenom:<span class="mx-4 text-lg" >Null</span></p>
            <p class="text-xl text-white" >Email:  <span class="mx-4 text-lg" >Null</span></p>
        </div>
    @endif

@endif

