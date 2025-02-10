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
        'product_image' , 
        'user_id',
    ];

    public function getProductImagesAttribute($value)
    {
        return json_decode($value, true); // Convert JSON to array
    }


    // Cast product_images to array
protected $casts = [
    'product_images' => 'array',
];

    // Relationship: A product belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
