<?php

namespace App\Models;

use App\Models\webradio\Communique;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * Donne le prix total en fonction du prix du communique
     *
     * @param string $type
     * @param integer $id
     * @return integer
     */
    public function getAmount(string $type,int $id):int {

        if($type==='communique') {

           
            $programmesCount=Communique::find($id)?->programmes?->count();

            $price=$this->where('name','=',$type)->get('price')->first()->price;
            return $price*$programmesCount;
        }

        return 0;
    }
}
