<x-app-layout>



    @session('success')
            <message-toast type="success" msg="{{session('success')}}" delay="3000" ></message-toast>
    @endsession

    @session('error')
            <message-toast type="error" msg="{{session('error')}}" delay="3000" ></message-toast>
    @endsession

    <div>
        <form action="" >
                <section class="flex flex-col w-full items-center" >
                        <div class="flex flex-col my-3 w-[90%] md:w-3/4 lg:w-1/2 " >
                                <label for="article_title" class="my-3 text-xl   font-bold" >Titre de l'article </label>
                                <input type="text" id="article_title" value="{{old('article_title')}}" class="rounded w-full" name="article_title" >
                                @error('article_title')
                                        <p class="text-basic_primary_color my-2" >{{$message}}</p>
                                @enderror
                        </div>
                        <div class="flex flex-col my-3 w-[90%] md:w-3/4 lg:w-1/2 " >
                                <label for="article_slug" class="my-3 text-xl   font-bold" >Slug de l'article </label>
                                <input type="text" id="article_slug" value="{{old('article_slug')}}" class="rounded w-full" name="article_slug" >
                                @error('article_slug')
                                        <p class="text-basic_primary_color my-2" >{{$message}}</p>
                                @enderror
                        </div>
                        <div class="flex flex-col my-3 w-[90%] md:w-3/4 lg:w-1/2 " >
                                <label for="article_status" class="my-3 text-xl   font-bold" >Mettre en ligne ? </label>
                
                                <input type="checkbox" class="checkbox checkbox-success checkbox-lg border-2" id="article_status" value="{{old('article_status')}}" name="article_status" checked/>

                                @error('article_status')
                                        <p class="text-basic_primary_color my-2" >{{$message}}</p>
                                @enderror
                        </div>
                        <div class="flex flex-col my-3 w-[90%] md:w-3/4 lg:w-1/2 " >
                                <label for="article_image" class="my-3 text-xl   font-bold" >Image principale </label>
                                <input type="file" id="article_image" value="{{old('article_image')}}" class="rounded w-full" name="article_image" >
                                @error('article_image')
                                        <p class="text-basic_primary_color my-2" >{{$message}}</p>
                                @enderror
                        </div>

                        <div class="flex flex-col my-3 w-[90%] md:w-3/4 lg:w-1/2 " >
                                <label for="categories" class="my-3 text-xl   font-bold" >Categorie</label>
                
                                <select name="categories" id="categories" multiple>
                                        <option value="sport">sport</option>
                                        <option value="science">science</option>
                                </select>
                
                                @error('categories')
                                        <p class="text-basic_primary_color my-2" >{{$message}}</p>
                                @enderror
                        </div>

                        <div class="flex flex-col my-3 w-[90%] md:w-3/4 lg:w-1/2 " >
                                <label for="contenu" class="my-3 text-xl   font-bold" >Contenu</label>
                
                
                
                                @error('contenu')
                                        <p class="text-basic_primary_color my-2" >{{$message}}</p>
                                @enderror
                        </div>
                
                
                </section>
        </form>
    </div>
    
    

</x-app-layout>
