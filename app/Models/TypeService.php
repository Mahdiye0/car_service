<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeService extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description','tags'];
    protected $dates = [ 'deleted_at'];
    public function services()
    {

        return $this->hasMany('App\\Models\\Service');
    }
}
