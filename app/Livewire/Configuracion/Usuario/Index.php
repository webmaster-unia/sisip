<?php

namespace App\Livewire\Configuracion\Usuario;

use App\Models\Role;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

#[Title('Usuarios - IP OTI')]
#[Layout('components.layouts.app')]
class Index extends Component {
    use WithPagination;
    use WithFileUploads;

    #[Url('mostrar')]
    public $mostrar_paginate = '10';

    #[Url('buscar')]
    public $search = '';

    // variables modal
    public $title_modal = 'Crear nuevo usuario';
    public $button_modal = 'Crear usuario';
    public $modo = 'create';

    // variables para el formulario
    #[Validate('required|max:255')]
    public $nombre;
    #[Validate('required|email|max:255')]
    public $correo_electronico;
    #[Validate('required|min:8|max:255')]
    public $contraseña;
    #[Validate('required|min:8|max:255|same:contraseña')]
    public $contraseña_confirmacion;
    #[Validate('image|max:2048')]
    public $avatar;
    #[Validate('required|exists:roles,id')]
    public $rol;

    public function create() {
        $this->limpiar_modal();
        $this->modo = 'create';
        $this->title_modal = 'Crear nuevo usuario';
        $this->button_modal = 'Crear usuario';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function limpiar_modal() {
        $this->reset([
            'nombre',
            'correo_electronico',
            'contraseña',
            'contraseña_confirmacion',
            'avatar',
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render() {
        $usuarios = User::search($this->search)
            ->orderBy('created_at', 'desc')
            ->paginate($this->mostrar_paginate);
        $roles = Role::where('is_active', true)->get();
        return view('livewire.configuracion.usuario.index', [
            'usuarios' => $usuarios,
            'roles' => $roles,
        ]);
    }
}
