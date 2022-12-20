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

    public function mount(Product $product): void
    {
        $this->form->fill([
            'name' => $this->product->name,
            'description' => $this->product->description,
        ]);
    }
    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')->unique(table: Product::class),
            MarkdownEditor::make('description')->required(),
        ];
    }

    public function update(Product $product): void
    {
        $data = $this->form->getState();

        $product->name = $data['name'];
        $product->description = $data['description'];

        $product->save();
    }

    public function submit(): void
    {
        $this->update($this->product);
    }

    public function render()
    {
        return view('livewire.edit-product');
    }
}
