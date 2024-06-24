import { define } from "hybrids";
import { createRoot } from "react-dom/client";
import { Menu } from "./Menu";
import { MenuDeroulant } from "./MenuDeroulant";
import { OnlineRadio } from "./OnlineRadio";
import { EditorContent } from "./ShowEditorContent";


type EditorContentType={
    editorcontent:string,
    name:string
}

define<EditorContentType>({
    tag:"editor-content",
    editorcontent:'',
    name:{
        value:"editor_content",
        connect(host) {
            const {editorcontent}=host

            createRoot(host).render(<EditorContent content={editorcontent}  />)

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

      
              
            createRoot(host).render(<OnlineRadio/>)
            
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

      
              
            createRoot(host).render(<MenuDeroulant/>)
            
            return ()=>{ 
                createRoot(host).unmount()
             }

        },

    }
})