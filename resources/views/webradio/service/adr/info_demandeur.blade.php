<div class="my-6 w-full flex  flex-col items-center" >
                <h2 class="text-2xl uppercase rounded text-center p-2  my-4 font-semibold inline-block bg-blue-900 text-basic_white_color w-full  md:w-3/4 lg:w-1/2" >Informations sur le demandeur</h2> 
                <section class="flex flex-col w-full items-center" >

                    <div class="flex flex-col my-3 w-full md:w-3/4 lg:w-1/2 " >

                        <label for="adr_email" class="my-3 text-lg   font-bold" >Email </label>

                        <input type="email" id="adr_email" value="{{old('adr_email',Auth::user()->email)}}" class="rounded w-full" name="adr_email" >

                        @error('adr_email')
                            <p class="text-basic_primary_color my-2" >{{$message}}</p>
                        @enderror

                    </div>
                    <div class="flex flex-col my-3 w-full md:w-3/4 lg:w-1/2" >

                        <label for="adr_tel" class="my-3 text-lg   font-bold" >Telephone (required) </label>
                        <input type="tel" class="rounded w-full" value="{{old('adr_tel',$adr?->adr_tel)}}" placeholder="ex: 91810043" name="adr_tel" id="adr_tel" >

                        @error('adr_tel')
                            <p class="text-basic_primary_color my-2" >{{$message}}</p>
                        @enderror
                    </div> 
                    
                </section>
            </div>