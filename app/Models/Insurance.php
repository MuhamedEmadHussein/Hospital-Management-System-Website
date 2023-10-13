<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable; // To add translation methods
    protected $fillable = ['insurance_code','discount_percentage','status','Company_rate','name','notes'];
    
    // To define which attributes needs to be translated
    public $translatedAttributes = ['name','notes'];

}
