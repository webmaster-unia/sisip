<?php

namespace App\Livewire\Components;

use App\Helpers\HelpersUnia;
use App\Models\Inscripcion;
use Livewire\Component;

class Sidebar extends Component
{
    public function logout() {
        auth()->logout();
        return redirect()->route('login');
    }

    public function render() {
        $user = auth()->user();

        return view('livewire.components.sidebar', [
            'user' => $user
        ]);
    }
}
