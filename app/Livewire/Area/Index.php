<?php

namespace App\Livewire\Area;

use App\Models\Area;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
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
    public $name;
    public $slug;
    public $abreviation;
    public $cantidad;
    public $ip_inicio;
    public $ip_fin;
    public $is_active;


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
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'abreviation' => 'nullable|string|max:255',
            'cantidad' => 'nullable|numeric',
            'ip_inicio' =>'nullable|string|max:100',
            'ip_fin' =>'nullable|string|max:100'
        ]);
        $area = new Area();
        $area->name = $this->name;
        $area->slug = $this->slug;
        $area->abreviation = $this->abreviation;
        $area->cantidad = $this->cantidad;
        $area->ip_inicio = $this->ip_inicio;
        $area->ip_fin = $this->ip_fin;
        $area->save();
        $this->limpiar_modal();
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
