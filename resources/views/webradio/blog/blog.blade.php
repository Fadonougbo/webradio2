<x-app-layout>

    @session('success')
            <message-toast type="success" msg="{{session('success')}}" delay="3000" ></message-toast>
    @endsession

    @session('error')
            <message-toast type="error" msg="{{session('error')}}" delay="3000" ></message-toast>
    @endsession

    @if($errors->any())
        <message-toast type="info" msg="Une erreur est surevenue, veuillez  réessayer à nouveau." delay="15000" ></message-toast>
        <!--  @foreach ($errors->all() as $err)
                <p>{{$err}}</p>
            @endforeach  -->
    @endif

    <h3 class="text-xl mt-4 flex items-center font-semibold" > 
        <i data-lucide="arrow-big-right" class="size-8" ></i> Articles  
        <a href="{{route('dashboard.blog.create.article')}}" class="mx-6 text-lg text-blue-800 underline" >Créer un article </a>
    </h3>

    {{$articles->links()}}
    <div class="w-full flex flex-col  overflow-x-scroll md:overflow-x-auto  p-4 " ><!-- overflow-x-scroll md:overflow-x-hidden -->
 
        <table class="w-full my-4 border-collapse " >
            <thead class="bg-blue-600  text-basic_white_color " >
                <tr class="" >
                    <th class=" uppercase  p-2  text-center text-lg" >ID</th>
                    <th class=" uppercase  p-2  text-center text-lg" >Titre</th>
                    <th class=" uppercase  p-2  text-center text-lg" >Auteur</th>
                    <th class=" uppercase  p-2  text-center text-lg" >Categorie</th>
                    <th class=" uppercase  p-2  text-center text-lg whitespace-nowrap" >En ligne ?</th>
                    <th class=" uppercase  p-2  text-center text-lg" >Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-900" >
                @forelse ($articles as $article )

                    <tr class="border-solid border-b-4 p-2 border-blue-400 text-center text-basic_white_color text-lg h-full" >

                        <td class="border-solid  p-2 border-black  text-center text-xl" >
                            
                            #{{$article->id}} 
                        </td>

                        <td class="border-solid whitespace-nowrap text-indigo-300  p-2 border-black  text-center text-xl" >

                            @if (!empty($article->categorie))
                                <a class="underline underline-offset-2" 
                                    href="{{route('home.show',['article'=>$article->id,'slug'=>$article->article_slug])}}" 
                                    title="{{$article->article_title}}" 
                                >
                                    {{Str::limit($article->article_title,'20')}}
                                </a>
                            @else
                                <a class="underline underline-offset-2" href="#" title="{{$article->article_title}}" >
                                    {{Str::limit($article->article_title,'20')}}
                                </a>
                            @endif
                            
                            
                        </td>
                        <td class="border-solid whitespace-nowrap p-2 border-black  text-center text-xl" >
                            @if ($article->user)
                                {{$article->user->first_name}} {{$article->user->last_name}}
                            @else
                                -
                            @endif
                            
                        </td>

                        <td class="border-solid  p-2 border-black  text-center text-xl" >
                                
                            {{$article->categorie->name??'-'}}
                        </td>

                        <td class="border-solid  p-2 border-black " >
                                
                            @if ($article->isOnline)
                                <div class="w-full flex justify-center" >
                                    <span class="size-6 block bg-green-600 rounded-full " ></span>
                                </div>
                                
                            @else
                                <div class="w-full flex justify-center" >
                                    <span class="size-6 block bg-red-600 rounded-full " ></span>
                                </div>
                            @endif

                        </td>
                        
                        <td class="border-solid space-x-4 p-2 border-black text-center text-lg items-center justify-center flex " >
                                <a href="{{route('dashboard.blog.update.article',['article'=>$article])}}" class="bg-green-900 my-4   text-basic_white_color px-4 py-1 rounded lg:mx-4" >Modifier</a>

                                <form action="{{route('dashboard.blog.delete.article',['article'=>$article])}}" method="POST" >
                                        @csrf 
                                        @method('delete')
                                        <delete-button></delete-button>
                                </form>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="py-4 text-2xl capitalize font-bold bg-basic_white_color  text-center" >vide</td>
                    </tr>

                @endforelse
            
            </tbody>
        </table>
        
    </div>
    {{$articles->links()}}
    
    <h3 class="text-xl my-4 flex items-center font-semibold" > 
        <i data-lucide="arrow-big-right" class="size-8" ></i> Categories 
        <a href="{{route('dashboard.configuration')}}#create_categorie" class="mx-6 text-lg text-blue-800 underline" >Créer une categorie</a>
    </h3>

    {{$categories->links()}}
    <div class="w-full flex flex-col md:items-center overflow-x-scroll md:overflow-x-hidden p-4 " ><!-- overflow-x-scroll md:overflow-x-hidden -->
        
        <table class="w-full my-4 border-collapse  md:w-1/2" >
            <thead class="bg-blue-600  text-basic_white_color " >
                <tr class="" >
                    <th class=" uppercase  p-2  text-center text-lg" >Nom</th>
                    <th class=" uppercase  p-2  text-center text-lg" >Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-900" >
                @forelse ($categories as $categorie )

                    <tr class="border-solid border-b-4 p-2 border-blue-400 text-center text-basic_white_color text-lg h-full" >

                        <td class="border-solid  p-2 border-black  text-center text-xl" >
                                
                            {{$categorie->name}}
                        </td>
                        
                        <td class="border-solid space-x-4 p-2 border-black text-center text-lg items-center justify-center flex " >
                                <a href="{{route('dashboard.update.categorie',['categorie'=>$categorie])}}" class="bg-green-900 my-4   text-basic_white_color px-4 py-1 rounded lg:mx-4" >Modifier</a>

                                <form action="{{route('dashboard.delete.categorie',['categorie'=>$categorie])}}" method="POST" >
                                        @csrf 
                                        @method('delete')
                                        <delete-button></delete-button>
                                </form>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="py-4 text-2xl capitalize font-bold bg-basic_white_color  text-center" >vide</td>
                    </tr>

                @endforelse
               
            </tbody>
        </table>
        
   </div>
   {{$categories->links()}}
    
    

</x-app-layout>
