<?php

namespace Database\Factories;

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
            'barcode' => random_int(0000000000000, 9999999999999),
            'name' => fake()->name(),
            'quantity' => random_int(0, 1000),
            'price' => rand(0, 1000),
            'description' => 'Cras posuere suscipit justo in laoreet. Donec consectetur velit a turpis gravida iaculis. Cras fringilla, turpis a pretium luctus, urna risus imperdiet tellus, ac tempor purus lacus sed arcu.',
            'thumbnail' => 'thumbnails/placeholder-thumbnail-document.png',
        ];
    }
}
