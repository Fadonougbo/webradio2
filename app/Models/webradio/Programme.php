<?php

namespace App\Models\webradio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;

    public  $fillable=['programme_hour','programme_date'];

    public function communique() {
        return $this->belongsTo(Communique::class);
    }
}
