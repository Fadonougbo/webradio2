import { define } from "hybrids"
import { createRoot } from "react-dom/client"
import { FileUploader } from "./FileUploader"

interface BasicInterface{
    data:string,

}

define<BasicInterface>({
    tag:'file-uploader',
    data:{
        value:'file_uploader',
        connect(host) {
            createRoot(host).render(<FileUploader/>)

            return ()=> {
                createRoot(host).unmount()
            }
        },

    }
})
