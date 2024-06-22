import { define } from "hybrids"
import { createRoot } from "react-dom/client"
import { Editor } from "./Editor"


type ActuCarouselType={
    name:string
}


define<ActuCarouselType>({
    tag:"blog-editor",
    name:{
        value:"blog_editor",
        connect(host) {
            createRoot(host).render(<Editor/>)

            return ()=>{ 
                createRoot(host).unmount()
             }

        },

    }
})