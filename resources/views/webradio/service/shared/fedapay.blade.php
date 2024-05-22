<input type="hidden" name="field" value="test">
<script
    src="https://cdn.fedapay.com/checkout.js?v=1.1.7"
    data-public-key="pk_sandbox_cSCumLLKmrzKFwWvB61E6WRW"
    data-button-text="Payer 1000"
    data-button-class="w-full bg-green-900 hover:bg-green-900/80  md:w-3/4 lg:w-1/2 p-2 text-basic_white_color text-xl rounded-sm bottom-0"
    data-transaction-amount="100"
    data-transaction-description="Description de la transaction"
    data-environment="sandbox"
    data-customer-email="fadougbogautier@gmail.com"
    data-customer-firstname="{{request()->input('pub_user_name')}}"
    data-customer-lastname="gautier"
    data-customer-phone_number-number="91810043"
    data-submit_form_on_failed="false"
    data-customer-phone_number-country="229"
    data-currency-iso="XOF"
>
</script>

