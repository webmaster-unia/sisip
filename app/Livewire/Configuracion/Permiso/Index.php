<?php

namespace App\Livewire\Configuracion\Permiso;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
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
    


    public function render()
    {
        return view('livewire.configuracion.permiso.index');
    }
}
