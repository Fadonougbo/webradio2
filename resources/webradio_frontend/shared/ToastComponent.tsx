
import { define } from "hybrids"
import { createRoot } from "react-dom/client"
import { Toast } from "./Toast"

//import "https://cdn.fedapay.com/checkout.js?v=1.1.7"

FedaPay.init('#test',{ public_key: 'pk_sandbox_cSCumLLKmrzKFwWvB61E6WRW'})

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

