<?php

namespace App\Livewire\Cargo;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title ('Cargo - IP OTI')]
#[Layout ('components.layouts.app')]

class Index extends Component
{
    public function render()
    {
        return view('livewire.cargo.index');
    }
}
