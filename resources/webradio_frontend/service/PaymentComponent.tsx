import 'https://cdn.fedapay.com/checkout.js?v=1.1.7'

import { define } from "hybrids";

type PaymentModule = {
	name: string;
	identifiant: string;
	amount: string;
	email: string;
	tel: string;
	last_name: string;
	first_name: string;
	on_error_url: string;
};

define<PaymentModule>({
	tag: "payment-module",
	identifiant: "",
	amount: "",
	tel: "",
	email: "",
	on_error_url: "",
	last_name: "",
	first_name: "",
	name: {
		value: "payment_module",
		connect(host) { 



			const { identifiant, tel,email,amount,on_error_url,last_name,first_name} = host;

			console.log({ identifiant, tel,email,amount,last_name,first_name,on_error_url});

			if(Number.isNaN(Number.parseInt(identifiant)) || Number.isNaN(Number.parseInt(tel)) || Number.isNaN(Number.parseInt(amount)) ) {
				
                location.assign(on_error_url)
            }

			const fedapay = FedaPay.init("payment-module", {

				public_key: "pk_live_R_6_AGsm-9nQTcwZ2kLXTbd-",

                transaction: {

                    amount: amount,
                    description: `Paiement de ${amount}  pour Diffusion de communiqué`

                  },

				  customer: {
					email: email,
					firstname:first_name,
					lastname:last_name,
					phone_number: {
						number:tel
					}
				  },

				onComplete(x) {
					
                    if (x.reason === "DIALOG DISMISSED") {
						location.assign(on_error_url)
						
						
					}else {
						const form = host.previousElementSibling as HTMLFormElement;
						
						form.submit();
					}
				}
				
			});

			fedapay[0].open()
		},
	},
});
