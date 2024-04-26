<?php

namespace App\Livewire\Configuracion\Permiso;

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


        //Varibles Modal
    public $title_modal = 'Crear Permiso';
    public $button_modal = 'Crear Permiso';
    public $modo = 'create';

    //varibles para el formulario
    #[Validate('required|string|max:255')]
    public $name;
    #[Validate('nullable|string|max:255')]
    public $slug;


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


    public $users; // Propiedad para almacenar los usuarios

    public function renderUsers()
    {
        // Obtener todos los usuarios
        $this->users = User::all();

        return view('livewire.configuracion.permiso.index', [
            'users' => $this->users,
        ]);
    }



    public $mostrar_paginate = 10;


    public function render()
    {

        // Obtén usuarios paginados con búsqueda si está presente, de lo contrario, obtén todos los usuarios
        $usuarios = $this->search
            ? User::where('name', 'like', '%' . $this->search . '%')->paginate($this->mostrar_paginate)
            : User::paginate($this->mostrar_paginate);

        return view('livewire.configuracion.permiso.index', [
            'usuarios' => $usuarios,
        ]);
    }
    

        public function togglePermission($userId, $permission)
    {
        $user = User::findOrFail($userId);

        if ($user->hasPermission($permission)) {
            $user->revokePermission($permission);
        } else {
            $user->givePermissionTo($permission);
        }
    }



}


