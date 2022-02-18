<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use AppTraitsPersianDate;

class Order extends Model
{
    // use PersianDate;
    use HasFactory,SoftDeletes;
    public function user()
    {
        return $this->belongsTo('App\\Models\\User');
    }
    public function services()
    {
        return $this->belongsTo('App\\Models\\Service', 'service_id', 'id');
    }
    protected $fillable = [
        'adderss',
        'status',
        'rate',
        'user_id',
        'service_id',
    ];
}
