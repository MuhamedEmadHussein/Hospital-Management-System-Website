<?php

namespace App\Models;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Laboratory extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
    public function employee()
    {
        return $this->belongsTo(LaboratoryEmployee::class,'employee_id');
    }

    public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
