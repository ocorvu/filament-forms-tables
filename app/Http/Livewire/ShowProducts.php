<?php

namespace App\Http\Livewire;

use App\Models\Product;

use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\Action;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ShowProducts extends Component implements HasTable, HasForms
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Product::query();
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

    protected function getTableColumns(): array 
    {
        return [ 
            TextColumn::make('index')->rowIndex(),
            TextColumn::make('name')->color('primary'),
            TextColumn::make('description')->wrap()->words(10),
            TextColumn::make('created_at')->dateTime('d/m/Y h:m:s')->label('Criado em'),
            TextColumn::make('updated_at')->since(),
        ]; 
    }
    
    public function render()
    {
        return view('livewire.show-products');
    }
}
