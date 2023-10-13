<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model implements TranslatableContract
{
    use HasFactory;

    use Translatable; // To add translation methods
    
    protected $fillable = ['price','description','status','name'];
    
    // To define which attributes needs to be translated
    public $translatedAttributes = ['name'];

    public function service_group(){
        return $this->hasMany(Group::class,'service_group');
    }
}
