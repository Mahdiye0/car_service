<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'transactionId	',
        'user_id',
        'subscription_type	',
        'created_at' ,
        'updated_at',
    ];
    public function user()
    {
          // کلید خارجی ها
          return $this->belongsTo('App\\Models\\User');
    }
}
