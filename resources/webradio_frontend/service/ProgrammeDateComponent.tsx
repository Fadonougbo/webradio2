import { define } from "hybrids";
import { createRoot } from "react-dom/client";
import { ProgrammeDate } from "./ProgrammeDate";


type ProgrammeDateType={
    name:string,
    date_error:string
    periode_error:string,
    old:string,
    data:string
}

define<ProgrammeDateType>({
    tag:"programme-date",
    date_error:'',
    periode_error:'',
    old:'',
    data:'',
    name:{
        value:"programme_date",
        connect(host) {
              const {date_error,periode_error,old,data}=host
              
            createRoot(host).render(<ProgrammeDate old={old} periodeError={periode_error} dateError={date_error} data={data} />)
            
            return ()=>{ 
                createRoot(host).unmount()
             }

        },

    }
})