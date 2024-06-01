<?php

namespace App\Livewire\Asignar;
use App\Models\Area;

use Livewire\Component;

class Index extends Component
{


    public $areas;

    public function mount()
    {
        $this->getArea();
    }

    public function getArea()
    {
        $this->areas = Area::with('ips')->get();
    }

    public function render()
    {
        return view('livewire.asignar.index', ['areas' => $this->areas]);
    }

}
