<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvisDeRecherche extends Model
{
    use HasFactory;

    public $fillable=['adr_email','adr_tel','adr_detail','adr_file','isPaid','personne'];

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function periodes() {
        return $this->hasMany(Periode::class);
    }
}
