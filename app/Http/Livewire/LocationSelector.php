<?php

namespace App\Http\Livewire;

use Filament\Forms;
use Livewire\Component;
use App\Models\Location;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class LocationSelector extends Component implements HasForms
{
    use InteractsWithForms;

    public $location = '';

    public function render(): View
    {
        return view('livewire.location-selector');
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function getFormSchema(): array
    {
        return [
            Forms\Components\MultiSelect::make('location')
                ->options(Location::all()->pluck('location', 'id'))
                ->required(),
        ];
    }

    public function submit()
    {
        dd($this->location);
    }
}
