<?php

namespace App\Models\webradio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicefile extends Model
{
    use HasFactory;

    public $fillable=['path'];
    public function communique() {
        return $this->belongsTo(Communique::class);
    }
}
