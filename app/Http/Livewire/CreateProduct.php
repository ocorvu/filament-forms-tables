<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class CreateProduct extends Component implements HasForms
{
    use InteractsWithForms;

    public $name = '';
    public $description = '';

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->unique(table: Product::class)
                ->required(),
            MarkdownEditor::make('description'),
        ];
    }

    public function create(): void
    {
        Product::create($this->form->getState());

    }

    public function submit(): void
    {
        $this->create();
    }

    public function render()
    {
        return view('livewire.create-product');
    }
}
