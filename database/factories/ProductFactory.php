<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id' => Category::first()->id, 
            'barcode' => random_int(100000000000, 9999999999999),
            'name' => Str::random(10),
            'quantity' => random_int(0, 1000),
            'price' => rand(0, 1000),
            'description' => 'Cras posuere suscipit justo in laoreet. Donec consectetur velit a turpis gravida iaculis. Cras fringilla, turpis a pretium luctus, urna risus imperdiet tellus, ac tempor purus lacus sed arcu.',
            'thumbnail' => 'thumbnails/placeholder-thumbnail-document.png',
        ];
    }
}
