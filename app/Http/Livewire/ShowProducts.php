<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class ShowProducts extends Component implements HasForms
{
    use InteractsWithForms;

    public $search;

    protected $queryString = ['search'];

    protected function getFormSchema(): array
    {
        return [
            Select::make('products')->label('Products')->options(Product::where('name', 'like', '%'.$this->search.'%')->pluck('name'))->searchable()
        ];
    }
    public function render()
    {
        return view('livewire.show-products', [
            'products' => Product::where('name', 'like', '%'.$this->search.'%')->get(),
        ]);
    }
}
