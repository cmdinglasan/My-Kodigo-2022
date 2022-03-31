<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Position;

class PositionForm extends Component
{
    public $name;

    protected $rules = [
        'name' => ['required', 'min:3', 'unique:positions'],
    ];
    
    protected $messages = [
        'name.unique' => 'The position name already exists',
    ];
    

    public function store()
    {
        $this->validate();

        try {
            Position::create([
                'name' => $this->name,
            ]);

            $this->dispatchBrowserEvent('alert',[
                'type' => 'success',
                'message'=> 'Position successfully added'
            ]);

            $this->emit('positionAdded');
    
            $this->resetFields();
        } catch (\Exception $e) {
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
        return view('livewire.position-form');
    }
}
