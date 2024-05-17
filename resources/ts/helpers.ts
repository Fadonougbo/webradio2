

export const getActiveElementClass = (path: string) => {
	if (location.pathname !== "" && location.pathname === path) {
		return " p-2 w-full font-bold hover:text-basic_primary_color underline underline-offset-4 transition-all hover:translate-x-4 decoration-4 decoration-basic_primary_color decoration-solid ";
	}

	return "p-2 w-full font-bold hover:text-basic_primary_color  transition-all hover:translate-x-4";
};
