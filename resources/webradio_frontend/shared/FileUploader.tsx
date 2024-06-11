
// Import React FilePond
import { FilePond, registerPlugin } from 'react-filepond';

import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import { useEffect, useState } from 'react';

import { create } from 'filepond';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import 'filepond/dist/filepond.min.css';

// Register the plugins
registerPlugin(FilePondPluginImageExifOrientation,FilePondPluginFileValidateSize,FilePondPluginFileValidateType, FilePondPluginImagePreview);

export const FileUploader=()=> {

    const [files, setFiles] = useState<{ source: string, options: { type: string } }[]>([]);

    const [token,setToken]=useState<string|undefined>()

    useEffect(()=> {

        const csrfToken= document?.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if(csrfToken) {
            setToken(()=> csrfToken)
        }
 
       
    },[])

    return (
        <div className="App">
            <FilePond
                files={files}

                allowMultiple={true}

                maxFiles={2}

                name="communique_file[]"
                onupdatefiles={setFiles}
                acceptedFileTypes={['application/pdf','audio/*','text/plain','application/vnd.openxmlformats-officedocument.wordprocessingml.document']}

                labelIdle='Drag & Drop your files or <span class="filepond--label-action">Browse</span>'

                allowFileSizeValidation={true}

                maxFileSize={'15mb'}
                
                server={{
                    
                    process:{
                        url:'http://localhost:8000/proccess',
                        method:'POST',
                        headers: {
                            'X-CSRF-TOKEN': token,
                        },
                        onload(response) {
                            const x=JSON.parse(response);
                            console.log(x.ok);
                            return x.ok;
                        },
                        ondata(data) {
                            console.log(Object.fromEntries(data));
                            return data
                        },
                        onerror(responseBody) {
                            return 'okok err'
                        }

                        
                    },
                    revert:{
                        url:'http://localhost:8000/proccess',
                        method:'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': token,
                        },
                        onload(response) {
                            const x=JSON.parse(response);
                            console.log(x.ok);
                            return x.ok;
                        },

                    },
                     load:{
                        url:'http://localhost:8000/proccess?load=',
                        onload(response) {
                            console.log(response);
                            return response
                        },
                        ondata(data) {
                            console.log(data,'data');
                            return data;
                        },
                        onerror(responseBody) {
                            console.log(responseBody);
                        },
                    },

                    restore:{
                        url:'',
                        onload(response) {
                            console.log(response);
                        },
                        ondata(data) {
                            console.log(data);
                        },
                        onerror(responseBody) {
                            console.log(responseBody);
                        },
                    }
 

                
                }}
    /* 
                Remplace la partie options par un fetch
                Essai de remplacez les on par les customs function

    */
                oninit={()=> {
                    setFiles((old)=> {
                        return [{
                            // the server file reference
                            source: 'eoeoe',
                
                            // set type to local to indicate an already uploaded file
                            options: {
                                type: 'limbo',
                                
                                file: {
                                    name: 'my-file.png',
                                    size: 3201025,
                                    type: 'image/png',
                                },
                            },
                        },]
                    })
                }}
            />
        </div>
    );

}