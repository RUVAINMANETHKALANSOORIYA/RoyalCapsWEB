<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customization extends Model
{
    use HasFactory;

    protected $table = 'custom'; // Ensure correct table name

    protected $fillable = [
        'name',
        'email',
        'address',
        'contact_number',
        'style',
        'logo',
        'color',
        'category',
        'notes',
        'status',
    ];
}
