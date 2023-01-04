<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Filament\Tables\Actions\Action;
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
    protected function getTableActions(): array
    {
        return [ 
            Action::make('details')
                ->url(fn (Product $record): string => route('products.details', $record))
                ->icon('heroicon-s-eye')
                ->color('success')
                ->label(false),
            Action::make('edit')
                ->url(fn (Product $record): string => route('products.edit', $record))
                ->icon('heroicon-s-pencil')
                ->color('warning')
                ->label(false),
            Action::make('delete')
                ->label(false)
                ->icon('heroicon-s-trash')
                ->color('danger')
                ->action(function (Product $record): void {
                    $record->delete();
                })
                ->requiresConfirmation(),
        ]; 
    }
    
    public function render()
    {
        
        return view('livewire.category-details');
    }
}
