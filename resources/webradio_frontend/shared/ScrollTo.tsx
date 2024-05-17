import { ChevronUp } from 'lucide-react'
import { useEffect, useState } from 'react'
import { createPortal } from 'react-dom'
import { useDebounceCallback } from 'usehooks-ts'



export  const ScrollTo=()=> {

    
    const [show,setShow]=useState(false)

    const showScrollToTopArrow=()=>{
        
        window.scrollY>=360 && window.scrollY<=3810?setShow(true):setShow(false);
    }

    const debouncedFunction = useDebounceCallback(showScrollToTopArrow, 240,{})
    
    useEffect(()=> {

        debouncedFunction()

       const onScroll=()=> {

           debouncedFunction();
           
       }

        
        window.addEventListener('scroll',onScroll)

        return ()=> {
            window.removeEventListener('scroll',onScroll)
        }

    },[])

    const click=()=> {
        window.scrollTo({
            top:0,
            behavior:'smooth'
        })
    }


    const style=show?'flex fixed':'hidden'

    return createPortal(
    // biome-ignore lint/a11y/useKeyWithClickEvents: <explanation>
<div className={`top-[80%] justify-center items-center right-7 cursor-pointer ${style}  bg-black/85 rounded-full w-14 h-14`} onClick={click} ><ChevronUp className='text-white' size={60} /></div>,
    document.body)
}