<?php

namespace App\Livewire\Cargo;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\AreaIp;
use App\Models\Cargo;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Ip;
use Illuminate\Support\Collection;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
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

    //variables modal(para crear y editar)
    public $title_modal='Crear nuevo cargo';
    public $button_modal='Crear cargo';

    public $cargo_id;

    //variables para el el formulario cargo

    #[Validate('required|max:255')]
    public $name_cargo;

    #[Validate('required|exists:areas,id')]
    public $area;

    #[Validate('required|exists:ips,id')]
    public $ip;
    public $ips = [];

    #[Validate('nullable|max:255')]
    public $apellido_paterno;

    #[Validate('nullable|max:255')]
    public $apellido_materno;

    #[Validate('nullable|max:255')]
    public $nombre;

    #[Validate('nullable|max:255|digits:8')]
    public $dni;

    #[Validate('nullable|max:255|email')]
    public $correo_electronico;

    #[Validate('nullable|max:255')]
    public $nombre_equipo;

    #[Validate('nullable|max:255')]
    public $usuario_red;

    #[Validate('nullable|max:255')]
    public $procesador;

    #[Validate('nullable|max:255')]
    public $memoria;

    #[Validate('nullable|max:255')]
    public $sistema_operativo;

    #[Validate('nullable|max:255')]
    public $mac_dispositivo;

    //variables de los botones
    public $modo = 'create';

    public function mount()
    {
        $this->ips = collect();
    }

    //crear Cargo
    public function create()
    {
        $this->limpiar_modal();
        $this->modo = 'create';
        $this->title_modal = 'Crear nuevo cargo';
        $this->button_modal = 'Crear cargo';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function limpiar_modal()
    {
        $this->reset([
            'name_cargo',
            'area',
            'ip',
            'apellido_paterno',
            'apellido_materno',
            'nombre',
            'dni',
            'correo_electronico',
            'nombre_equipo',
            'usuario_red',
            'procesador',
            'memoria',
            'sistema_operativo',
            'mac_dispositivo',
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }


    public function updatedArea($value)
    {
        if (!empty($value)) {
            $this->ips = AreaIp::where('area_id', $value)->get();
        } else {
            $this->ips = collect();
        }
    }

    //guardar cargo
    public function guardar_cargo()
    {
        // la validacion de los campos
        $this->validate([
            'name_cargo' => 'required|max:255',
            'area' => 'required|exists:areas,id',
            'ip' => 'required|exists:ips,id',
            'apellido_paterno' => 'nullable|max:255',
            'apellido_materno' => 'nullable|max:255',
            'nombre' => 'nullable|max:255',
            'dni' => 'nullable|max:255|digits:8',
            'correo_electronico' => 'nullable|max:255|email',
            'nombre_equipo' => 'nullable|max:255',
            'usuario_red' => 'nullable|max:255',
            'procesador' => 'nullable|max:255',
            'memoria' => 'nullable|max:255',
            'sistema_operativo' => 'nullable|max:255',
            'mac_dispositivo' => 'nullable|max:255',
        ]);

        // el registro o actualizacion de los datos
        if ($this->modo == 'create') {
            $cargo = new Cargo();
        } else {
            $cargo = Cargo::find($this->cargo_id);
        }
        $cargo->name_cargo = $this->name_cargo;
        $cargo->area_ip_id = $this->ip;
        $cargo->apellido_paterno = mb_strtoupper($this->apellido_paterno, 'UTF-8');
        $cargo->apellido_materno = mb_strtoupper($this->apellido_materno, 'UTF-8');
        $cargo->nombre = mb_strtoupper($this->nombre, 'UTF-8');
        $cargo->dni = $this->dni;
        $cargo->correo_institucional = strtolower($this->correo_electronico);
        $cargo->nombre_equipo = mb_strtoupper($this->nombre_equipo, 'UTF-8');
        $cargo->usuario_red = mb_strtoupper($this->usuario_red, 'UTF-8');
        $cargo->procesador = mb_strtoupper($this->procesador, 'UTF-8');
        $cargo->memoria = mb_strtoupper($this->memoria, 'UTF-8');
        $cargo->sistema_opreativo = mb_strtoupper($this->sistema_operativo, 'UTF-8');
        $cargo->mac_dispositivo = $this->mac_dispositivo;
        $cargo->save();

        // limpiar el formulario
        $this->limpiar_modal();

        // mensaje de exito
        $this->dispatch('toast-basico',
            text: 'El cargo se guardo correctamente',
            tipo: 'success'
        );

        // cerrar el modal
        $this->dispatch(
            'modal',
            modal: '#modal-cargo',
            action: 'hide'
        );
    }

    public function render()
    {
        // obtener los cargos
        $cargos = Cargo::search($this->search)
            ->orderBy('id', 'asc')
            ->paginate($this->mostrar_paginate);

        // obtener las areas
        $areas = Area::where('is_active', 1)->get();

        return view('livewire.cargo.index',[
            'cargos'=>$cargos,
            'areas'=>$areas
        ]);
    }
}
