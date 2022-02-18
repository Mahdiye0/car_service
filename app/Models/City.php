<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    public function County()
    {
        return $this->belongsTo('App\Models\County');
    }
    public function Province()
    {
        return $this->belongsTo('App\\Models\\Province');
    }
    public function services()
    {

        return $this->hasMany('App\\Models\\Service');
    }

}
