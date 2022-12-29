<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CreateProduct extends Component implements HasForms
{
    use InteractsWithForms;
 
    public $category_id = '';
    public $barcode = '';
    public $name = '';
    public $description = '';
    public $quantity = '';
    public $price = '';
    public $thumbnail = '';
    public $barcode_image = '';

    protected function getProduct($gtin, $statusCode)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Cosmos-Token' => 'nn04ILB1iNoBuVbNExQcpw',
        ])->get("https://api.cosmos.bluesoft.com.br/gtins/$gtin.json");

        if ($response->status() === $statusCode) {
            return $response;

        } else false;
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('category_id')
                ->label('Category')
                ->options(Category::all()->pluck('name', 'id'))
                ->searchable()
                ->disablePlaceholderSelection(),
            TextInput::make('barcode')
                ->maxLength(13)
                ->minLength(12)
                ->autofocus()
                ->unique(table: Product::class)
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, $set) {                   
                    if($product = $this->getProduct($state, 200)) {
                        $set('name', $product['description']);
                        $set('price', $product['max_price']);
                        $set('description', isset($product['ncm']) ? $product['ncm']['full_description'] : '');
                        $set('thumbnail', isset($product['thumbnail']) ? $product['thumbnail'] : '');
                        $set('barcode_image', $product['barcode_image']);

                    } else {
                        Notification::make()
                            ->title('Product Not Found')
                            ->danger()
                            ->send();
                    }
                }),
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
            TextInput::make('thumbnail'),
            TextInput::make('barcode_image'),

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
