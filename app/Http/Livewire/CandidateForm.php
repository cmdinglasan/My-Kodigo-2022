<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Location;
use App\Models\Position;

class CandidateForm extends Component
{
    public $position, $entryNumber, $ballotName, $location, $partylistCode;

    protected $rules = [
        'position' => ['required'],
        'entryNumber' => ['required', 'min:3'],
        'ballotName' => ['required', 'min:3'],
        'location' => ['required'],
        'partylistCode' => ['required'],
    ];

    public function store ()
    {

    }

    public function render ()
    {
        $positions = Position::all()->pluck('name', 'id');
        $locations = Location::all()->pluck('location', 'slug');

        // dd($positions);

        return view('livewire.candidate-form', [
            'positions' => $positions,
            'locations' => $locations,
        ]);
    }
}
