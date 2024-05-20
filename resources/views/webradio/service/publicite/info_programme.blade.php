<div class="my-6 w-full flex flex-col items-center" >
                <h2 class="text-2xl uppercase text-center my-4 font-semibold p-2 rounded bg-green-900 text-basic_white_color w-full  md:w-3/4 lg:w-1/2" >Programme de diffusion</h2>

                <section class="flex flex-col w-full items-center" >

                    <div class="my-3 w-full md:w-3/4 lg:w-1/2" >

                        <label for="nb_diffusion" class="text-lg  font-bold" >Nombre de Diffusion (required) </label>
 
                        <input type="number"  class="rounded my-3 w-full" value="{{old('pub_nb_diffusion',1)}}" id="pub_nb_diffusion" name="pub_nb_diffusion" >

                        
                   
                    </div>

                    <programme-date class="w-full flex flex-col items-center" ></programme-date>
                    
                </section>
            </div>