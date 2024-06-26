<?php

namespace App\Livewire\Configuracion\Usuario;

use App\Models\Role;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

#[Title('Usuarios - IP OTI')]
#[Layout('components.layouts.app')]
class Index extends Component
{
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
    public $user_id;

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

    public function create()
    {
        $this->limpiar_modal();
        $this->modo = 'create';
        $this->title_modal = 'Crear nuevo usuario';
        $this->button_modal = 'Crear usuario';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function limpiar_modal()
    {
        $this->reset([
            'nombre',
            'correo_electronico',
            'contraseña',
            'contraseña_confirmacion',
            'avatar',
            'rol',
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function guardar_ciclo()
    {
        $user = new User();
        $user->name = $this->nombre;
        $user->email = $this->correo_electronico;

        // Asignar una contraseña predeterminada si no se proporciona una
        $user->password = $this->contraseña ?? 'defaultpassword';

        $user->avatar = $this->avatar;

        $user->save();

        $this->limpiar_modal();
        return redirect()->route('configuracion.usuario.index');
    }

    public function edit_user($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->nombre = $user->name;
        $this->correo_electronico = $user->email;
        $this->rol = $user->roles->first()->id;
        $this->modo = 'edit';
        $this->title_modal = 'Editar User';
        $this->button_modal = 'Actualizar User';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    //ahora actualizarlo
    public function guardar_user()
    {
        $this->validate([
            'nombre' => 'required|max:255',
            'correo_electronico' => 'required|email|max:255',
            'rol' => 'required|exists:roles,id',
            'contraseña' => $this->modo == 'create' ? 'required|min:8|max:255' : 'nullable|min:8|max:255',
            'contraseña_confirmacion' => $this->modo == 'create' ? 'required|min:8|max:255|same:contraseña' : 'nullable|min:8|max:255|same:contraseña',

        ]);

        if ($this->modo == 'create') {
            $user = new User();
        } elseif ($this->modo == 'edit') {
            $user = User::findOrFail($this->user_id);
        }
        $user->name = $this->nombre;
        $user->email = $this->correo_electronico;
        if ($this->contraseña) {
            $user->password = Hash::make($this->contraseña);
        }
        if ($this->avatar) {
            // subir la imagen
            $nombre_db = subirFile($this->avatar, User::class, 'avatar', $user->id, 'avatars');
            $user->avatar = $nombre_db;
        }
        $user->save();

        // sincronizar el rol
        if ($this->modo == 'create') {
            $user->roles()->sync($this->rol);
        } elseif ($this->modo == 'edit') {
            $user->roles()->sync([$this->rol]);
        }

        $this->limpiar_modal();
        $this->dispatch('modal',
            modal: '#modal-usuario',
            action: 'hide'
        );
    }

    public function eliminar_user($id)
    {

        User::findOrFail($id)->delete();
        return $this->render();
    }

    public function render()
    {
        $usuarios = User::search($this->search)
            ->orderBy('id', 'asc')
            ->paginate($this->mostrar_paginate);
        $roles = Role::where('is_active', true)->get();
        return view('livewire.configuracion.usuario.index', [
            'usuarios' => $usuarios,
            'roles' => $roles,
        ]);
    }
}
