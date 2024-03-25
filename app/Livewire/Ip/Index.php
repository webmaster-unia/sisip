<?php

namespace App\Livewire\Ip;

use Livewire\Component;

class Index extends Component
{


    public $button_modal = 'crear ip';

    public $modo = 'create';

    public $ip;
    public $is_active;

    public function create()
    {
        $this->limpiar_modal();
        $this->modo = 'create';
        $this->button_modal = 'crear ip';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function limpiar_modal()
    {
        $this->reset([
            'ip',
            'is_active'
        ]);

        $this->resetErrorBag();
        $this->resetValidation();
    }
    public function render()
    {
        return view('livewire.ip.index');
    }
}
