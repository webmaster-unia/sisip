<?php

namespace App\Livewire\Configuracion\Rol;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Roles - IP OTI')]
#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

    #[Url('mostrar')]
    public $mostrar_paginate = '10';

    #[Url('buscar')]
    public $search = '';

    // variables modal
    public $title_modal = 'Crear nuevo rol';
    public $button_modal = 'Crear rol';
    public $modo = 'create';

    // variables para el formulario
    #[Validate('required|max:255')]
    public $name;
    #[Validate('max:255')]
    public $slug;
    #[Validate('required|max:255')]
    public $description;
    #[Validate('nullable|boolean')]
    public $is_active;


    //para modal de asignar Roles
    public $title_modal_rol = 'Asignar Permisos';
    public $button_modal_rol = 'Asignar Permiso';
    //variable para almacenar el id
    public $role_id;

    public $permisos;

    public function create()
    {
        $this->limpiar_modal();
        $this->modo = 'create';
        $this->title_modal = 'Crear nuevo rol';
        $this->button_modal = 'Crear Rol';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function limpiar_modal()
    {
        $this->reset([
            'name',
            'slug',
            'description',
            'is_active',
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function guardar_rol()
    {

        if (empty($this->name) || empty($this->description)) {
            session()->flash('error', 'Por favor, complete todos los campos.');
            return;
        }

        //para hacer que no ingrese campos vacios
        $rol = new Role();
        $rol->name = $this->name;
        $slug = strtolower(str_replace(' ', '-', $this->name));
        $rol->slug = $slug;
        $rol->description = $this->description;
        $rol->save();
        $this->limpiar_modal();
        return redirect()->route('configuracion.rol.index');
    }

    //editar roles
    public function edit($id)
    {
        $rol  = Role::findOrFail($id);
        $this->role_id = $id;
        $this->name = $rol->name;
        $this->slug = $rol->slug;
        $this->description = $rol->description;
        $this->modo = 'edit';
        $this->title_modal = 'Editar Rol';
        $this->button_modal = 'Editar Rol';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function actualizar_rol()
    {
        if ($this->modo == 'create') {
            $rol = new Role();
        } else if ($this->modo == 'edit') {
            $rol = Role::findOrFail($this->role_id);
        }

        $rol->name = $this->name;
        $slug = strtolower(str_replace(' ', '-', $this->name));
        $rol->slug = $slug;
        $rol->description = $this->description;
        $rol->save();
        $this->limpiar_modal();
        $this->dispatch(
            'modal',
            modal: '#modal-rol',
            action: 'hide'
        );
    }

    public function mount()
    {
        $this->getAllPermisos();
    }

    public function getAllPermisos()
    {
        $this->permisos = Permission::all();
    }

    public function asignar()
    {
    }

    public function eliminar_rol($id)
    {
        Role::findOrFail($id)->delete();
        return $this->render();
    }

    public function render()
    {
        $roles = Role::search($this->search)
            ->orderBy('id', 'asc')
            ->paginate($this->mostrar_paginate);
        return view('livewire.configuracion.rol.index', [
            'roles' => $roles,
        ]);
    }
}
