<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Login - IP OTI')]
#[Layout('components.layouts.auth')]
class Login extends Component
{
    #[Validate('required|email')]
    public $correo_electronico;

    #[Validate('required')]
    public $contraseña;

    public function ingresar() {
        $this->validate();
        // buscar el usuario por el correo electronico
        $user = User::where('email', $this->correo_electronico)->first();
        // si no existe el usuario
        if (!$user) {
            $this->addError('dni', 'Credenciales incorrectas.');
            // evento de toast basica
            $this->dispatch('toast-basico',
                text: 'Credenciales incorrectas.',
                color: 'danger'
            );
            return;
        }
        // si existe el usuario, verificar la contraseña
        if (Hash::check($this->contraseña, $user->password)) {
            // autenticar al usuario
            auth()->login($user);
            // redireccionar al home
            return redirect()->route('home.index');
        } else {
            $this->addError('dni', 'Credenciales incorrectas.');
            // evento de toast basica
            $this->dispatch('toast-basico',
                text: 'Credenciales incorrectas.',
                color: 'danger'
            );
            return;
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
