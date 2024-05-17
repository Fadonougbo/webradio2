
import {
  NavigationMenu,
  NavigationMenuContent,
  NavigationMenuItem,
  NavigationMenuLink,
  NavigationMenuList,
  NavigationMenuTrigger,
} from "@/components/ui/navigation-menu"
import { cn } from "@/lib/utils"
import { forwardRef } from "react";


 const getActiveElementClass = (path: string[]) => {

	if (location.pathname !== "" &&  path.includes(location.pathname)) {

		return "bg-black text-lg hover:text-basic_primary_color uppercase  underline underline-offset-4 decoration-4 decoration-basic_primary_color decoration-solid ";
	}

	return "bg-black text-lg hover:text-basic_primary_color uppercase";
};


const components: { title: string; href: string; description: string }[] = [
  {
    title: "Diffusion de spot publicitaire",
    href: "/service/publicite",
    description:
      "",
  },
  {
    title: "Avis de recherche",
    href: "#",
    description:
      "",
  },
  {
    title: "Dedicace du dimanache",
    href: "#",
    description:
      "",
  },
  {
    title: "Avis de remerciement",
    href: "#",
    description:
      "",
  },
  {
    title: "Annonce Nécrologique",
    href: "#",
    description:
      "",
  },
  {
    title: "Invite du journal ordinaire",
    href: "#",
    description:
      "",
  },
  {
    title: "Invite du journal politique",
    href: "#",
    description:
      "",
  },
  {
    title: "Invite du journal commercial",
    href: "#",
    description:
      "",
  },
  {
    title: "Communiqué,avis",
    href: "#",
    description:
      "",
  },
  {
    title: "Communiqué politique",
    href: "#",
    description:
      "",
  },
  {
    title: "Couverture médiatique",
    href: "#",
    description:
      "",
  },
  
]

export function MenuDeroulant() {
  return (
    <NavigationMenu className="hover:bg-black">
      <NavigationMenuList className="">
        
        <NavigationMenuItem className="">
          <NavigationMenuTrigger className={getActiveElementClass(['/service/publicite','/service'])} >Nos services</NavigationMenuTrigger>
          <NavigationMenuContent>
            <ul className="gap-3 grid md:grid-cols-2 p-4 w-[400px] md:w-[500px] lg:w-[600px]">
              {components.map((component) => (
                <ListItem
                  key={component.title}
                  title={component.title}
                  href={component.href}
                >
                  {component.description}
                </ListItem>
              ))}
            </ul>
          </NavigationMenuContent>
        </NavigationMenuItem>

        {/* <NavigationMenuItem>
          <a href="/docs">
            <NavigationMenuLink className={navigationMenuTriggerStyle()}>
              Documentation
            </NavigationMenuLink>
          </a>
        </NavigationMenuItem> */}
      </NavigationMenuList>
    </NavigationMenu>
  )
}

const ListItem = forwardRef<
  React.ElementRef<"a">,
  React.ComponentPropsWithoutRef<"a">
>(({ className, title, children, ...props }, ref) => {
  return (
    <li>
      <NavigationMenuLink asChild>
        <a
          ref={ref}
          className={cn(
            "block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground",
            className
          )}
          {...props}
        >
          <div className="font-medium text-sm leading-none">{title}</div>
          <p className="line-clamp-2 text-muted-foreground text-sm leading-snug">
            {children}
          </p>
        </a>
      </NavigationMenuLink>
    </li>
  )
})

ListItem.displayName = "ListItem"