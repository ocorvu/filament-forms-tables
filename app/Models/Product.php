<?php

namespace App\Models;

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
        'category_id',
        'barcode_image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
