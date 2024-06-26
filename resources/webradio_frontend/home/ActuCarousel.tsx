import Carousel from "react-multi-carousel";
import "react-multi-carousel/lib/styles.css";
import { CarouselCard } from "./CarouselCard";

export type dataType={
  title:string,
  url:string,
  image:string,
  date:string
}

export const ActuCarousel=({data}:{data:string})=> {

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

      //Parse les data reçu du backend
      const carouselData=JSON.parse(data) as dataType[]

      const carouselDiv=carouselData.map((el,key)=> {
               return  <CarouselCard carddata={el} key={key} />

      }) 


     return ( <Carousel responsive={responsive} className="z-[2] button:bg-green-400 my-6"
      infinite={true}
      autoPlay={false}
      keyBoardControl={true}
      autoPlaySpeed={4500}
      showDots={true}
      pauseOnHover={true}
     
   >
         {[...carouselDiv]}
        
    </Carousel>)

}

/*  */

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