import Carousel from "react-multi-carousel";
import "react-multi-carousel/lib/styles.css";

export const ActuCarousel=()=> {


    const responsive = {
        superLargeDesktop: {
          // the naming can be any, depends on you.
          breakpoint: { max: 4000, min: 3000 },
          items: 5
        },
        desktop: {
          breakpoint: { max: 3000, min: 1024 },
          items: 3
        },
        tablet: {
          breakpoint: { max: 1024, min: 780 },
          items: 2
        },
        mobile: {
          breakpoint: { max: 768, min: 0 },
          items: 1,
        }
      };
     return ( <Carousel responsive={responsive} className="z-[2] my-6"
        infinite={true}
        autoPlay={false}
        keyBoardControl={true}
        autoPlaySpeed={4500}
        showDots={true}
        removeArrowOnDeviceType={["tablet", "mobile"]}
        

     >
        <div  className="relative bg-[url('../../../public/images/actu1.png')] bg-cover bg-center mx-4 p-4 rounded h-56"  >
            <span className="top-4 left-4 absolute bg-basic_primary_color px-2 rounded-full text-basic_white_color text-sm uppercase" >7 mai 2024</span>

            <a href="#" className="bottom-1 left-1 absolute bg-black/45 mt-4 font-extrabold text-2xl text-basic_white_color hover:text-basic_primary_color/70 transition-all" >Les enjeux économiques du Pipeline de Sèmè-Kpodji</a>
        </div>
        <div  className="relative bg-[url('../../../public/images/actu2.jpg')] bg-ga bg-purple-400 bg-cover bg-center mx-4 p-4 rounded h-56"  >
            <span className="top-4 left-4 absolute bg-basic_primary_color px-2 rounded-full text-basic_white_color text-sm uppercase" >7 mai 2024</span>
            <a href="#" className="bottom-1 left-1 absolute bg-black/45 mt-4 font-extrabold text-2xl text-basic_white_color hover:text-basic_primary_color/70 transition-all" >Marine nationale : Le Capitaine de Vaisseau Dossa HOUNKPATIN nouveau chef</a>
        </div>
        <div  className="relative bg-[url('../../../public/images/actu3.jpg')] bg-cover bg-center mx-4 p-4 rounded h-56"  >
            <span className="top-4 left-4 absolute bg-basic_primary_color px-2 rounded-full text-basic_white_color text-sm uppercase" >5 mai 2024</span>
            <a href="#" className="bottom-1 left-1 absolute bg-black/45 mt-4 font-extrabold text-2xl text-basic_white_color hover:text-basic_primary_color/70 transition-all" >Sénégal : Bassirou Diomaye Faye élu sur la promesse de rupture a prêté serment</a>
        </div>
        <div  className="relative bg-[url('../../../public/images/actu4.jpg')] bg-cover bg-center mx-4 p-4 rounded h-56"  >
            <span className="top-4 left-4 absolute bg-basic_primary_color px-2 rounded-full text-basic_white_color text-sm uppercase" >27 mars 2024</span>
            <a href="#" className="bottom-1 left-1 absolute bg-black/45 mt-4 font-extrabold text-2xl text-basic_white_color hover:text-basic_primary_color/70 transition-all" >Bénin : Compte-Rendu Du Conseil Des Ministres du mercredi 27 mars 2024</a>
        </div>
        <div  className="relative bg-[url('../../../public/images/actu5.jpg')] bg-cover bg-center mx-4 p-4 rounded h-56"  >
            <span className="top-4 left-4 absolute bg-basic_primary_color px-2 rounded-full text-basic_white_color text-sm uppercase" >15 mai 2024</span>
            <a href="#" className="bottom-1 left-1 absolute bg-black/45 mt-4 font-extrabold text-2xl text-basic_white_color hover:text-basic_primary_color/70 transition-all" >Santé : Le Bénin introduit le vaccin contre le paludisme dans son programme de santé publique</a>
        </div>
        <div  className="relative bg-[url('../../../public/images/actu6.jpeg')] bg-cover bg-center mx-4 p-4 rounded h-56"  >
            <span className="top-4 left-4 absolute bg-basic_primary_color px-2 rounded-full text-basic_white_color text-sm uppercase" >5 mai 2024</span>
            <a href="#" className="bottom-1 left-1 absolute bg-black/45 mt-4 font-extrabold text-2xl text-basic_white_color hover:text-basic_primary_color/70 transition-all" >Economie : le Nigeria rétrograde à la 4ème place en Afrique </a>
        </div>
      </Carousel>)

}


/* import Autoplay from "embla-carousel-autoplay"
import useEmblaCarousel from 'embla-carousel-react'
import { useCallback, useEffect } from 'react'

export const ActuCarousel=()=> {

    const [emblaRef,emblaApi] = useEmblaCarousel({loop:true},[]) 

    useEffect(() => {
        if (emblaApi) {
          console.log(emblaApi.slideNodes()) // Access API
        }
      }, [emblaApi])


      const scrollPrev = useCallback(() => {
        if (emblaApi) emblaApi.scrollPrev()
      }, [emblaApi])
    
      const scrollNext = useCallback(() => {
        if (emblaApi) emblaApi.scrollNext()
      }, [emblaApi])

    return (
      <div className="overflow-hidden"  >

        <div className="embla__viewport" ref={emblaRef}>
            <div className="flex">
              <div className="flex-grow-0 flex-shrink-0 bg-green-400 lg:basis-1/2 min-w-full lg:min-w-0 h-40 basis-full">

              </div>
              <div className="flex-grow-0 flex-shrink-0 bg-blue-400 min-w-full lg:min-w-0 h-40 basis-full lg:basis-1/3">
            
              </div>
              <div className="flex-grow-0 flex-shrink-0 bg-yellow-300 min-w-full lg:min-w-0 h-40 basis-full lg:basis-1/3">
         
              </div>
            </div>
        </div>
        <button className="embla__prev" onClick={scrollPrev}>
            Prev
        </button>
        <button className="embla__next" onClick={scrollNext}>
            Next
        </button>
      </div>
    )
} */

/* import Autoplay from "embla-carousel-autoplay"


import {
  Carousel,
  CarouselContent,
  CarouselItem,
  CarouselNext,
  CarouselPrevious,
} from "@/components/ui/carousel"
import { useRef } from "react"

export function ActuCarousel() {
  const plugin = useRef(
    Autoplay({ delay: 3000 })
  )

  return (
    <Carousel
      plugins={[plugin.current]}
      className="w-full max-w-xs"
      onMouseLeave={plugin.current.reset}
    >
      <CarouselContent>
      <CarouselPrevious className="bg-blue-500" />
        {Array.from({ length: 5 }).map((_, index) => (
          <CarouselItem key={index} className="md:basis-1/2 lg:basis-1/3" >
            <div className="">
              <h1>okok {index} </h1>
            </div>
          </CarouselItem>
        ))}
      </CarouselContent>
      <CarouselPrevious className="bg-blue-500" />
      <CarouselNext className="bg-green-400" />
    </Carousel>
  )
}
 */