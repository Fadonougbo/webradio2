@extends('webradio.programme.base')

@section('title',"Grille tarifaire")

@section('content')
    

    <main class="p-4 w-full" >
        <section class='w-full mt-20 tm:mt-32'>
            <div class="my-4" >
                <h1 class="text-lg lg:text-3xl uppercase text-center" >grille tarifaire de la RTU</h1>
            </div>
            <table class="w-full my-6 table table-zebra" >
                <thead>
                    <tr class="text-lg"  >
                        <th class="border-solid border border-black capitalize" >désignation</th>
                        <th class="border-solid border border-black capitalize" >Nombre de pages</th>
                        <th class="border-solid border border-black capitalize" >Nombre de personnes</th>
                        <th class="border-solid border border-black capitalize" >Prix hors taxe (fcfa)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border-solid border border-black" >Communique,avis</td>
                        <td class="border-solid border border-black" >1</td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >{{(new App\Models\webradio\Communique())->getPrice()}} fcfa </td>
                    </tr>
                    <tr>
                        <td class="border-solid border border-black" >Diffusion, communique, Avis et spot Publicitaire Hors des heures de programmation Classique</td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >7500 fcfa</td>
                    </tr>
                    <tr>
                        <td class="border-solid border border-black" >Communique politique</td>
                        <td class="border-solid border border-black" >1</td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >10000 fcfa</td>
                    </tr>
                    <tr>
                        <td class="border-solid border border-black" >Realisation de spot publicitaire de 1 min</td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >25000 f</td>
                    </tr>

                    <tr>
                        <td class="border-solid border border-black" >Annonce de déces</td>
                        <td class="border-solid border border-black" >1</td>
                        <td class="border-solid border border-black" >6 noms plus 1 nom supplémentaire + 1000f</td>
                        <td class="border-solid border border-black" >4000 f</td>
                    </tr>

                    <tr>
                        <td class="border-solid border border-black" >Couverture Médiatique</td>
                        <td class="border-solid border border-black" >1</td>
                        <td class="border-solid border border-black" >8 noms /plus 1 noms supplémentaires + 1000f</td>
                        <td class="border-solid border border-black" >50000</td>
                    </tr>

                    <tr>
                        <td class="border-solid border border-black" >Couverture médiatique</td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >50.000f</td>
                    </tr>

                    <tr>
                        <td class="border-solid border border-black" >Couverture d'évernement politique </td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >100.000f</td>
                    </tr>

                    <tr>
                        <td class="border-solid border border-black" >Couverture médiatique / hors zou  </td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >100000 f</td>
                    </tr>

                    <tr>
                        <td class="border-solid border border-black" >Diffusion de spot 1min</td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >5000 f</td>
                    </tr>

                    <tr>
                        <td class="border-solid border border-black" >Dédicace du dimanche </td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >4 noms</td>
                        <td class="border-solid border border-black" >250</td>
                    </tr>
                    <tr>
                        <td class="border-solid border border-black" >Invité du journal ordinaire </td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >50000</td>
                    </tr>
                    <tr>
                        <td class="border-solid border border-black" >Invité du  journal polique </td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >100000</td>
                    </tr>
                    <tr>
                        <td class="border-solid border border-black" >Invité du journal commercial  </td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >75000</td>
                    </tr>
                </tbody>
            </table>
        </section>
        
    </main>

@endsection