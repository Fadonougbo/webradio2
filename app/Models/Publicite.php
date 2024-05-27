<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicite extends Model
{
    use HasFactory;

    public $fillable=['pub_email','pub_tel','pub_detail','pub_file','isPaid'];

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function periodes() {
        return $this->hasMany(Periode::class);
    }

}
