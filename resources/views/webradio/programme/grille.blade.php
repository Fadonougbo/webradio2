@extends('webradio.programme.base')

@section('title',"Grille des programmes")

@section('content')
    

    <main class="p-4 w-full" >
        <section class='w-full mt-40'>
            <div class="my-4" >
                <h1 class="text-4xl uppercase text-center" >grille tarifaire de la RTU</h1>
            </div>
            <table class="w-full my-6" >
                <thead>
                    <tr>
                        <th class="border-solid border border-black capitalize" >désignation</th>
                        <th class="border-solid border border-black capitalize" >Nombre de page</th>
                        <th class="border-solid border border-black capitalize" >Nombre de personne</th>
                        <th class="border-solid border border-black capitalize" >Prix hors taxe (fcfa)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border-solid border border-black" >Communique</td>
                        <td class="border-solid border border-black" >1</td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >{{(new App\Models\webradio\Communique())->getPrice()}} </td>
                    </tr>
                    <tr>
                        <td class="border-solid border border-black" >Diffusion, communique, Avis et spot Publicitaire Hors des heures de programme Classique</td>
                        <td class="border-solid border border-black" >1</td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >7500</td>
                    </tr>
                    <tr>
                        <td class="border-solid border border-black" >Communique politique</td>
                        <td class="border-solid border border-black" >1</td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >10000</td>
                    </tr>
                    <tr>
                        <td class="border-solid border border-black" >Realisation de spot publicitaire de 1 min</td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >25000</td>
                    </tr>
                    <tr>
                        <td class="border-solid border border-black" >Annonce de déces</td>
                        <td class="border-solid border border-black" >1</td>
                        <td class="border-solid border border-black" >6 noms plus 1 nom supplémentaire</td>
                        <td class="border-solid border border-black" >4000</td>
                    </tr>
                    <tr>
                        <td class="border-solid border border-black" >Couverture Médiatique</td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >50000</td>
                    </tr>
                    <tr>
                        <td class="border-solid border border-black" >Couverture médiatique</td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >100000</td>
                    </tr>
                    <tr>
                        <td class="border-solid border border-black" >Diffusion de spot publicitaire</td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >5000</td>
                    </tr>
                    <tr>
                        <td class="border-solid border border-black" >Réalisation et diffusion d'émission de 30min </td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >75000</td>
                    </tr>
                    <tr>
                        <td class="border-solid border border-black" >Publi-reportage </td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" ></td>
                        <td class="border-solid border border-black" >75000</td>
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