<?php

namespace App\Livewire\Cargo;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use App\Area;
use App\DireccionIP;
use App\Models\Ip;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title ('Cargo - IP OTI')]
#[Layout ('components.layouts.app')]

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    #[Url('Mostrar')]
    public $mostrar_paginate = '10';

    #[Url('Buscar')]
    public $search='';

    public $title_modal='Editar Cargo';
    public $modo='create';

    #[Validate('nullable|string|max:50')]
    public $name_cargo;

    public $ips;

    public $area_ip_id;
    #[Validate('nullable|string|max:50')]
    public $apellido_paterno;
    #[Validate('nullable|string|max:50')]
    public $apellido_materno;
    #[Validate('nullable|string|max:50')]
    public $nombre;
    #[Validate('nullable|string|max:50')]
    public $dni;
    #[Validate('nullable|string|max:50')]
    public $correo_institucional;
    #[Validate('nullable|string|max:50')]
    public $nombre_equipo;
    #[Validate('nullable|string|max:50')]
    public $usuario_red;
    #[Validate('nullable|string|max:50')]
    public $procesador;
    #[Validate('nullable|string|max:50')]
    public $memoria;
    #[Validate('nullable|string|max:50')]
    public $sistema_opreativo;
    #[Validate('nullable|string|max:50')]
    public $mac_dispositivo;
    #[Validate('nullable|string|max:50')]
    public $is_active;

    public function create()
    {
        $this->limpiar_modal();
        $this->modo ='create';
        $this->button_Cargo='crear cargo';
        $this->resetErrorBag();
        $this->resetValidation();
    }
    public function limpiar_modal(){
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

    //seleccionar las Areas y las ips:



    //hacer una busqueda las ID de por medio de las id:


     //guardar crear
     public function guardar_cargo()
     {
        if(empty($this->name_cargo)){
            session()->flash('Error','Porfavor, complete todos los campos');
            return;
        }
        $cargo = new Cargo();
        $cargo->name_cargo = $this->name_cargo;
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
        $cargo->save();
        $this->limpiar_modal();
     }

     //editar prueba almacenar
    public function edit($id)
    {
        $cargo = Cargo::findOrFail($id);
        $this->name_cargo = $id;
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
        $cargo->save();
        $this->limpiar_modal();
    }

    public function mount()
    {
        $this->getAllIps();
    }

    public function getAllIps()
    {
        $this->ips = Ip::all();
    }
    public function render()
    {
        $Cargos = $this->search
        ? Cargo::where('name_cargo', 'like', '%' . $this-> search . '%')->paginate($this->mostrar_paginate)
        : Cargo::paginate($this->mostrar_paginate);

        return view('livewire.cargo.index',[
            'cargos'=>$Cargos,

        ]);
    }
}
