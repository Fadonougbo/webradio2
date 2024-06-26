import { define } from "hybrids";
import { createRoot } from "react-dom/client";
/* import { MenuDeroulant } from "./MenuDeroulant";
 *//* import { OnlineRadio } from "./OnlineRadio";
 */

type MenuType={
    name:string,
    
}

define<MenuType>({
    tag:"menu-burger",

    name:{
        value:"menu_burger",
        connect(host) {

            import("./Menu").then(({Menu})=> {
                createRoot(host).render(<Menu  />)
            })

            return ()=>{ 
                createRoot(host).unmount()
             }

        },

    }
})




type OnlineRadioType={
    name:string
}


define<OnlineRadioType>({
    tag:"online-radio",
    name:{
        value:"online_radio",
        connect(host) {

            import("./OnlineRadio").then(({OnlineRadio})=> {
                createRoot(host).render(<OnlineRadio  />)
            })
            
            return ()=>{ 
                createRoot(host).unmount()
             }

        },

    }
})

type MenuDeroulantType={
    name:string
}


define<MenuDeroulantType>({
    tag:"menu-deroulant",
    name:{
        value:"menu_deroulant",
        connect(host) {

            import("./MenuDeroulant").then(({MenuDeroulant})=> {
                createRoot(host).render(<MenuDeroulant  />)
            })
            
            return ()=>{ 
                createRoot(host).unmount()
             }

        },

    }
})