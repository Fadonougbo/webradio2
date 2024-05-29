import {  PlusCircle} from "lucide-react";
import { type PropsWithChildren, useEffect, useState } from "react";

/* Cherche des indexs dans le localStorage */
const findOldFiels=():number[]=> {

    const res=localStorage.getItem('indexs')

    return res===null?[]:JSON.parse(res)

}


/* Pour afficher les messages d'erreur liés au date */
// Selectionne automatiquement le bon message
const getDateErrorMessage=(index:number,errorList:string)=> {

    const errors=JSON.parse(errorList);

    return errors[`programme.${index}.date`]?errors[`programme.${index}.date`][0]:''
}

/* Pour afficher les messages d'erreur liés a l'heur */
//Selectionne automatiquement le bon message
const getPeriodeErrorMessage=(index:number,errorList:string)=> {

    const errors=JSON.parse(errorList);

    return errors[`programme.${index}.periode`]?errors[`programme.${index}.periode`][0]:''
}

//Pour selectionner l'ancienne valeur entré par l'utilisateur
const getOldData=(index:number,old:string):string|null=> {

	const data=JSON.parse(old)?.programme



	return  data?.[index]?data[index].date:null
}


type ProgrammeDateType=PropsWithChildren<{
    dateError:string,
    periodeError:string,
    old:string,
	data:string
}>


export const ProgrammeDate = ({dateError,periodeError,old,data}:ProgrammeDateType) => {


    /* Contient une liste d'index pour faire un map et afficher les champ */
	const [indexs, setIndexs] = useState<number[]>([]);

	//parse data Send by update form
	const parseData=Array.isArray(JSON.parse(data))?JSON.parse(data):[] as object[];


    useEffect(()=> {
        
		
		let indexs=[]

		indexs=findOldFiels()
		
		//Update case
		if(parseData.length>0) {
			const dataID=parseData.map((d,key)=>key)

			indexs=dataID
		}
         
        setIndexs(()=>[...indexs])
    },[data])

    /**
     * Ajouter un champ
     */
	const add = () => {

		setIndexs((oldState) => {

			if (oldState?.at(-1) === undefined) {

                const value=[1]

                localStorage.setItem('indexs',JSON.stringify(value))

				return value;
			}

           const value=[...oldState, indexs.at(-1) + 1]

           localStorage.setItem('indexs',JSON.stringify(value))

			return value;
		});

        

	};


    /**
     * Supprimer un champ
     * @param index number
     */
	const remove = (index:number) => {

		const newArr=indexs.filter((el)=>{

            return el !== index
        })

        const value=newArr

        localStorage.setItem('indexs',JSON.stringify(value))

        setIndexs(()=> newArr)
	};

	const fields = indexs.map((el) => {

		return <ProgrammeField programmeKey={el} old={old} data={parseData} periodeError={periodeError} dateError={dateError} remove={remove} key={el} />;

	});

	return (
		<div className="my-3 w-full md:w-3/4 lg:w-1/2">
			<label htmlFor="pub_date" className="my-6 font-bold text-lg">
				Programme de diffusion (required)
			</label>


			
			{parseData.length===0?<BasicProgrammeField dateError={dateError} old={old} periodeError={periodeError} />:''}

			{fields}

			{
				parseData.length>=1?''
				:<section className="flex justify-end my-1 w-full">
				<button
					type="button"
					className="bg-blue-600 p-1 rounded text-basic_white_color"
					onClick={add}
				>
						Ajouter un nouveau programme <PlusCircle className="inline-block" />{" "}
					</button>
				</section>
			}
			
		</div>
	);
};

type ProgrammeFieldType = PropsWithChildren<{
	programmeKey: number;
	remove: (index:number) => void;
    dateError:string
    periodeError:string,
	old:string,
	data:object[]
}>;

const ProgrammeField = ({ programmeKey,old,data, remove,dateError,periodeError }: ProgrammeFieldType) => {

    const removeElement=()=> {
        remove(programmeKey)
    }

	console.log(programmeKey);

	return (
		<div className="my-4">
			<section className="flex justify-end">
				{/* si programmeKey===0 alors on n'est dans un update et dans un update on n'a pas de un champ par defaut  */}
				<button type="button" onClick={removeElement} className={`bg-black ${programmeKey===0?'hidden':''} rounded-full text-basic_white_color text-xl size-8`} >X</button>
			</section>

			{/* 
				Dans le cas 'data.length>0' on n'est entraint de modifier une annonce
			*/}
			<input
				type="date"
				defaultValue={data.length>0?data[programmeKey].periode_date:`${getOldData(programmeKey,old)}`}
				className="my-2 rounded w-full"
				name={`programme[${programmeKey}][date]`}
			/>

            <p className="text-basic_primary_color text-end" >{getDateErrorMessage(programmeKey,dateError)}</p>

			<select
				name={`programme[${programmeKey}][periode]`}
				id="pub_periode"
				className="my-2 rounded w-full"
				defaultValue={data.length>0?data[programmeKey].periode_hour:''}
				
			>
				<option value="6:45:00">6h 45 (en français et en fon)</option>

				<option value="13:20:00">13h 20 (en français )</option>

				<option value="13:45:00">13h 40 (en fon )</option>
				<option value="18:45:00">18h 45 (en français et en fon)</option>
				<option value="19:20:00">19h 20 (en français </option>
				<option value="19:45:00">19h 45 ( en fon)</option>
				<option value="21:45:00">21h 45 (en français et en fon)</option>
			</select>

			{/* Affiche un message d'erreur lier a l'heure */}
            <p className="text-basic_primary_color text-end" >{getPeriodeErrorMessage(programmeKey,periodeError)}</p>
		</div>
	);
};


const BasicProgrammeField=({old,dateError,periodeError})=> {


	return (

		<div className="my-4">
				<input
					type="date"
					defaultValue={`${getOldData(0,old)}`}
					className="my-2 rounded w-full"
					name="programme[0][date]"
				/>

                <p className="text-basic_primary_color text-end" >{getDateErrorMessage(0,dateError)}</p>

				<select
					name="programme[0][periode]"
					id="pub_periode"
					className="my-2 rounded w-full"
					defaultValue=""
				>
					<option value="6:45:00">6h 45 (en français et en fon)</option>

					<option value="13:20:00">13h 20 (en français )</option>

					<option value="13:45:00">13h 40 (en fon )</option>
					<option value="18:45:00">18h 45 (en français et en fon)</option>
					<option value="19:20:00">19h 20 (en français </option>
					<option value="19:45:00">19h 45 ( en fon)</option>
					<option value="21:45:00">21h 45 (en français et en fon)</option>
				</select>

                <p className="text-basic_primary_color text-end" >{getDateErrorMessage(0,periodeError)}</p>


			</div>
	)

}
