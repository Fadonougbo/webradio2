<?php

namespace App\Models\webradio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogfile extends Model
{
    use HasFactory;

    public $fillable=['path'];

    public function article() {
        return $this->belongsTo(Article::class);
    }
}
