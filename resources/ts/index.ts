import {
	Album,
	ArrowBigRight,
	ArrowRight,
	AtSign,
	CalendarDays,
	CirclePlus,
	CircleUserRound,
	Clock,
	ExternalLink,
	File,
	Info,
	LoaderCircle,
	Mail,
	Phone,
	User,
	createIcons
} from "lucide";



createIcons({
	icons: {
		CircleUserRound,
		Mail,
		Phone,
		Clock,
		Info,
		ArrowBigRight,
		CirclePlus,
		LoaderCircle,
		User,
		AtSign,
		File,
		CalendarDays,
		ExternalLink,
		Album,
		ArrowRight
	},
});

const content_loader=document.querySelector('#content_loader') as HTMLDivElement

//Supprime le l'effet chargement
if(content_loader) {
	window.addEventListener('load',()=> {
		content_loader.style.display='none'
	})
}

console.log('okok');
