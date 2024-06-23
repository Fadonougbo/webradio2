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

    <div class="p-4" >
        <form action="{{route('dashboard.blog.update.save')}}" method="POST" enctype="multipart/form-data">
                
                @csrf
                @method('PATCH')
                
                <section class="flex flex-col w-full items-center" >
                        <div class="flex flex-col my-3 w-[90%] md:w-3/4 lg:w-1/2 " >
                                <label for="article_title" class="my-3 text-xl   font-bold" >Titre de l'article (important) </label>

                                <input type="text" id="article_title" value="{{old('article_title',$article->article_title)}}" class=" w-full ring-2 rounded-lg" name="article_title" >

                                @error('article_title')
                                        <p class="text-basic_primary_color my-2" >{{$message}}</p>
                                @enderror
                        </div>

                        <div class="flex flex-col my-3 w-[90%] md:w-3/4 lg:w-1/2 " >

                                <label for="isOnline" class="my-3 text-xl  font-bold" >Mettre en ligne ? </label>

                
                                <input type="checkbox" class="checkbox checkbox-success  accent-white checkbox-lg border-2" id="isOnline" value="{{old('isOnline',1)}}" name="isOnline" @checked(old('isOnline',$article->isOnline)) />

                                @error('isOnline')
                                        <p class="text-basic_primary_color my-2" >{{$message}}</p>
                                @enderror

                        </div>

                        <div class="flex flex-col my-3 w-[90%] md:w-3/4 lg:w-1/2 " >

                                
                                <section>
                                       @php
                                          $path='storage/'.$article->article_principal_image;
                                       @endphp
                                       <img src="{{asset($path)}}" alt=""> 
                                </section>

                                <label for="article_principal_image" class="my-3 text-xl   font-bold" >Image principale (important) </label>

                                <input type="file" id="article_principal_image" value="{{old('article_principal_image')}}" 
                                name="article_principal_image"
                                accept="image/*"
                                class="block w-full bg-slate-200 rounded-lg p-4 text-lg  text-slate-900 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700
                                hover:file:bg-violet-100
                                ring-2
                                "/>

                                @error('article_principal_image')
                                        <p class="text-basic_primary_color my-2" >{{$message}}</p>
                                @enderror
                        </div>

                        <div class="flex flex-col my-3 w-[90%] md:w-3/4 lg:w-1/2 " >

                                <label for="categorie" class="my-3 text-xl font-bold" >Categorie (important)</label>
    
                                <select name="categorie" id="categories" class="ring-2 rounded-lg">
                                        @foreach ($categories as $categorie)
                                                <option value="{{$categorie->id}}" @selected($categorie->id===$article->categorie_id) >{{$categorie->name}}</option>
                                        @endforeach
                                </select>
                               
                                @error('categorie')
                                        <p class="text-basic_primary_color my-2" >{{$message}}</p>
                                @enderror
                        </div>
                                
                        <div class="flex flex-col my-3 w-[80%] " ><!-- w-[90%] md:w-3/4 lg:w-1/2  -->

                                <label for="content" class="my-3 text-xl   font-bold" >content (important)</label>
                                
                                @error('content')
                                        <p class="text-basic_primary_color my-2" >{{$message}}</p>
                                @enderror

                                <!-- <blog-editor usecase="update" ></blog-editor> -->
                                 <div
                                        hx-post="{{route('dashboard.blog.htmx',['article'=>$article])}}"
                                      hx-trigger="load"
                                 >
                                                
                                 </div>
                
                                
                        </div>
                
                </section>
        </form>
    </div>
    
    
</x-app-layout>
