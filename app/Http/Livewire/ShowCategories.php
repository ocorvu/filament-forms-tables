<?php

namespace App\Http\Livewire;

use App\Models\Category;
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
            TextColumn::make('name')
        ];
    }

    public function render()
    {
        return view('livewire.show-categories');
    }
}
