<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class EditCategory extends Component implements HasForms
{
    use InteractsWithForms;

    public Category $category;

    public $name;

    public function mount(): void
    {
        $this->form->fill([
            'name' => $this->category->name
        ]);
    }

    public function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->autofocus()
                ->required()
                ->unique(table: Category::class, ignorable: $this->category)
        ];
    }
    public function update(Category $category): void
    {   
        $data = $this->form->getState();
        
        $category->name = $data['name'];
        
        $category->save();
    }

    public function submit(): void
    {
        $this->update($this->category);

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }
    public function render()
    {
        return view('livewire.edit-category');
    }
}
