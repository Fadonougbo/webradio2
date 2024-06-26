import type { dataType } from "./ActuCarousel"


export const CarouselCard=({carddata}:{carddata:dataType})=> {

    return (<div className='relative mx-4 p-4 rounded h-56 cursor-pointer'  >

                <img src={carddata.image} className="object-cover size-full" alt={`image de l'article ${carddata.title}`} />

                <span className="top-4 left-4 absolute bg-basic_primary_color px-2 rounded-full text-basic_white_color text-sm uppercase" >{carddata.date}</span>
                
                <a href={carddata.url} className="bottom-1 left-1 absolute bg-black/70 mt-4 p-1 rounded-t-lg w-full min-h-14 font-extrabold text-basic_white_color text-lg hover:text-basic_primary_color/70 transition-all" >{carddata.title}</a>

            </div>)
}