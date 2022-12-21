<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public Product $product;


    public function render()
    {
        return view('livewire.product-details', [
            'name' => $this->product->name,
            'description' => $this->product->description
        ]);
    }
}
