<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Filament\Forms\Components\FileUpload;
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
 
    public $categories_id = '';
    public $barcode = '';
    public $name = '';
    public $description = '';
    public $quantity = '';
    public $price = '';
    public $thumbnail = '';

    protected function getFormSchema(): array
    {
        return [
            Select::make('categories_id')
                ->label('Category')
                ->options(Category::all()->pluck('name', 'id'))
                ->searchable()
                ->disablePlaceholderSelection(),
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
                ->default('placeholder-thumbnail-document.png')
        ];
    }

    public function create(): void
    {
        // $gtin = $this->form->getState();

        // $response = Http::withHeaders([
        //     'Content-Type' => 'application/json',
        //     'X-Cosmos-Token' => 'nn04ILB1iNoBuVbNExQcpw',
        // ])->get("https://api.cosmos.bluesoft.com.br/gtins/$gtin.json");
        
        
        // $this->barcode = $gtin;
        // $this->name = $response['description'];
        // $this->quantity = 0;
        // $this->thumbnail = $response['thumbnail'];
        
        // Product::create([
        //     'name' => $this->name,
        //     'barcode' => $this->barcode,
        //     'quantity' => $this->quantity,
        //     'price' => $response['max_price'],
        //     'description' => $response['ncm']['full_description'],
        //     'thumbnail' => $this->thumbnail,
            
        // ]);
        
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
