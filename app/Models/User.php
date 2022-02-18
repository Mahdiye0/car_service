<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

public function getFullNameAttribute()
{
    return "{$this->first_name} {$this->last_name}";
}
public function orders()
{
    return $this->hasMany('App\\Models\\Order');
}
public function services()
{

    return $this->hasMany('App\\Models\\Service');
}
public function roles()
{
    return $this->belongsToMany('App\\Models\\Role');
}
public function payments()
{
    return $this->belongsToMany('App\\Models\\Payment');


}
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'password',
        'mobile',
        'verification',
        'user_name',
        'type',
        'image',



    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'expire_date'
    ];
}
