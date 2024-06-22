<div class="p-6  overflow-x-scroll sm:overflow-x-hidden">
    <details open>

        <summary class="text-md cursor-pointer p-2" >
                Informmation à propos de ce service
        </summary>

        <section class="w-full" >
            <table class="my-6 w-full" >
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
            
                            @php
                                $price=$communique->getPrice()
                                
                            @endphp
                            <span class="my-1 whitespace-nowrap" > {{$price}} fcfa </span>
                        </td>
                        <td class="border-solid border-2 p-2 border-black text-center text-lg" >- </td>
                        <td class="border-solid border-2 p-2 border-black text-center text-lg" >1</td>
                        <td class="border-solid border-2 p-2 border-black text-center text-lg" >
                            Le communiqué sous forme de document (document word ou pdf ) ou audio
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </section>
    </details>
</div>