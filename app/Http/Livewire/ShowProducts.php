<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
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
                        fn (Builder $query): Builder => $query->whereBetween('quantity', [10, 50]),
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
            SelectFilter::make('category')->relationship('category', 'name'),
            Filter::make('created_at')->label('Criado')
                ->form([
                    DatePicker::make('created_at')])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_at'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '=', $date)
                        );
                }) 
                ->indicateUsing(function (array $data): ?string {
                    if (! $data['created_at']) {
                        return null;
                    }
            
                    return 'Created at ' . Carbon::parse($data['created_at'])->toFormattedDateString();
                })
        ];
    }

    protected function getTableFiltersFormColumns(): int
    {
        return 1;
    }
    protected function getTableFiltersFormWidth(): string
    {
        return 'xl';
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
            TextColumn::make('index')->rowIndex()->alignCenter()->color('primary'),
            TextColumn::make('name')->searchable(),
            TextColumn::make('category.name'),
            TextColumn::make('quantity')->alignCenter(),
            TextColumn::make('created_at')->dateTime('d/m/Y')->label('Criado em'),
            TextColumn::make('updated_at')->since(),
        ]; 
    }
    
    public function render()
    {
        return view('livewire.show-products');
    }
}
