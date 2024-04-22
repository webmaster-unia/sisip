<?php

namespace App\Livewire\Area;

use App\Models\Area;
use App\Models\Ip;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

#[Title('Areas - IP OTI')]
#[Layout('components.layouts.app')]

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;


    #[Url('mostrar')]
    public $mostrar_paginate = '10';

    #[Url('buscar')]
    public $search = '';


    //Varibles Modal

    //para modal de asignar IP
    public $title_modal_ip = 'Asignar IP';
    public $button_modal_ip ='Asignar IP';

    //para modal de crear y editar
    public $title_modal = 'Crear nueva Area';
    public $button_modal = 'Crear area';

    public $modo = 'create';



    //variables para formulario
    #[Validate('required|string|max:255')]
    public $name;
    #[Validate('nullable|string|max:255')]
    public $slug;
    #[Validate('nullable|string|max:255')]
    public $abreviation;
    #[Validate('nullable|numeric')]
    public $cantidad;
    #[Validate('nullable|string|max:100')]
    public $ip_inicio;
    #[Validate('nullable|string|max:100')]


    //para almacenar las ip
    public $selectedIps = [];

    public $alm_ip;
    public $ips;
    public $mensaje='';
    public $ip_fin;
    public $is_active;

    public $area_id;


    //crear rol
    public function create(){
        $this->limpiar_modal();
        $this->modo = 'create';
        $this->title_modal = 'Crear nueva Area';
        $this->button_modal = 'Crear area';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function limpiar_modal(){
        $this->reset([
            'name',
            'slug',
            'abreviation',
            'cantidad',
            'ip_inicio',
            'ip_fin',
            'is_active'
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }
    //guardar crear
    public function guardar_area()
    {

        //para hacer que no ingrese campos vacios
        if (empty($this->name) || empty($this->cantidad) || empty($this->ip_inicio) || empty($this->ip_fin)) {
            session()->flash('error', 'Por favor, complete todos los campos.');
            return;
        }

        $area = new Area();
        $area->name = $this->name;
        $area->slug = $this->slug;
        $area->abreviation = $this->abreviation;
        $area->cantidad = $this->cantidad;
        $area->ip_inicio = $this->ip_inicio;
        $area->ip_fin = $this->ip_fin;
        $area->save();
        $this->mensaje='El area se ah creado correctamente';
        $this->limpiar_modal();
        return redirect()->route('area.index');
    }


    //editar prueba almacenar
    public function edit($id)
    {
        $area = Area::findOrFail($id);
        $this->area_id = $id;
        $this->name = $area->name;
        $this->slug = $area->slug;
        $this->abreviation = $area->abreviation;
        $this->cantidad = $area->cantidad;
        $this->ip_inicio = $area->ip_inicio;
        $this->ip_fin = $area->ip_fin;
        $this->modo = 'edit';
        $this->title_modal = 'Editar Area';
        $this->button_modal = 'Actualizar Area';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    //ahora actualizarlo
    public function actualizar_area()
    {
        if ($this->modo == 'create') {
            $area = new Area();
        } elseif ($this->modo == 'edit') {
            $area = Area::findOrFail($this->area_id);
        }

        $area->name = $this->name;
        $area->slug = $this->slug;
        $area->abreviation = $this->abreviation;
        $area->cantidad = $this->cantidad;
        $area->ip_inicio = $this->ip_inicio;
        $area->ip_fin = $this->ip_fin;
        $area->save();
        $this->limpiar_modal();
        return redirect()->route('area.index');
    }


    //agregar (boton) para asignar una ip
    //abrir um modal
    //lista de checkbox de ips disponibles
    //se guarde en la tabla area_ip



    //obtener las ip param ostar en mi modal
    public function mount()
    {
        $this->getAllIp();
    }

    public function getAllIp()
    {
        $this->ips = Ip::all();
    }




    public function asignar_ip()
    {

        if (empty($this->selectedIps)) {
            session()->flash('error', 'Por favor, selecciona al menos una IP.');
            return;
        }

        $area = Area::findOrFail($this->area_id);

        foreach ($this->selectedIps as $ipId => $isSelected) {
            if ($isSelected) {
                $ip = Ip::findOrFail($ipId);
                // Asigna el área a la IP
                $ip->area_id = $area->id;
                $ip->save();
            }
        }

        $this->limpiar_modal();
        session()->flash('success', 'Las IPs se han asignado correctamente al área.');
    }



    //eliminar
    public function eliminar_area($id)
    {

        $areas = Area::find($id);
        if($areas){
            $areas->delete();
        }
    }
    public function render()
    {
        $areas = Area::search($this->search)
        ->orderBy('created_at', 'desc')
        ->paginate($this->mostrar_paginate);
        return view('livewire.area.index',[
            'areas'=>$areas,
        ]);

    }

}
