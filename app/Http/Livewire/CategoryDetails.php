<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
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
    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('quantity')->form([
                Toggle::make('low'),
                Toggle::make('ok'),
                Toggle::make('full')
            ])->query(function (Builder $query, array $data): Builder {
                return $query
                    ->when(
                        $data['low'],
                        fn (Builder $query): Builder => $query->where('quantity', '<=', '10'),
                    )->when(
                        $data['ok'],
                        fn (Builder $query): Builder => $query->whereBetween('quantity', [10, 49]),
                    )->when(
                        $data['full'],
                        fn (Builder $query): Builder => $query->where('quantity', '>=', '50'),
                    );
            })->indicateUsing(function (array $data) {
                $indicators = [];
                if ($data['low']) {
                    $indicators['low'] = 'Quantity: Low';
                }
                if ($data['ok']) {
                    $indicators['ok'] = 'Quantity: Ok';
                }
                if ($data['full']) {
                    $indicators['full'] = 'Quantity: Full';
                }
                return $indicators;
            }),
        ];
    }

    protected function getTableColumns(): array
    {
        
        return [
            TextColumn::make('index')->rowIndex(),
            TextColumn::make('name')->searchable(),
            BadgeColumn::make('quantity')->colors([
                'primary',
                'danger' => static fn ($state): bool => $state <= 10 ,
                'success' => static fn ($state): bool => $state >= 50,
            ]),
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
    protected function getTableEmptyStateHeading(): ?string
    {
        return 'This category has no products yet';
    }
 
    protected function getTableEmptyStateDescription(): ?string
    {
        return 'You may create a product using the button below.';
    }
 
    protected function getTableEmptyStateActions(): array
    {
        return [
            Action::make('create')
                ->label('Create product')
                ->url(route('products.create'))
                ->icon('heroicon-o-plus')
                ->button(),
        ];
    } 
    
    public function render()
    {
        
        return view('livewire.category-details');
    }
}
