<?php

namespace App\Livewire\Ip;

use App\Models\Ip;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
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

    #[Validate( 'required|string|max:255')]
    public $ip;
    #[Validate('nullable|string|max:80')]
    public $is_active;

    public $ip_id;
    //variable para el formulario

    

    //crear rol
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

    //guardar crear

    public function guardar_ciclo()
    {
        if(empty($this->ip)){
            session()->flash('ERROR!!!','Porfavor, complete todos lo campos');
            return;
        }
        $ip = new Ip();
        $ip->ip = $this->ip;
        $ip->save();
        $this->limpiar_modal();
        return redirect()->route('ip.index');
    }
    //editar prueba almacenar

    public function edit($id){
        $IP= Ip::findOrFail($id);
        $this->ip_id=$id;
        $this->ip= $IP->ip;
        $this->modo = 'edit';
        $this->title_modal = 'Editar IP';
        $this->button_modal = 'Actualizar Ip';

        $this->resetErrorBag();
        $this->resetValidation();

    }
    // cambir el estado

    public function cambiar_estado($id,$value)
    {
        $is_active = Ip::find($id);
        if ($is_active) {
            if ($value == true) {
                $is_active->is_active = false;
            }else {
                $is_active->is_active = true;
            }
            $is_active ->save();
        }
    }

    //actualizar el editar

    public function actualizar_ip(){
        if($this->modo == 'create'){
            $IP = new Ip();
        }elseif($this->modo == 'edit'){
            $IP =Ip::findOrFail($this->ip_id);
        }
        $IP->ip=$this->ip;
        $IP->save();
        $this->limpiar_modal();
        return redirect()->route('ip.index');
    }


    //eliminar registros
    public function eliminar_ip($id)
    {

        $ip = Ip::find($id);
        if ($ip) {
            $ip->delete();
        }
    }
    public function render()
    {
        $ips = Ip::search($this->search)
        ->orderBy('id','asc')
        ->paginate($this->mostrar_paginate);
        return view('livewire.ip.index',[
            'ips'=>$ips,
        ]);
    }
}
