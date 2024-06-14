import "https://cdn.fedapay.com/checkout.js?v=1.1.7";

import { define } from "hybrids";

type PaymentModule = {
	name: string,
	id: string,
    amount:string,
	email:string,
	tel:string,
	last_name:string,
	first_name:string,
    on_error_url:string
};

define<PaymentModule>({
	tag: "payment-module",
	id: "",
    amount:'',
	tel:'',
	email:'',
    on_error_url:'',
	last_name:'',
	first_name:'',
	name: {
		value: "payment_module",
		connect(host) {

			
			const { id, tel,email,amount,on_error_url,last_name,first_name} = host;

			//console.log({ id, tel,email,amount,last_name,first_name,on_error_url});

			if(Number.isNaN(Number.parseInt(id)) || Number.isNaN(Number.parseInt(tel)) || Number.isNaN(Number.parseInt(amount)) ) {
				
                return '';
            }

           
			const x = FedaPay.init("payment-module", {

				public_key: "pk_live_R_6_AGsm-9nQTcwZ2kLXTbd-",

                transaction: {

                    amount: amount,

                    description: "Payment pour un service chez Radio Trait d'Union"

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
				},
				
			});

			

			x[0].open();
		},
	},
});


