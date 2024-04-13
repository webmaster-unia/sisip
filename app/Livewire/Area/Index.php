<?php

namespace App\Livewire\Area;

use App\Models\Area;
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
    public function guardar_ciclo()
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



    //eliminar
    public function eliminar_area($id)
    {

        Area::findOrFail($id)->delete();
        return $this->render();
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
