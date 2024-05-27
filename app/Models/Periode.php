<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    public $fillable=['periode_date','periode_hour','publicite_id'];

    public function publicite() {
        return $this->belongsTo(Publicite::class);
    }
}
