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
               // biome-ignore lint/suspicious/noArrayIndexKey: <explanation>
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

          <div className='relative bg-green-600 mx-2 rounded h-56 cursor-pointer' title="publicite"  >
          <img src="http://localhost:8000/images/hegj.jpg" className="object-fill size-full" alt='publicite' />
            <span className="top-4 left-4 absolute bg-basic_primary_color px-1 rounded-full text-basic_white_color text-sm uppercase" >publicite</span>
         </div>
         {[...carouselDiv]}
        
    </Carousel>)

}

