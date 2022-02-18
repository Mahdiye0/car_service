<?php

namespace App\Models;

use App\Models\County;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;
    public function counties()
    {
        return $this->hasMany('App\Models\County');
    }
    public function cities()
    {
        // return $this->hasMany(City::class);
        return $this->hasMany('App\\Models\\City');
    }
}
