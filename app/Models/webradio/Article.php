<?php

namespace App\Models\webradio;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public $fillable=['article_title','article_slug','content','isOnline','article_principal_image'];

    public function categorie() {
        return $this->belongsTo(Categorie::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function blogfiles() {
        return $this->hasMany(Blogfile::class);
    }
}
