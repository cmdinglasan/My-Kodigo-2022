<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Position;

class PositionTable extends Component
{
    protected $listeners = [
        'positionAdded' => 'render',
        'positionDeleted' => 'render',
    ];

    public function render()
    {
        return view('livewire.position-table', [
            'positions' => Position::paginate(10)
        ]);
    }
}
