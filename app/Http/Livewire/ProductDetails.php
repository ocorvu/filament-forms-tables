<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public Product $product;

    public function render()
    {
        return view('livewire.product-details', [
            'name' => $this->product->name,
            'category' => $this->product->category()->first(),
            'description' => $this->product->description,
            'thumbnail' => $this->product->thumbnail,
            'barcode' => $this->product->barcode,
            'quantity' => $this->product->quantity,
            'price' => $this->product->price,
        ]);
    }
}
