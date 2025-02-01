<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // ✅ Import User model


class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // Define table name

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category',
        'color', 
        'product_image', 
        'user_id',
    ];

    // Relationship: A product belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
