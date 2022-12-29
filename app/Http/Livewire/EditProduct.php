<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Textarea;
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
            'barcode' => $this->product->barcode,
            'name' => $this->product->name,
            'quantity' => $this->product->quantity,
            'price' => $this->product->price,
            'description' => $this->product->description,
            'category_id' => $this->product->category_id,
        ]);
    }
    protected function getFormSchema(): array
    {
        return [
            Select::make('category_id')
            ->label('Category')
            ->options(Category::all()->pluck('name', 'id'))
            ->searchable(),
            // ->disablePlaceholderSelection()
            TextInput::make('barcode')
                ->length(13)
                ->autofocus()
                ->unique(table: Product::class, ignorable: $this->product)
                ->required(),
            TextInput::make('name')
                ->required(),
            TextInput::make('quantity')
                ->numeric()
                ->minValue(0)
                ->placeholder('10')
                ->required(),
            TextInput::make('price')
                ->numeric()
                ->minValue(0)
                ->maxValue(999999,99)
                ->placeholder('0.0'),
            Textarea::make('description')->rows(3),
            FileUpload::make('thumbnail')
                ->image()
                ->disk('public')
                ->directory('thumbnails')
                ->panelAspectRatio('9:1')
                ->panelLayout('integrated')
                ->removeUploadedFileButtonPosition('right'),
            Placeholder::make('Current Thumbnail')
                ->content($this->product->thumbnail)
        ];
    }

    public function update(Product $product): void
    {   
        $data = $this->form->getState();
        
        $product->category_id = $data['category_id'];
        $product->barcode = $data['barcode'];
        $product->name = $data['name'];
        $product->quantity = $data['quantity'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        $product->thumbnail = empty($data['thumbnail']) ? $product->thumbnail : $data['thumbnail'];
        
        $product->save();
    }

    public function submit(): void
    {
        $this->update($this->product);

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }

    public function render()
    {
        return view('livewire.edit-product');
    }
}
