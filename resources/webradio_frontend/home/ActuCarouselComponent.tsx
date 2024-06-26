import { define } from "hybrids"
import { createRoot } from "react-dom/client"
import { ActuCarousel } from "./ActuCarousel"


type ActuCarouselType={
    name:string,
    carouseldata:string
}


define<ActuCarouselType>({
    tag:"actu-carousel",
    carouseldata:'',
    name:{
        value:"actu_carousel",
        connect(host) {
            const {carouseldata}=host
            createRoot(host).render(<ActuCarousel data={carouseldata} />)

            return ()=>{ 
                createRoot(host).unmount()
             }

        },

    }
})