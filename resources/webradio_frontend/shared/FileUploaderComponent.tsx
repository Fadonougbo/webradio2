import { define } from "hybrids"
import { createRoot } from "react-dom/client"
import { FileUploader } from "./FileUploader"

interface BasicInterface{
    data:string,
    type:'update'|undefined,
    service:'communique',
    identifiant:string

}

define<BasicInterface>({
    tag:'file-uploader',
    type:undefined,
    service:'communique',
    identifiant:'',
    data:{
        value:'file_uploader',
        connect(host) {
            
            const {type,identifiant,service}=host
            
            createRoot(host).render(<FileUploader type={type} identifiant={identifiant} service={service} />)

            return ()=> {
                createRoot(host).unmount()
            }
        },

    }
})
