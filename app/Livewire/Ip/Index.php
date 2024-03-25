<?php

namespace App\Livewire\Ip;

use Livewire\Component;

class Index extends Component
{

    public $button_modal='crear ip';

    public function render()
    {
        return view('livewire.ip.index');
    }
}
