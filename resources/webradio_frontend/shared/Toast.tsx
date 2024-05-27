
import { type PropsWithChildren, useEffect } from 'react';
import { ToastContainer, toast } from 'react-toastify';

// minified version is also included
import 'react-toastify/dist/ReactToastify.min.css';

type ToastType=PropsWithChildren<{
  msg:string,
  type:'info'|'error'|'warn'|'success',
  delay:number
}>

export const Toast=({msg,type,delay}:ToastType)=> {

    useEffect(()=> {

        toast[type](msg, {
            position: "top-right",
            autoClose: delay,
            hideProgressBar: false,
            closeOnClick: true,
            pauseOnHover: true,
            draggable: true,
            progress: undefined,
            theme: "dark"
            });



    },[type,msg,delay])

  return (
    <div>
      
      <ToastContainer />
    </div>
  );
}