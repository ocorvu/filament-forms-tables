<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class CreateCategory extends Component implements HasForms
{
    use InteractsWithForms;

    public $name = '';
    public function getFormSchema()
    {
        return [
            TextInput::make('name')
        ];
    }

    public function submit()
    {
        Category::create($this->form->getState());

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }
    
    public function render()
    {
        return view('livewire.create-category');
    }
}
