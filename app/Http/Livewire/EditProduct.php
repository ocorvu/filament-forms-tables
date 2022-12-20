<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class EditProduct extends Component implements HasForms
{
    use InteractsWithForms;

    public Product $product;

    public $name;
    public $description;

    public function mount(): void
    {
        $this->form->fill([
            'name' => 'Cordeiro',
            'description' => 'Cortes mistos de cordeiro',
        ]);
    }
    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')->required(),
            MarkdownEditor::make('description')->required(),
        ];
    }

    public function submit(): void
    {
        //
    }

    public function render()
    {
        return view('livewire.edit-product');
    }
}
