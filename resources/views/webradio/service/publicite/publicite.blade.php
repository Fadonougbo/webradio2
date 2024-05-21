@extends('webradio.service.publicite.base')

@section('title',"Publicité")

@section('content')
    

    <main class="p-4" >
       <div>
           <h2 class="my-6 text-4xl font-semibold uppercase text-center " > diffusion de spot publicitaire   </h2>
            <p class="text-center text-xl" >Remplissez le formulaire ci-dessous pour faire votre demande</p>
       </div>
       <button id="test"
        data-transaction-amount="100"
        data-transaction-description="Acheter mon produit"
        data-customer-email="fadougbogautier@gmail.com"
        data-customer-lastname="Doe"

        >Payer 1000 FCFA</button>
       @include('webradio.service.publicite.info_table')

        <form action="" method="POST" class="bg-gray-200 rounded-md shadow p-6 my-8 flex flex-col items-center mx-auto lg:w-[90%] xl:w-[80%] " enctype="multipart/form-data">

        <!-- <input type="hidden" name="field" value="test">
            <script
            src="https://cdn.fedapay.com/checkout.js?v=1.1.7"
            data-public-key="pk_sandbox_cSCumLLKmrzKFwWvB61E6WRW"
            data-button-text="Payer 1000"
            data-button-class="button-class"
            data-transaction-amount="100"
            data-transaction-description="Description de la transaction"
            data-environment="sandbox"
            data-customer-email="fadougbogautier@gmail.com"
            data-customer-firstname="Fadonougbo"
            data-customer-lastname="gautier"
            data-customer-phone_number-number="91810043"
            data-submit_form_on_failed="false"
            data-customer-phone_number-country="229"
            data-currency-iso="XOF">
            </script> -->
            
            @csrf

            @if($errors->any())
                <message-toast></message-toast>
            @endif
           
            @include('webradio.service.publicite.info_demandeur')

            @include('webradio.service.publicite.info_programme')

            @include('webradio.service.publicite.info_file')

            <div class="w-full flex my-6 justify-center" >
                <button type="submit" class="w-full bg-green-900 hover:bg-green-900/80  md:w-3/4 lg:w-1/2 p-2 text-basic_white_color text-xl rounded-sm" >Soumettre</button>
            </div>
        </form>
        
    </main>

@endsection