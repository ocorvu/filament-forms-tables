<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $fillable = [
        'barcode',
        'name',
        'description',
        'quantity',
        'price',
        'thumbnail'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
