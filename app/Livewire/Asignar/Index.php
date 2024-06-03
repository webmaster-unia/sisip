<?php

namespace App\Livewire\Asignar;
use App\Models\Area;

use Livewire\Component;

class Index extends Component
{
    public $areas;
    public $selectedArea = null;

    public function mount()
    {
        $this->getArea();
    }

    public function getArea()
    {
        $this->areas = Area::all();
    }

    public function selectArea($areaId)
    {
        $this->selectedArea = Area::with('ips')->find($areaId);
    }






    public function limpiar_modal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.asignar.index');
    }

}
