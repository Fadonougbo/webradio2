<?php

namespace App\Models\webradio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    public $fillable=['name'];

    public function articles() {
        return $this->hasMany(Article::class);
    }
}
