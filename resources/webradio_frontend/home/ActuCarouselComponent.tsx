import { define } from "hybrids"
import { createRoot } from "react-dom/client"
import { ActuCarousel } from "./ActuCarousel"


type ActuCarouselType={
    name:string
}


define<ActuCarouselType>({
    tag:"actu-carousel",
    name:{
        value:"actu_carousel",
        connect(host) {

            createRoot(host).render(<ActuCarousel/>)

            return ()=>{ 
                createRoot(host).unmount()
             }

        },

    }
})