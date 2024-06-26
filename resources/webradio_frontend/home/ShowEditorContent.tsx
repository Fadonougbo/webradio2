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

        //Par defaut les audios et les videos ne s'affiche pas parcequ'il n'ont pas l'attribut controls
        const audios=[...document.querySelectorAll('#wrapper audio')] as HTMLAudioElement[];

        const videos=[...document.querySelectorAll('#wrapper video')] as HTMLVideoElement[];

        if(audios.length>0) {
          for (const audio of audios) {
            audio.setAttribute('controls','')
          }
        }

        if(videos.length>0) {
          for (const video of videos) {
            video.setAttribute('controls','')
          }
        }
       

    });


  },[]) 
 
  // Renders the editor instance, and its contents as HTML below.
  return (
      <div id="wrapper" ref={containerRef}>
          
      </div>
  );
}
 