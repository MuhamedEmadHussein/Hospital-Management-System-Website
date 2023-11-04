<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Doctor;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    protected $fillable = ['name','email','phone','doctor_id','category_id','notes','type','appointment'];
    // To define which attributes needs to be translated
    public $translatedAttributes = ['name'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
}
