import { Sheet, SheetContent, SheetTrigger } from "@/components/ui/sheet";
import { MenuIcon } from "lucide-react";
import { useEffect, useState } from "react";


 const getActiveElementClass = (path: string) => {
	if (location.pathname !== "" && location.pathname === path) {
		return " p-2 w-full font-bold hover:text-basic_primary_color underline underline-offset-4 transition-all hover:translate-x-4 decoration-4 decoration-basic_primary_color decoration-solid ";
	}

	return "p-2 w-full font-bold hover:text-basic_primary_color  transition-all hover:translate-x-4";
};




export const Menu = () => {
	

	  const [token, setToken] = useState<string>("");

	  const [user,setUser]=useState<boolean>(false)

	  useEffect(()=> {

		const csrfToken = document
		?.querySelector('meta[name="csrf-token"]')
		?.getAttribute("content");

		if (csrfToken) {
			setToken(() => csrfToken);
		}

		fetch('/auth/user',{
			method:'POST',
			headers: {
				"X-CSRF-TOKEN": token,
			}
		}).then((res)=>res.json())
		  .then((data:{user:boolean})=>{

				setUser(()=>data.user);
		  });

	  },[token])

	return (
		<Sheet>
			<SheetTrigger>
				<MenuIcon className="text-basic_white_color size-10" />
			</SheetTrigger>
			<SheetContent side="top" className="z-50 bg-black h-full">
				<nav className="flex flex-col justify-around items-center w-full h-full text-basic_white_color text-xl uppercase">
					<div className="items-center border-basic_white_color text-lg">
            {
              user?
			  <div className="flex flex-wrap justify-center items-center w-full" >
				<a href="/dashboard" className="mx-2 font-bold hover:text-basic_primary_color transition-all" >dashboard</a>
				<form action="/logout" method="POST" >
					<input type="hidden" name="_token" value={token}  />
					<button type="submit" className="bg-basic_primary_color p-1 rounded font-bold" >
					Deconnexion
					</button>
				</form>
			  </div>
              :
              <>
                  <a
                    href="/login"
                    className="mx-2 font-bold hover:text-basic_primary_color transition-all"
                  >
                    se connecter
                  </a>
                  <a
                    href="/register"
                    className="bg-basic_primary_color p-1 rounded font-bold"
                  >
                    Créer un compte
                  </a>
              </>

            }
		
					</div>

					<a href="/" className={`${getActiveElementClass("/")}`}>
						Accueil
					</a>

					{/* affiche une page qui liste les services */}
					<a href="/service" className={`${getActiveElementClass("/service")}`}>
						Nos Services
					</a>

					<a
						href="./pdf/prog.pdf"
						className="p-2 w-full font-bold hover:text-basic_primary_color transition-all hover:translate-x-4"
						download="programme.pdf"
					>
						Grille des programmes
					</a>

					<a
						href="/grille-tarifaire"
						className="p-2 w-full font-bold hover:text-basic_primary_color transition-all hover:translate-x-4"
					>
						Grille tarifaire
					</a>

					<a
						href="#replay"
						className="p-2 w-full font-bold hover:text-basic_primary_color transition-all hover:translate-x-4"
					>
						Podcast
					</a>
				</nav>
			</SheetContent>
		</Sheet>
	);
};
