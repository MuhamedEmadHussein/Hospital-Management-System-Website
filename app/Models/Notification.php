<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function scopeCountUnReadNotification($query,$username){
        $query->where('username', $username)->where('reader_status', 0);
    }
}
