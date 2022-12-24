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
        'thumbnail',
        'categories_id'
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'categories_id');
    }
}
