<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable; // To add translation methods
    
    protected $fillable = ['email','password','Date_Birth','Phone','Gender','Blood_Group','name','Address'];
    
    // To define which attributes needs to be translated
    public $translatedAttributes = ['name','Address'];
}
