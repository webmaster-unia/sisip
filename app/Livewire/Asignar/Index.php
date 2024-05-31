<?php

namespace App\Livewire\Asignar;

use Livewire\Component;

class Index extends Component
{

    
        public function mount()
        {
            $this->getArea();
        }

        public function getArea()
        {
            $this->ips = Ip::all();
        }




    public function render()
    {
        return view('livewire.asignar.index');
    }
}
