<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public Product $product;
    
    public function render()
    {
        if (str_starts_with($this->product->thumbnail,'thumbnail') ) {

            $thumbnail = "storage/{$this->product->thumbnail}";

        } else if ($this->product->thumbnail === NULL) {
            $thumbnail = false;
        } else {
            $thumbnail = $this->product->thumbnail;
        }

        return view('livewire.product-details', [
            'name' => $this->product->name,
            'category' => $this->product->category,
            'description' => $this->product->description,
            'thumbnail' => $thumbnail,
            'barcode' => $this->product->barcode,
            'quantity' => $this->product->quantity,
            'price' => $this->product->price,
            'barcode_image' => $this->product->barcode_image,
        ]);
    }
}
