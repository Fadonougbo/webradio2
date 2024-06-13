@php 

 $type=request()->route()->parameter('type');
 $id=(int)request()->route()->parameter('id');

 $modelExist=false;
 if(!empty($type) && $type==='communique') {
    $modelExist=App\Models\webradio\Communique::find($id)->exists();
 }

 $element_id=null;
 $element_email=null;
 $element_tel=null;
 $element_amount=null;
 $last_name=Auth::user()->last_name;
 $first_name=Auth::user()->first_name;
 
 if($modelExist && $type==='communique' ) {

    $communique=App\Models\webradio\Communique::find($id);

    $element_id=$communique->id;

    $element_email=$communique->communique_email;

    $element_tel=$communique->communique_tel;
                
    $programesCount=$communique->programmes->count();
    
    $price=App\Models\Service::where('name','=','communique')->get()->first()->price;

    $element_amount=$price*$programesCount;
    
 }

@endphp

@if ($isHtmxRequest)

        @if ($modelExist)
            <div id="htmx_target" >
                <form action="{{route('service.payment.validation')}}" method="POST" >
                    @csrf
                    @method('patch')
                    <input type="hidden" name="id" value="{{$element_id}}">
                    <input type="hidden" name="type" value="{{$type}}">
                </form>
                
                <payment-module 
                    id="{{$element_id}}" 
                    demande_type="{{$type}}" 
                    on_error_url="{{route('dashboard')}}" 
                    amount="{{$element_amount}}" 
                    tel="{{$element_tel}}" 
                    email="{{$element_email}}"
                    last_name="{{$last_name}}"
                    first_name="{{$first_name}}"  
                >
                </payment-module>
            </div>
            
        
        @endif
        

@else
    <span></span>
@endif
