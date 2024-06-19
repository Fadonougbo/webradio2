<?php

namespace App\Models\webradio;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communique extends Model
{
    use HasFactory;

    public $fillable=['communique_email','communique_tel','communique_tel','communique_details','price'];

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function programmes() {
        return $this->hasMany(Programme::class);
    }

    public function servicefiles() {
        return $this->hasMany(Servicefile::class);
    }
}
