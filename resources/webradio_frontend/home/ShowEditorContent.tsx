import "@blocknote/core/fonts/inter.css";
import "@blocknote/mantine/style.css";
import { useCreateBlockNote } from "@blocknote/react";
import { useEffect, useRef, useState } from "react";
import '../../css/showContent.css'
 
export  const EditorContent=({content}:{content:string})=> {
  // Stores the editor's contents as HTML.
  const [html, setHTML] = useState<string>("");

  const containerRef=useRef<HTMLDivElement|null>(null)

  const [body,setBody]=useState({initialContent:JSON.parse(content)})

  //console.log(JSON.parse(content));

  const editor = useCreateBlockNote({
    ...body
  });

  useEffect(()=> {

   
    editor.blocksToHTMLLossy(editor.document).then((html)=> {
        setHTML(html);
        if(containerRef.current) {
            containerRef.current.innerHTML=html
        }

    });


  },[]) 
 
  // Renders the editor instance, and its contents as HTML below.
  return (
      <div id="wrapper" ref={containerRef}>
          
      </div>
  );
}
 