<?php

namespace App\Livewire\Cargo;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title ('Cargo - IP OTI')]
#[Layout ('components.layouts.app')]

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    #[Url('Mostrar')]
    public $mostrar_paginate = '10';

    #[Url('Buscar')]
    public $search='';



    public function render()
    {
        $Cargos = $this->search
        ? Cargo::where('name_cargo', 'like', '%' . $this-> search . '%')->paginate($this->mostrar_paginate)
        : Cargo::paginate($this->mostrar_paginate);

        return view('livewire.cargo.index',[
            'cargos'=>$Cargos,

        ]);
    }
}
