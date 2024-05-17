<div class="my-6 w-full flex flex-col items-center" >
                <h2 class="text-2xl uppercase text-center my-4 font-semibold p-2 rounded bg-green-900 text-basic_white_color w-full  md:w-3/4 lg:w-1/2" >Programme de diffusion</h2>

                <section class="flex flex-col w-full items-center" >

                    <div class="my-3 w-full md:w-3/4 lg:w-1/2" >

                        <label for="nb_diffusion" class="text-lg  font-bold" >Nombre de Diffusion (required) </label>
 
                        <input type="number"  class="rounded my-3 w-full" value="{{old('pub_nb_diffusion',1)}}" id="pub_nb_diffusion" name="pub_nb_diffusion" >

                        @error('pub_nb_diffusion')
                           <p class="text-basic_primary_color my-2" >{{$message}}</p> 
                        @enderror

                    </div>

                    <div class=" w-full my-3  flex flex-col md:w-3/4 lg:w-1/2" >
                       
                        <label for="pub_date" class="text-lg my-2  font-bold" >Programme de diffusion (required)</label>

                        <input type="date" value="{{old('pub_date')}}" class="rounded w-full" name="pub_date" >

                        @error('pub_date')
                        <p class="text-basic_primary_color my-2" >{{$message}}</p> 
                        @enderror

                        <select name="pub_periode" id="pub_periode" class="rounded w-full my-4" value="{{old('pub_periode')}}" >

                            <option value="6:45">6h 45 (en français et en fon)</option>

                            <option value="13:20">13h 20 (en français )</option>

                            <option value="13:45">13h 40 (en fon )</option>
                            <option value="18:45">18h 45 (en français et en fon)</option>
                            <option value="19:20">19h 20 (en français </option>
                            <option value="19:45">19h 45 ( en fon)</option>
                            <option value="21:45">21h 45 (en français et en fon)</option>

                        </select>

                        @error('pub_periode')
                        <p class="text-basic_primary_color my-2" >{{$message}}</p>
                        @enderror

                    </div>
                </section>
            </div>