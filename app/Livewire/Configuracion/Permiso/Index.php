<?php

namespace App\Livewire\Configuracion\Permiso;

use App\Models\Permission;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Component;

#[Title('Permisos - IP OTI')]
#[Layout('components.layouts.app')]
class Index extends Component
{


    use WithPagination;
    use WithFileUploads;

    #[Url('buscar')]
    public $search = '';

    public $mostrar_paginate = 10;

        //Varibles Modal
    public $title_modal = 'Crear Permiso';
    public $button_modal = 'Crear Permiso';
    public $modo = 'create';

    //varibles para el formulario
    #[Validate('required|string|max:255')]
    public $name;
    #[Validate('nullable|string|max:255')]
    public $slug;

    public $mensaje='';

    public $permiso_id;


    public function create()
    {
        $this->limpiar_modal();
        $this->modo = 'create';
        $this->title_modal = 'Crear Permiso';
        $this->button_modal = 'Crear Permiso';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function limpiar_modal()
    {
        $this->reset([
            'name',
            'slug'
        ]);

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function guardar_permiso()
    {


        // Verificar que el campo de nombre no esté vacío
        if (empty($this->name)) {
            $this->addError('name', 'El campo de nombre no puede estar vacío.');
            return;
        }

        $permiso = new Permission();
        $permiso->name = $this->name;
        $slug = strtolower(str_replace(' ', '-', $this->name));
        $permiso->slug = $slug;
        $permiso->save();

        $this->mensaje = 'El permiso se ha creado correctamente';
        $this->limpiar_modal();
        return redirect()->route('configuracion.permiso.index');
    }


    public function edit($id){
        $permiso = Permission::findOrFail($id);
        $this->permiso_id = $id;
        $this->name = $permiso->name;
        $this->slug = $permiso->slug;
        $this->modo = 'edit';
        $this->title_modal = 'Editar Permiso';
        $this->button_modal = 'Actualizar Permiso';

        $this->resetErrorBag();
        $this->resetValidation();

    }

    public function actualizarPermiso(){

        if ($this->modo == 'create') {
            $permiso = new Permission();
        } elseif ($this->modo == 'edit') {
            $permiso = Permission::findOrFail($this->permiso_id);
        }

        $permiso->name = $this->name;
        $slug = strtolower(str_replace(' ', '-', $this->name));
        $permiso->slug = $slug;
        $permiso->save();
        $this->limpiar_modal();
        return redirect()->route('configuracion.permiso.index');
    }

    public function eliminarPermiso($id)
    {
        $permiso = Permission::find($id);
        $this->modo='delete';
        $this->title_modal = 'Eliminar PERMISO';
        if ($permiso) {
            $permiso->delete();
        }
    }


    public function render()
    {

        $permisos = Permission::search($this->search)
        ->orderBy('id', 'asc')
        ->paginate($this->mostrar_paginate);
        return view('livewire.configuracion.permiso.index',[
            'permisos'=>$permisos,
        ]);
    }
}


