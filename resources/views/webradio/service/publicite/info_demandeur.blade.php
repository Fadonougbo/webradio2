<div class="my-6 w-full flex  flex-col items-center" >
                <h2 class="text-2xl uppercase rounded text-center p-2  my-4 font-semibold inline-block bg-green-900 text-basic_white_color w-full  md:w-3/4 lg:w-1/2" >Information sur le demandeur</h2> 
                <section class="flex flex-col w-full items-center" >
                    <!-- <div class="flex flex-col my-3 w-full md:w-3/4 lg:w-1/2 " >

                        <label for="pub_user_name" class="my-3 text-lg 0 font-bold" >Nom et prénom(s) (required)</label>

                        <input type="text" class="rounded w-full" name="pub_user_name" id="pub_user_name" value="{{old('pub_user_name',Auth::user()->name)}}" >

                        @error('pub_user_name')
                            <p class="text-basic_primary_color my-2" >{{$message}}</p>
                        @enderror

                    </div> -->

                    <div class="flex flex-col my-3 w-full md:w-3/4 lg:w-1/2 " >

                        <label for="pub_email" class="my-3 text-lg   font-bold" >Email </label>

                        <input type="email" id="pub_email" value="{{old('pub_email',Auth::user()->email)}}" class="rounded w-full" name="pub_email" >

                        @error('pub_email')
                            <p class="text-basic_primary_color my-2" >{{$message}}</p>
                        @enderror

                    </div>
                    <div class="flex flex-col my-3 w-full md:w-3/4 lg:w-1/2" >

                        <label for="pub_tel" class="my-3 text-lg   font-bold" >Telephone (required) </label>

                        <input type="tel" class="rounded w-full" value="{{old('pub_tel')}}" placeholder="ex: 91810043" name="pub_tel" id="pub_tel" >

                        @error('pub_tel')
                            <p class="text-basic_primary_color my-2" >{{$message}}</p>
                        @enderror
                    </div> 
                    
                </section>
            </div>