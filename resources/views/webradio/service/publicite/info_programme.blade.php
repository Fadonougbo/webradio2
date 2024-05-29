<div class="my-6 w-full flex flex-col items-center" >

                <h2 class="text-2xl uppercase text-center my-4 font-semibold p-2 rounded bg-green-900 text-basic_white_color w-full  md:w-3/4 lg:w-1/2" >Programme de diffusion</h2>

                <section class="flex flex-col w-full items-center" >

                    @php

                        $dateError=json_encode($errors->get('programme.*.date'));

                        $periodeError=json_encode($errors->get('programme.*.periode'));

                        $oldData=json_encode(old());

                        $periodesCount=$publicite->periodes->count();

                        $data=$periodesCount>=1?json_encode($publicite->periodes()->get(['periode_date','id','periode_hour'])):json_encode([]);
                        
                    @endphp
                    
                    <programme-date class="w-full flex flex-col items-center" periode_error="{{$periodeError}}" date_error="{{$dateError}}" old="{{$oldData}}" data="{{$data}}" ></programme-date>
                  
                    

                </section>
            </div>