<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Livewire\Component;

class ShowCategories extends Component implements HasTable
{
    use InteractsWithTable;

    protected function getTableQuery(): Builder|Relation
    {
        return Category::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->label('id'),
            TextColumn::make('name'),
            TextColumn::make('products_count')
                ->label('Products')
                ->alignCenter()
                ->counts('products'),
        ];
    }
    protected function getTableActions(): array
    {
        return [ 
            Action::make('details')
                ->url(fn (Category $record): string => route('categories.details', $record))
                ->icon('heroicon-s-eye')
                ->color('success')
                ->label(false),
            Action::make('edit')
                ->url(fn (Category $record): string => route('categories.edit', $record))
                ->icon('heroicon-s-pencil')
                ->color('warning')
                ->label(false),
            Action::make('delete')
                ->label(false)
                ->icon('heroicon-s-trash')
                ->color('danger')
                ->action(function (Category $record): void {
                    $record->delete();
                })
                ->requiresConfirmation(),
        ]; 
    }

    public function render()
    {
        return view('livewire.show-categories');
    }
}
