<?php

namespace App\Livewire\Asignar;
use App\Models\Area;

use App\Models\Cargo;
use Livewire\Component;

class Index extends Component
{


    public $areas;

    public function mount()
    {
        $this->getArea();
        $this->getCargo();
    }

    public function getArea()
    {
        $this->areas = Area::pluck('name');
    }



    public $cargos;
    
    public function getCargo()
    {
        $this->cargos = Cargo::pluck('name_cargo');
    }



    public function render()
    {
        return view('livewire.asignar.index');
    }
};
