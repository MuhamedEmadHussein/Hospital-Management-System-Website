<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    protected $fillable = ['name'];
    
    // To define which attributes needs to be translated
    public $translatedAttributes = ['name'];
}
