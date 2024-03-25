<?php

namespace App\Livewire\Area;

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
    public $id_active;


    //crear rol
    public function create(){
        $this->limpiar_modal();
        $this->modo = 'create';
        $this->title_modal = 'Crear nueva Area';
        $this->button_modal = 'Crear area';
        $this->resetErrorBag();
        $this->resetValidation();
    }


    public function render()
    {
        return view('livewire.area.index');
    }
}
