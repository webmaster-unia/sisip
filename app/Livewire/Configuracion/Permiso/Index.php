<?php

namespace App\Livewire\Configuracion\Permiso;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Permisos - IP OTI')]
#[Layout('components.layouts.app')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.configuracion.permiso.index');
    }
}
