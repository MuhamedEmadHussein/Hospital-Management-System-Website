<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Doctor;
use App\Models\Group;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group_invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Group()
    {
        return $this->belongsTo(Group::class,'Group_id');
    }

    public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function Doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function Category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
