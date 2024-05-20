import {PlusCircle} from 'lucide-react'
import { useState } from 'react'

export const ProgrammeDate=()=> {

    const [size,setSize]=useState(1)

    const arr=Array(size).fill(0);

    const fields=arr.map((el,key)=>{

        return <ProgrammeField programmeKey={key+1} key={key} />
    })

    const add=()=> {

        setSize((state)=>state+1)
    }


    return (
        <div className="my-3 w-full md:w-3/4 lg:w-1/2" >
        
        <label htmlFor="pub_date" className="my-6 font-bold text-lg" >Programme de diffusion (required)</label>
        
        {fields}

        <section className='flex justify-end my-1 w-full' >
            <button type="button" className='bg-blue-600 p-1 rounded text-basic_white_color' onClick={add} >Ajouter un nouveau programme <PlusCircle className='inline-block' />  </button>
        </section>
        </div>
    )
}

const ProgrammeField=({programmeKey}:{programmeKey:number})=> {

    return (
        <div className='my-4' >
            <span className='text-xl' >{programmeKey}</span>
            <input type="date" defaultValue="" className="my-2 rounded w-full" name="pub_date" />

            <select name="pub_periode" id="pub_periode" className="my-2 rounded w-full" defaultValue="" >

                <option value="6:45">6h 45 (en français et en fon)</option>

                <option value="13:20">13h 20 (en français )</option>

                <option value="13:45">13h 40 (en fon )</option>
                <option value="18:45">18h 45 (en français et en fon)</option>
                <option value="19:20">19h 20 (en français </option>
                <option value="19:45">19h 45 ( en fon)</option>
                <option value="21:45">21h 45 (en français et en fon)</option>

            </select>
        </div>
    )
}