import "https://cdn.fedapay.com/checkout.js?v=1.1.7";

import { define } from "hybrids";

type PaimentModule = {
	name: string,
	demande_id: string,
    amount:string,
	email:string,
	tel:string,
    on_error_url:string,
	on_success_url:string
};

define<PaimentModule>({
	tag: "paiment-module",
	demande_id: "",
    amount:'',
	tel:'',
	email:'',
    on_error_url:'',
	on_success_url:'',
	name: {
		value: "paiment_module",
		connect(host) {

			
			const { demande_id, tel,email,amount,on_error_url} = host;

			console.log({ demande_id, tel,email,amount,on_error_url});

			if(Number.isNaN(Number.parseInt(demande_id)) || Number.isNaN(Number.parseInt(tel)) || Number.isNaN(Number.parseInt(amount)) ) {
				
                return '';
            }

			
			
           
			const x = FedaPay.init("paiment-module", {

				public_key: "pk_live_R_6_AGsm-9nQTcwZ2kLXTbd-",

                transaction: {

                    amount: amount,

                    description: 'Paiement pour un service chez la RTU'

                  },

				  customer: {
					email: email,
					firstname:'john',
					lastname:'doe',
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

/* function({ reason: number, transaction: object }) */
