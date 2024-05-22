<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicite extends Model
{
    use HasFactory;

    public $fillable=['pub_email','pub_tel','pub_detail','pub_file'];

}
