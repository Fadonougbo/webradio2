import {  PlusCircle} from "lucide-react";
import { type PropsWithChildren, useEffect, useState } from "react";

/* Cherche des indexs dans le localStorage */
const findOldFiels=():number[]=> {

    const res=localStorage.getItem('indexs')

    return res===null?[]:JSON.parse(res)

}

type ProgrammeDateType=PropsWithChildren<{
    dateError:string,
    periodeError:string,
    old:string
}>

/* Pour afficher les messages d'erreur liés au date */
const getDateErrorMessage=(index:number,errorList:string)=> {

    const errors=JSON.parse(errorList);

    return errors[`programme.${index}.date`]?errors[`programme.${index}.date`][0]:''
}

/* Pour afficher les messages d'erreur liés a l'heur */
const getPeriodeErrorMessage=(index:number,errorList:string)=> {

    const errors=JSON.parse(errorList);

    return errors[`programme.${index}.periode`]?errors[`programme.${index}.periode`][0]:''
}

const getOldData=(index:number,old:string):string|null=> {

	const data=JSON.parse(old)?.programme

	return  data?data[index].date:null
}

export const ProgrammeDate = ({dateError,periodeError,old}:ProgrammeDateType) => {


	console.log();
    /* Contient une liste d'index pour faire un map et afficher les champ */
	const [indexs, setIndexs] = useState<number[]>([]);

    useEffect(()=> {
        
        const indexs=findOldFiels()
        setIndexs(()=>[...indexs])
    },[])

    /**
     * Ajoute un champ
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
     * Supprime un champ
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

		return <ProgrammeField programmeKey={el} old={old} periodeError={periodeError} dateError={dateError} remove={remove} key={el} />;

	});

	return (
		<div className="my-3 w-full md:w-3/4 lg:w-1/2">
			<label htmlFor="pub_date" className="my-6 font-bold text-lg">
				Programme de diffusion (required)
			</label>

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
					<option value="6:45">6h 45 (en français et en fon)</option>

					<option value="13:20">13h 20 (en français )</option>

					<option value="13:45">13h 40 (en fon )</option>
					<option value="18:45">18h 45 (en français et en fon)</option>
					<option value="19:20">19h 20 (en français </option>
					<option value="19:45">19h 45 ( en fon)</option>
					<option value="21:45">21h 45 (en français et en fon)</option>
				</select>

                <p className="text-basic_primary_color text-end" >{getDateErrorMessage(0,periodeError)}</p>


			</div>

			{fields}

			<section className="flex justify-end my-1 w-full">
				<button
					type="button"
					className="bg-blue-600 p-1 rounded text-basic_white_color"
					onClick={add}
				>
					Ajouter un nouveau programme <PlusCircle className="inline-block" />{" "}
				</button>
			</section>
		</div>
	);
};

type ProgrammeFieldType = PropsWithChildren<{
	programmeKey: number;
	remove: (index:number) => void;
    dateError:string
    periodeError:string,
	old:string
}>;

const ProgrammeField = ({ programmeKey,old, remove,dateError,periodeError }: ProgrammeFieldType) => {

    const removeElement=()=> {
        remove(programmeKey)
    }

	return (
		<div className="my-4">
			<section className="flex justify-end">

				<button type="button" onClick={removeElement} className="bg-black rounded-full text-basic_white_color text-xl size-8" >X</button>
			</section>
			<input
				type="date"
				defaultValue={`${getOldData(programmeKey,old)}`}
				className="my-2 rounded w-full"
				name={`programme[${programmeKey}][date]`}
			/>

            <p className="text-basic_primary_color text-end" >{getDateErrorMessage(programmeKey,dateError)}</p>

			<select
				name={`programme[${programmeKey}][periode]`}
				id="pub_periode"
				className="my-2 rounded w-full"
				defaultValue=""
			>
				<option value="6:45">6h 45 (en français et en fon)</option>

				<option value="13:20">13h 20 (en français )</option>

				<option value="13:45">13h 40 (en fon )</option>
				<option value="18:45">18h 45 (en français et en fon)</option>
				<option value="19:20">19h 20 (en français </option>
				<option value="19:45">19h 45 ( en fon)</option>
				<option value="21:45">21h 45 (en français et en fon)</option>
			</select>

            <p className="text-basic_primary_color text-end" >{getPeriodeErrorMessage(programmeKey,periodeError)}</p>
		</div>
	);
};
