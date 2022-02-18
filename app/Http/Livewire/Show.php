<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Show extends Component
{
    public $name,$value;
    public function change()
    {
        $this->name=$this->value;
    }
    public function render()
    {
      
        return view('livewire.show');
    }
}
