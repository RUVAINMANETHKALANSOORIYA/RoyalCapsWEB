<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'city',
        'postal_code',
        'delivery_address',
        'delivery_instructions',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }   

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
