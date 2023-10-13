<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TranslatableContract
{
    use HasFactory;

    use Translatable; // To add translation methods
    
    protected $fillable = ['name','description'];
    
    // To define which attributes needs to be translated
    public $translatedAttributes = ['name','description'];

    public function doctors(){
        return $this->hasMany(Doctor::class);
    }
}
