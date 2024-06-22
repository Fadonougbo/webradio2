import "@blocknote/core/fonts/inter.css";
import { BlockNoteView } from "@blocknote/mantine";
import "@blocknote/mantine/style.css";
import { type DefaultReactSuggestionItem, SuggestionMenuController,getDefaultReactSlashMenuItems, useCreateBlockNote } from "@blocknote/react";

import { type Block, type BlockNoteEditor, filterSuggestionItems } from "@blocknote/core";
import { type MouseEvent, useEffect, useRef, useState } from "react";

import ky from 'ky'

import "../../css/editor.css";


   
  // List containing all default Slash Menu Items, as well as our custom one.
  //Je supprime l'option ajout de fichier du slash menu
  const getCustomSlashMenuItems = (
	editor: BlockNoteEditor
  ): DefaultReactSuggestionItem[] =>{

	const allSlashItems=[...getDefaultReactSlashMenuItems(editor)]

	const newSlashItems=allSlashItems.filter((item)=> {
		return item.title !== 'File'
	})

	return newSlashItems
	
  } 

const csrfToken = document
		?.querySelector('meta[name="csrf-token"]')
		?.getAttribute("content") ;



  const allPath:(string[])=[]

  const uploadFile=async (file:File)=> {

	
	const formData=new FormData()

	formData.set('editor_file',file)
	console.log(csrfToken);
	const req=await ky.post('/dashboard/administration/blog/upload/file',{
		headers:{
			"X-CSRF-TOKEN": csrfToken??''
		},
		body:formData
		
	})

	const data=await req.json<string>()

	if(data) {
		allPath.push(data)
	}

	return data
		//throw new Error('File not upload')

  }




export const Editor = () => {

	const hiddenIputeRef=useRef<HTMLInputElement|null>(null)

	const valideFileInputRef=useRef<HTMLInputElement|null>(null)

	const invalideileInputRef=useRef<HTMLInputElement|null>(null)

	const [blocks, setBlocks] = useState<Block[]>([]);

	const [token,setToken]=useState('')


	
	const oldEditorData=localStorage.getItem('editor_data') 

	const editorData=oldEditorData!==null?{initialContent:JSON.parse(oldEditorData)}:{}

	// Creates a new editor instance.
	const editor = useCreateBlockNote({
		uploadFile:uploadFile,
		...editorData
	});



	

	useEffect(()=> {

		//Remove old data from localstorage pour qu'il ne rest pas eternelement dans le local storage
		//Sinon il s'affichera chaque fois
		localStorage.getItem('editor_data')?localStorage.removeItem('editor_data'):''
		
		/* const csrfToken = document
		?.querySelector('meta[name="csrf-token"]')
		?.getAttribute("content"); */

			/* if (csrfToken) {
				setToken(() => csrfToken);
			} */

	},[])

	
	const click=(e:MouseEvent)=> {

		//Liste des images gardées par l'utilisateur
		const utilsFile:string[]=[]
		//Apres soumision je conserve les medias de l'utilisateur
		// biome-ignore lint/complexity/noForEach: <explanation>
		editor.document.forEach((item)=> {
			if(item.type==='image') {
				utilsFile.push(item.props.url)
				//console.log();
			}
		})

		const invalideFiles=allPath.filter((file)=> {

			return utilsFile.includes(file)===false
		})

			const form=e.currentTarget.closest('form')

 			const input=hiddenIputeRef.current

			if(input && editor.document.length>1) {
				e.preventDefault()
				const content=JSON.stringify(editor.document)

				input.value=content

				localStorage.setItem('editor_data',content);

			}
			

			if(valideFileInputRef?.current && invalideileInputRef?.current ) {

				valideFileInputRef.current.value=`${JSON.stringify(utilsFile)}`

				invalideileInputRef.current.value=`${JSON.stringify(invalideFiles)}`
			}

			console.log(valideFileInputRef.current?.value,'valide');

			console.log(invalideileInputRef.current?.value,'invalide');

			
				form?.submit()

			
			
	}

	// Renders the editor instance using a React component.
	return (
		<>
			<BlockNoteView
				editor={editor}
				data-theming-css-variables-new
				slashMenu={false}
			    
			>
			<SuggestionMenuController
				triggerCharacter={"/"}
				// Replaces the default Slash Menu items with our custom ones.
				getItems={async (query) =>{
					
					return filterSuggestionItems(getCustomSlashMenuItems(editor), query)
					}
				}
			/>
			
			</BlockNoteView>

			<input type="hidden" name="content" defaultValue={''} ref={hiddenIputeRef} />
			

			<input type="hidden" name="blog_valide_files" defaultValue={''} ref={valideFileInputRef} />

			<input type="hidden" name="blog_files_need_drop" defaultValue={''} ref={invalideileInputRef} />

			<div className="flex justify-center my-6 w-full" >
				<button 
					 onClick={click}
					 type="submit"
					 className="w-full sm:w-2/3 lg:w-1/2 text-white text-xl uppercase btn btn-lg btn-success"  > 
					 
					 valider

				</button>
			</div>
			
		</>
	);
};
