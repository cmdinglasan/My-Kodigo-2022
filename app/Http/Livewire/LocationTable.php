<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Location;

class LocationTable extends Component
{
    protected $listeners = [
        'locationAdded' => 'render',
        'locationDeleted' => 'render',
    ];

    public function render()
    {
        return view('livewire.location-table', [
            'locations' => Location::paginate(10)
        ]);
    }
}
