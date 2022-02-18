<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    use HasFactory;

    public function Province()
    {
        // هر شهرستان متعلق به یک استان است
        return $this->belongsTo('App\Models\Province');
    }
    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }
}
