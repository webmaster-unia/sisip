<?php

namespace App\Livewire\Cargo;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title ('Cargo - IP OTI')]
#[Layout ('components.layouts.app')]

class Index extends Component
{
    public $button_Cargo='Crear Cargo';

    public $modo = 'create';

    public $name_cargo;

    public $area_ip_id;

    public $apellido_paterno;

    public $apellido_materno;

    public $nombre;

    public $dni;

    public $correo_institucional;

    public $nombre_equipo;

    public $usuario_red;

    public $procesador;

    public $memoria;

    public $sistema_opreativo;

    public $mac_dispositivo;

    public $is_active;

    public function create(){
        $this->limpiar_moda();
        $this->modo ='create';
        $this->button_Cargo='crear cargo';
        $this->resetErrorBag();
        $this->resetValidation();
    }
    public function limpiar_moda(){
        $this->reset([
            'name_cargo',
            'area_ip_id',
            'apellido_paterno',
            'apellido_materno',
            'nombre',
            'dni',
            'correo_institucional',
            'nombre_equipo',
            'usuario_red',
            'procesador',
            'memoria',
            'sistema_opreativo',
            'mac_dispositivo',
            'is_active'

        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }
    public function render()
    {
        return view('livewire.cargo.index');
    }
}
