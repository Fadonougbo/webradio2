import "https://cdn.fedapay.com/checkout.js?v=1.1.7";

import { define } from "hybrids";

type PaimentModule = {
	name: string;
	demande_id: string;
	nb_demande: string;
    amount:string,
    backurl:string
};

define<PaimentModule>({
	tag: "paiment-module",
	demande_id: "",
	nb_demande: "",
    amount:'',
    backurl:'',
	name: {
		value: "paiment_module",
		connect(host) {
			const { demande_id, nb_demande,amount,backurl } = host;

			const demandeId = Number.parseInt(demande_id);

			const nbDemande = Number.parseInt(nb_demande);

            const price = Number.parseInt(amount);

			if(Number.isNaN(demandeId) || Number.isNaN(nbDemande) || Number.isNaN(price) ) {
                return '';
            }

           
			const x = FedaPay.init("paiment-module", {
				public_key: "pk_sandbox_cSCumLLKmrzKFwWvB61E6WRW",
                transaction: {
                    amount: price,
                    description: 'Acheter mon produit'
                  },
				onComplete(x) {
					/* if (x.reason === "DIALOG DISMISSED") {
						const p = host.previousElementSibling as HTMLFormElement;
						p.submit();
					} */

                    if (x.reason === "DIALOG DISMISSED") {
						location.assign(backurl)
					}
				},
			});

			x[0].open();
			console.log(x[0]);
		},
	},
});

/* function({ reason: number, transaction: object }) */
