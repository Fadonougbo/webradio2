import { define, html } from "hybrids";

interface BasicInterface {
	data: string;
}

const click=(host,event:MouseEvent)=> {
	
	const response=confirm('Confirmez-vous la suppression ?')

	
	if(!response) {
		
		event.preventDefault();
	}
}

define<BasicInterface>({
	tag: "delete-button",
	data: {
		value: "delete_button",
		
	},
	content:()=>html`<button type="submit" onclick='${click}'  class="bg-red-800 my-6 text-basic_white_color p-1 rounded" > Supprimer</button>`
});
