import { define } from "hybrids"
import { createRoot } from "react-dom/client"
/* import { ScrollTo } from "./ScrollTo" */

interface BasicInterface{
    data:string,

}

define<BasicInterface>({
    tag:'scroll-to',
    data:{
        value:'scroll_to',
        connect(host) {

            import( "./ScrollTo").then(({ScrollTo})=> {
                createRoot(host).render(<ScrollTo  />)
            })

            return ()=> {
                createRoot(host).unmount()
            }
        },

    }
})

