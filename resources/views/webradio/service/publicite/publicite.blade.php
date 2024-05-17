@extends('webradio.home.base')

@section('title',"Publicité")

@section('content')
    

    <main class="p-4" >
       <div>
           <h2 class="my-6 text-4xl font-semibold uppercase text-center " > diffusion de spot publicitaire   </h2>
            <p class="text-center text-xl" >Remplissez le formulaire ci-dessous pour faire votre demande</p>
       </div>
        <div class="p-6  overflow-x-scroll sm:overflow-x-hidden">
            <details open>

                <summary class="text-md cursor-pointer p-2" >
                        Informmation à propos de ce service
                </summary>

                <table class="my-6" >
                    <thead>
                        <tr>
                            <th class="border-solid uppercase border-2 p-1 border-black text-center text-lg" >Prix</th>
                            <th class="border-solid uppercase border-2 p-1 border-black text-center text-lg" >Durée</th>
                            <th class="border-solid uppercase border-2 p-1 border-black text-center text-lg" >Nombre de diffusion</th>
                            <th class="border-solid uppercase border-2 p-1 border-black text-center text-lg" >Documents à fournir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border-solid border-2 p-2  border-black" >
                            
                             <ul class="list-disc list-inside" >
                                    <li class="my-1" >5000f (diffusion normal) </li>
                                    <li>7500f (diffusion hors des heures de programmation classique)</li>
                                </ul>
                            </td>
                            <td class="border-solid border-2 p-2 border-black text-center text-lg" > 45 secondes </td>
                            <td class="border-solid border-2 p-2 border-black text-center text-lg" >1</td>
                            <td class="border-solid border-2 p-2 border-black text-center text-lg" >
                                Spot à diffuser ou Description du spot à produire
                            </td>
                        </tr>
                    </tbody>
                </table>
                
            </details>
        </div>

        <form action="" class="bg-gray-200 rounded-md p-6 my-8 flex flex-col items-center mx-auto lg:w-[90%] xl:w-[80%] ">
            <div class="my-6 w-full " >
                <h2 class="text-xl uppercase text-center my-4 font-semibold" >Information sur le demandeur</h2>
                <section class="flex flex-col w-full items-center" >
                    <div class="flex flex-col my-3 w-full md:w-3/4 lg:w-1/2 " >
                        <label for="" class="my-3 text-lg" >Nom et prénom(s)</label>
                        <input type="text" class="rounded w-full" name="telephone" >
                    </div>
                    <div class="flex flex-col my-3 w-full md:w-3/4 lg:w-1/2 " >
                        <label for="" class="my-3 text-lg" >Email</label>
                        <input type="email" class="rounded w-full" name="email" >
                    </div>
                    <div class="flex flex-col my-3 w-full md:w-3/4 lg:w-1/2" >
                        <label for="" class="my-3 text-lg" >Telephone</label>
                        <input type="tel" class="rounded w-full" name="telephone" >
                    </div> 
                    
                </section>
            </div>

            <div class="my-6 w-full" >
                <h2 class="text-xl uppercase text-center my-4 font-semibold" >Programme de diffusion</h2>
                <section class="flex flex-col w-full items-center" >
                    <div class="my-3 w-full md:w-3/4 lg:w-1/2" >
                        <label for="" class="text-lg" >Nombre de Diffusion</label>
                        <input type="number"  class="rounded my-3 w-full" name="nb_diffusion" >
                    </div>
                    <div class=" w-full my-3  flex flex-col md:w-3/4 lg:w-1/2" >
                       
                        <label for="" class="text-lg my-2" >Programme de diffusion</label>
                        <input type="date" class="rounded w-full" name="date" >
                        <select name="moment" class="rounded w-full my-4">
                            <option value="matine">En matinée</option>
                            <option value="soiree">En Soirée</option>
                            <option value="matinee_soiree">En matinée et en soirée</option>
                        </select>
                        
                    </div>
                </section>
            </div>

            <div class="w-full flex  my-6 flex-col items-center ">
                <h2 class="text-xl uppercase text-center my-4 font-semibold" >Veuillez télécharger les fichiers nécessaires à la réalisation du spot</h2>
                <section class="w-full flex flex-col md:w-3/4 lg:w-1/2" >
                    <div class="w-full flex flex-col" >
                        <label for="" class='my-3 text-lg' >Nombre de Diffusion</label>
                        <input type="file" name="file" multiple > 
                    </div>
                    <div class="w-full flex flex-col" >
                        <label for="" class='my-3 text-lg' >Information complémentaire</label>
                        <textarea name="Information" class="w-full rounded h-40" id=""></textarea>
                    </div>
                </section>
            </div>

            <div class="w-full flex justify-center" >
                <button type="submit" class="w-full bg-green-700 md:w-3/4 p-2 text-basic_white_color text-xl rounded-sm" >Soumettre</button>
            </div>
        </form>
        
    </main>

@endsection