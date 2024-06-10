
// A basic example

import { Pause, Play } from 'lucide-react';
import {  useRef, useState } from 'react';



export const OnlineRadio=()=> {

    const audioRef=useRef<HTMLAudioElement>(null) 

    const [audioState,setAudioState]=useState(false)
   

    const audio = new Audio()
    audio.controls = true
    

    const playAudio=()=> {

        setAudioState((state)=>!state)

        if(!audioState) {
            audioRef.current?.play()
        }else {
            audioRef.current?.pause()
        }
       

    }



    return (
       

        <div  className='flex justify-center items-center cursor-pointer'  onClick={playAudio}  >
          
             <p className='mx-4 text-basic_white_color text-md uppercase' > Ecoutez rtu en direct</p> 

            <span className="relative cursor-pointer size-8" >

                <span className={`inline-flex absolute bg-basic_primary_color opacity-75 rounded-full w-full h-full ${audioState?'animate-ping':''} `}>
                </span>

              

                <span className="relative flex justify-center items-center bg-basic_primary_color rounded-full size-8">
                    {audioState?<Pause className='text-basic_white_color'  />:<Play className='text-basic_white_color' />}
                </span>

            </span>
            
            <audio src="https://stream.zeno.fm/qyfhx0ijbzuvv" ref={audioRef} className='absolute opacity-0 size-1'  controls></audio>

        </div>
    )
}
