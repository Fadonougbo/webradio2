// Import React FilePond
import { FilePond, registerPlugin } from "react-filepond";

import FilePondPluginFileValidateSize from "filepond-plugin-file-validate-size";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImageExifOrientation from "filepond-plugin-image-exif-orientation";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import { useEffect, useState } from "react";

import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css";
import "filepond/dist/filepond.min.css";

// Register the plugins
registerPlugin(
	FilePondPluginImageExifOrientation,
	FilePondPluginFileValidateSize,
	FilePondPluginFileValidateType,
	FilePondPluginImagePreview,
);

type FileUploaderType = {
	type: "update" | undefined;
	service: "communique";
	identifiant: string;
};

export const FileUploader = ({
	type,
	identifiant,
	service,
}: FileUploaderType) => {
	const [files, setFiles] = useState<
		{ source: string; options: { type: string } }[]
	>([]);

	const [token, setToken] = useState<string>("");

	useEffect(() => {
		const csrfToken = document
			?.querySelector('meta[name="csrf-token"]')
			?.getAttribute("content");

		if (csrfToken) {
			setToken(() => csrfToken);
		}

		//Requete Ajax pour recupérer les fichiers de l'utilisateur
		//Dans le cas d'un update
		const typeIsValide = type === "update";

		const serviceExist = ["communique"].includes(service);

		const idExist = Number.isInteger(Number.parseInt(identifiant));

		const formData=new FormData();

		formData.set('type',service)

		formData.set('id',identifiant);

		if (typeIsValide && serviceExist && idExist) {

			fetch("/load/file", {
				headers: {
					"X-CSRF-TOKEN": token,
				},
				body:formData,
				method: "POST",
			})
            .then((res) => res.json())
            .then((data) => {
				console.log(data);
                setFiles(()=> {
                    return [...data]
                })
            });
		}


	}, [type, token,identifiant,service]);

	return (
		<div className="App">
			<FilePond
				files={files}
				
				allowMultiple={true}
				
				maxFiles={2}
				
				minFileSize={1}
				
				name="communique_files[]"
				
				onupdatefiles={setFiles}
				
				acceptedFileTypes={[
					"application/pdf",
					"audio/*",
					"text/plain",
					"application/vnd.openxmlformats-officedocument.wordprocessingml.document",
				]}
				
				labelIdle='Drag & Drop your files or <span class="filepond--label-action">Browse</span>'

				allowFileSizeValidation={true}

				maxFileSize={"48mb"}

				server={{
					headers: {
						"X-CSRF-TOKEN": token,
					},
					process: {
						url: "http://localhost:8000/process",
					},
					revert: {
						url:"http://localhost:8000/revert"
					}
				}}

			/>
		</div>
	);
};
