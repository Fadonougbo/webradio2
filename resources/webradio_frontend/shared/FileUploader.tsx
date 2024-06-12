
// Import React FilePond
import { FilePond, registerPlugin } from 'react-filepond';

import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import { useEffect, useState } from 'react';

import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import 'filepond/dist/filepond.min.css';

// Register the plugins
registerPlugin(FilePondPluginImageExifOrientation,FilePondPluginFileValidateSize,FilePondPluginFileValidateType, FilePondPluginImagePreview);

export const FileUploader=()=> {

    const [files, setFiles] = useState<{ source: string, options: { type: string } }[]>([]);

    const [token,setToken]=useState<string>('')

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
                minFileSize={1}

                name="communique_files[]"
                
                onupdatefiles={setFiles}
                acceptedFileTypes={['application/pdf','audio/*','text/plain','application/vnd.openxmlformats-officedocument.wordprocessingml.document']}

                labelIdle='Drag & Drop your files or <span class="filepond--label-action">Browse</span>'

                allowFileSizeValidation={true}

                maxFileSize={'20mb'}
                
                server={{
                    headers: {
                        'X-CSRF-TOKEN': token,
                    },
                    process:{
                        url:'http://localhost:8000/process',
                       
                    },
                    revert:'http://localhost:8000/revert'
 
                }}
                

            />
        </div>
    );

}

