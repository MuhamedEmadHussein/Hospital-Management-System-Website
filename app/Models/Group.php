<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable; // To add translation methods
    
    protected $fillable = ['Total_before_discount','discount_value','Total_after_discount','tax_rate','Total_with_tax','name','notes'];
    
    // To define which attributes needs to be translated
    public $translatedAttributes = ['name','notes'];

    public function service_group(){
        return $this->belongsToMany(Service::class,'service_group')->withPivot('quantity');
    }
}
