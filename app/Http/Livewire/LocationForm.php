<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LocationForm extends Component
{
    public $region, $province, $location;
    public $slug;

    protected $rules = [
        'region' => ['required', 'min:3'],
        'province' => ['required_unless:region,Overseas'],
        'location' => ['required_unless:region,Overseas'],
    ];

    public function store ()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            Location::create([
                'slug' => Str::slug(Str::lower($this->region) . '-' . Str::lower($this->province) . '-' . Str::lower($this->location)),
                'region' => $this->region,
                'province' => $this->province,
                'location' => $this->location,
            ]);

            DB::commit();

            $this->dispatchBrowserEvent('alert',[
                'type' => 'success',
                'message'=> 'Position successfully added'
            ]);

            $this->emit('locationAdded');
    
            $this->resetFields();
        } catch (\Exception $e) {
            DB::rollBack();

            $this->dispatchBrowserEvent('alert',[
                'type' => 'error',
                'message' => $e->getMessage()
            ]);
        }

    }

    public function resetFields() {
        $this->name = '';
    }

    public function render()
    {
        return view('livewire.location-form');
    }
}
