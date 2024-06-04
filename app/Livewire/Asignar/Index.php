<?php

namespace App\Livewire\Asignar;
use App\Models\Area;

use Livewire\Component;


class Index extends Component
{

    public $areas;
    public $selectedIps = [];

    public function mount()
    {
        $this->getArea();
    }

    public function getArea()
    {
        $this->areas = Area::with('ips')->get();
    }

    public function loadIps($areaId)
    {
        $this->selectedIps = Area::find($areaId)->ips;
    }



    public function render()
    {
        return view('livewire.asignar.index', ['areas' => $this->areas]);
    }

}
