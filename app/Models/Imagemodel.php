<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagemodel extends Model
{
    use HasFactory;
    
    protected $table = "image";

    protected $fillable = ['path'];
}
