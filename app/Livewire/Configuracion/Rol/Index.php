<?php

namespace App\Livewire\Configuracion\Rol;

use App\Models\Role;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Roles - IP OTI')]
#[Layout('components.layouts.app')]
class Index extends Component {
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
    public $nombre;
    #[Validate('max:255')]
    public $slug;
    #[Validate('required|max:255')]
    public $descripcion;
    #[Validate('nullable|boolean')]
    public $is_active;

    public function create() {
        $this->limpiar_modal();
        $this->modo = 'create';
        $this->title_modal = 'Crear nuevo rol';
        $this->button_modal = 'Crear rol';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function limpiar_modal() {
        $this->reset([
            'nombre',
            'slug',
            'descripcion',
            'is_active',
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render() {
        $roles = Role::search($this->search)
            ->orderBy('created_at', 'desc')
            ->paginate($this->mostrar_paginate);
        return view('livewire.configuracion.rol.index', [
            'roles' => $roles,
        ]);
    }
}
