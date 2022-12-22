<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class CreateProduct extends Component implements HasForms
{
    use InteractsWithForms;

    public $barcode = '';
    public $name = '';
    public $description = '';
    public $quantity = '';
    public $price = '';
    public $thumbnail = '';

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('barcode')
                ->length(13)
                ->autofocus()
                ->unique(table: Product::class)
                ->required(),
            TextInput::make('name')
                ->unique(table: Product::class)
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
                ->removeUploadedFileButtonPosition('right')
        ];
    }

    public function create(): void
    {
        Product::create($this->form->getState());

    }

    public function submit(): void
    {
        $this->create();

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }

    public function render()
    {
        return view('livewire.create-product');
    }
}
