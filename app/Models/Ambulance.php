<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable; // To add translation methods
    
    protected $fillable = ['car_number','car_model','car_year_made','driver_license_number','driver_phone','is_available','car_type','driver_name','notes'];
    
    // To define which attributes needs to be translated
    public $translatedAttributes = ['driver_name','notes'];
}
