import { define } from "hybrids";
import { createRoot } from "react-dom/client";
import { ProgrammeDate } from "./ProgrammeDate";


type ProgrammeDateType={
    name:string
}

define<ProgrammeDateType>({
    tag:"programme-date",
    name:{
        value:"programme_date",
        connect(host) {
              console.log('okok');
            createRoot(host).render(<ProgrammeDate/>)
            
            return ()=>{ 
                createRoot(host).unmount()
             }

        },

    }
})