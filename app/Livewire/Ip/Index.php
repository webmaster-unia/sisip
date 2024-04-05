<?php

namespace App\Livewire\Ip;

use App\Models\Ip;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    #[Url('Mostrar')]
    public $mostrar_paginate = '10';

    #[Url('Buscar')]
    public $search='';


    //variables del modal
    public $button_modal = 'crear ip';
    public $title_modal='Crear Nuevo IP';
    public $modo = 'create';

    public $ip;
    public $is_active;




    //crear modal
    public function create()
    {
        $this->limpiar_modal();
        $this->modo = 'create';
        $this->button_modal = 'crear ip';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    //limpiar modal

    public function limpiar_modal()
    {
        $this->reset([
            'ip',
            'is_active'
        ]);

        $this->resetErrorBag();
        $this->resetValidation();
    }

    //editar modal

    public function edit($id){
        $id= Ip::findOrFail($id);
        $this->ip=$id;
        $this->modo = 'edit';
        $this->title_modal = 'Editar IP';
        $this->button_modal = 'Actualizar Ip';

    }

    //actualizar el editar

    public function actualizar_ip(){
        if($this->modo == 'create'){
            $ip = new Ip();
        }elseif($this->modo == 'edit'){
            $ip =Ip::findOrFail($this->ip);
        }
        $ip->save();
        $this->limpiar_modal();
    }
    //guardar registros

    public function guardar_ciclo()
    {
        $ip = new Ip();
        $ip->ip = $this->ip;
        $ip->is_active = $this->is_active;
        $ip->save();
        $this->limpiar_modal();
    }

    //eliminar registros
    public function eliminar_area($id)
    {

        Ip::findOrFail($id)->delete();
        return $this->render();
    }
    public function render()
    {
        $ips = Ip::search($this->search)
        ->orderBy('ip','desc')
        ->paginate($this->mostrar_paginate);
        return view('livewire.ip.index',[
            'ips'=>$ips,
        ]);
    }
}
