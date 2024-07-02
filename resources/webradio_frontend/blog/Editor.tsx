import "@blocknote/core/fonts/inter.css";
import { BlockNoteView } from "@blocknote/mantine";
import "@blocknote/mantine/style.css";
import { type DefaultReactSuggestionItem, SuggestionMenuController,getDefaultReactSlashMenuItems, useCreateBlockNote } from "@blocknote/react";

import { type BlockNoteEditor, filterSuggestionItems } from "@blocknote/core";
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
		

  }



  //Determine si il  y a du text dans l'editeur
  const editorNotEmpty=(document:any[]):boolean=> {

	//cas ou on n'a du plusieur contenu dans l'editeur
	if(document.length>2) {
		return true
	}

	//Cas ou l'editeur est vide
	if(document.length===1) {
		return false
	}

	let count=0 

	//Cas ou on ecrit du text et on supprime tout le text
	if(document.length===2) {

		for (const doc of document) {

			if(!Array.isArray(doc.content)) {
				count=0				
			}else if(doc.content.length===0) {
				count+=1
			}

		}

	}

	return count>0 && count!==2
  }

  const oldEditorData=localStorage.getItem('editor_data') 
  console.log(oldEditorData);
  //Suppression du contenu du localstorage
  localStorage.getItem('editor_data')?localStorage.removeItem('editor_data'):''

export const Editor = ({content}:{content:string}) => {

	const hiddenIputeRef=useRef<HTMLInputElement|null>(null)

	const valideFileInputRef=useRef<HTMLInputElement|null>(null)

	const invalideileInputRef=useRef<HTMLInputElement|null>(null)

	//const [editorData,setEditorData]=useState({})

	let editorData={}

	if(content!=='') {
		editorData={initialContent:JSON.parse(content)}
	}

	if(oldEditorData!==null) {
		editorData={initialContent:JSON.parse(oldEditorData)}
	}
	
	

	// Creates a new editor instance.
	const editor = useCreateBlockNote({
		uploadFile:uploadFile,
		...editorData
	});



	const click=(e:MouseEvent)=> {

		e.preventDefault()

		//Liste des images gardées par l'utilisateur
		const utilsFile:string[]=[]

		//Apres soumision je conserve les medias de l'utilisateur
		const valideType=['image','audio','video']
		// biome-ignore lint/complexity/noForEach: <explanation>
		editor.document.forEach((item)=> {
			
			if(valideType.includes(item.type)) {
				utilsFile.push(item.props.url)
				
			}
		})

		//Je filtre les medias supprimés par l'utilisateur lors de la creation de l'article
		const invalideFiles=allPath.filter((file)=> {

			return utilsFile.includes(file)===false
		})

			const form=e.currentTarget.closest('form')

 			const input=hiddenIputeRef.current

			const content=JSON.stringify(editor.document)

			localStorage.setItem('editor_data',content);

			//Si le contenu de l'editeur est valide
			if(input && editorNotEmpty(editor.document)) {
				
				input.value=content

				

			} 
			
			//Si le contenu de l'editeur est invalide
			if(input && !editorNotEmpty(editor.document)) {
					input.value=''
			}
		

			if(valideFileInputRef?.current && invalideileInputRef?.current ) {

				valideFileInputRef.current.value=`${JSON.stringify(utilsFile)}`

				invalideileInputRef.current.value=`${JSON.stringify(invalideFiles)}`
			}

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
