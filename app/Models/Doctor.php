<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Doctor extends Authenticatable implements TranslatableContract
{
    use HasFactory;

    use Translatable; // To add translation methods
    
    protected $fillable = ['email','email_verified_at','password','phone','name','category_id','status'];
    
    // To define which attributes needs to be translated
    public $translatedAttributes = ['name'];

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function doctors_appointments_pivot(){
        return $this->belongsToMany(Appointment::class, 'doctors_appointments_pivot');
    }
}
