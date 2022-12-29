<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class CategoryDetails extends Component implements HasTable
{
    use InteractsWithTable;

    public Category $category;

    protected function getTableQuery(): Builder
    {
        
        return Product::whereBelongsTo($this->category);
    }

    protected function getTableColumns(): array
    {
        
        return [
            TextColumn::make('name')
        ];
    }
    
    public function render()
    {
        
        return view('livewire.category-details');
    }
}
