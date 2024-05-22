
import { define } from "hybrids"
import { createRoot } from "react-dom/client"
import { Toast } from "./Toast"



interface BasicInterface{
    data:string,

}



define<BasicInterface>({
    tag:'message-toast',
    data:{
        value:'message_toast',
        connect(host) {
            createRoot(host).render(<Toast/>)

            return ()=> {
                createRoot(host).unmount()
            }
        },

    }
})

