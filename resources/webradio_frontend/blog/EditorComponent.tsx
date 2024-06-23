import { define } from "hybrids"
import { createRoot } from "react-dom/client"
import { Editor } from "./Editor"


type EditorType={
    name:string,
    articlecontent:string
}


define<EditorType>({
    tag:"blog-editor",
    articlecontent:'',
    name:{
        value:"blog_editor",
        connect(host) {
            const {articlecontent}=host
            createRoot(host).render(<Editor content={articlecontent} />)

            return ()=>{ 
                createRoot(host).unmount()
             }

        },

    }
})