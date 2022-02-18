<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function order()
    {

        return $this->hasMany('App\\Models\\Order');
    }
    // public function UserOrder() {
    //     return $this->belongsTo('App\\Models\\User')->where('mobile','=', '0913290811');
    // }
    public function User()
    {
        // کلید خارجی ها
        return $this->belongsTo('App\\Models\\User');
        // ->where('expire_date','>=', Carbon::now());
    }
    public function City()
    {
        return $this->belongsTo('App\\Models\\City');
    }
    public function TypeService()
    {
        return $this->belongsTo('App\\Models\\TypeService');
    }
    public function Province()
    {
        return $this->belongsTo('App\\Models\\Province');
    }
    use HasFactory;
    protected $fillable = [
        'adderss',
        'status',
        'provide_services',
        'user_id',
        'city_id',
        'type_service_id',
        'image',


    ];


}
