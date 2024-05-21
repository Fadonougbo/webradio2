
import { useEffect } from 'react';
import { ToastContainer, toast } from 'react-toastify';

import 'react-toastify/dist/ReactToastify.css';
// minified version is also included
// import 'react-toastify/dist/ReactToastify.min.css';

export const Toast=()=> {

    useEffect(()=> {

        toast.info("Le formulaire n'est pas valide, veuillez vérifier vos informations et réessayer à nouveau.  ", {
            position: "top-right",
            autoClose: 15000,
            hideProgressBar: false,
            closeOnClick: true,
            pauseOnHover: true,
            draggable: true,
            progress: undefined,
            theme: "dark"
            });

    },[])

  return (
    <div>
      
      <ToastContainer />
    </div>
  );
}