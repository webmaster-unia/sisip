<?php

namespace App\Livewire\Cargo;

use App\Models\Cargo;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title ('Cargo - IP OTI')]
#[Layout ('components.layouts.app')]

class Index extends Component
{
    public $button_Cargo='Crear Cargo';

    public $title_modal='Editar Cargo';

    public $limpiar_moda='';

    public $modo='create';

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

     //guardar crear

     public function guardar_cargo()
     {
        $cargo = new Cargo();
        $cargo->name_cargo = $this->name_cargo;
        $cargo->area_ip_id = $this->area_ip_id;
        $cargo->apellido_paterno = $this->apellido_paterno;
        $cargo->apellido_materno = $this->apellido_materno;
        $cargo->nombre = $this->nombre;
        $cargo->dni = $this->dni;
        $cargo->correo_institucional = $this->correo_institucional;
        $cargo->nombre_equipo = $this->nombre_equipo;
        $cargo->usuario_red = $this->usuario_red;
        $cargo->procesador = $this->procesador;
        $cargo->memoria = $this->memoria;
        $cargo->sistema_opreativo = $this->sistema_opreativo;
        $cargo->mac_dispositivo = $this->mac_dispositivo;
        $cargo->is_active = $this->is_active;
        $cargo->save();
        $this->limpiar_modal();
     }

     //editar prueba almacenar
    public function edit($id)
    {
        $cargo = Cargo::findOrFail($id);
        $this->name_cargo = $id;
        $this->area_ip_id->name;
        $this->apellido_paterno = $cargo->apellido_paterno;
        $this->apellido_materno = $cargo->apellido_materno;
        $this->nombre = $cargo->nombre;
        $this->dni = $cargo->dni;
        $this->correo_institucional  = $cargo->correo_institucional ;
        $this->nombre_equipo  = $cargo->nombre_equipo ;
        $this->usuario_red   = $cargo->usuario_red;
        $this->procesador  = $cargo->procesador;
        $this->memoria  = $cargo->memoria;
        $this->sistema_opreativo  = $cargo->sistema_opreativo;
        $this->mac_dispositivo  = $cargo->mac_dispositivo;
        $this->is_active  = $cargo->is_active ;
        $this->modo = 'edit';
        $this->title_modal = 'Editar Cargo';
        $this->button_Cargo = 'Actualizar Cargo';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    //ahora actualizarlo
    public function actualizar_Cargo()
    {
        if ($this->modo == 'create') {
            $cargo = new Cargo();
        } elseif ($this->modo == 'edit') {
            $cargo = Cargo::findOrFail($this->name_cargo);
        }

        $cargo->name_cargo = $this->name_cargo;
        $cargo->area_ip_id = $this->area_ip_id;
        $cargo->apellido_paterno = $this->apellido_paterno;
        $cargo->apellido_materno = $this->apellido_materno;
        $cargo->nombre = $this->nombre;
        $cargo->dni = $this->dni;
        $cargo->correo_institucional  = $this->correo_institucional ;
        $cargo->nombre_equipo = $this->nombre_equipo;
        $cargo->usuario_red  = $this->usuario_red ;
        $cargo->procesador = $this->procesador;
        $cargo->memoria  = $this->memoria;
        $cargo->sistema_opreativo = $this->sistema_opreativo;
        $cargo->mac_dispositivo = $this->mac_dispositivo;
        $cargo->is_active = $this->is_active;
        $cargo->save();
        $this->limpiar_modal();
    }

    public function render()
    {
        return view('livewire.cargo.index');
    }
}
