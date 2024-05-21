<?php

namespace App\Livewire\Cargo;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Cargo;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use App\Area;
use App\DireccionIP;
use App\Models\Ip;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
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

    //variables modal
    public $title_modal='crear nuevo cargo';

    #[Validate('nullable|string|max:50')]
    public $name_cargo;

    public $ips;

    public $area_ip_id;
    #[Validate('nullable|string|max:50')]
    public $apellido_paterno;
    #[Validate('nullable|string|max:50')]
    public $apellido_materno;
    #[Validate('nullable|string|max:50')]
    public $nombre;
    #[Validate('nullable|string|max:50')]
    public $dni;
    #[Validate('nullable|string|max:50')]
    public $correo_institucional;
    #[Validate('nullable|string|max:50')]
    public $nombre_equipo;
    #[Validate('nullable|string|max:50')]
    public $usuario_red;
    #[Validate('nullable|string|max:50')]
    public $procesador;
    #[Validate('nullable|string|max:50')]
    public $memoria;
    #[Validate('nullable|string|max:50')]
    public $sistema_opreativo;
    #[Validate('nullable|string|max:50')]
    public $mac_dispositivo;
    #[Validate('required|max:255')]



       //validar ips en masa
       public $selectedIps = [];
       public $idEliminar;
       public $ips;
       public $filtrar_Ips =[];
       public $button_VerIps='crear Ips en masa';




    //generar IPS
    public function GenerarIps()
    {
        //podemos usar el script
        $inicio = '172.16.0.1';
        $fin = '172.16.3.225';

        //convertir las cadenas de inicio a fin en arrays (IPS)

        $inicioArray = explode('.', $inicio);
        $finArray = explode('.', $fin);

        //Iterar desde el numero inicial hasta el final IPS

        for ($i = $inicioArray[3]; $i <= $finArray[3]; $i++){
            //convertir la direccion de las IPS Actual
            $ip = $inicioArray[0] . '.' . $inicioArray[1] . '.' . $inicioArray[2] . '.' . $i;

            //para crear una nueva instancia del modelo
            $datoNuevo = new Ip();

            //Asignar los valores para las IPS
            $datoNuevo->ip = $ip;

            //Asiganar en la base de Datos
            $datoNuevo->save();
        }

        //Redireccion despues de que todas las IPS hayan sido generadas y guardadas

        return redirect()->route('cargo.index');
    }

    //para que muestre las IPS

    public function filtrar_Ips($filtro)
    {
        $cargo = Cargo::findOrFail($id);
        $this->name_cargo = $id;
        $this->apellido_paterno = $cargo->apellido_paterno;
        $this->apellido_materno = $cargo->apellido_materno;
        $this->nombre = $cargo->nombre;
        $this->dni = $cargo->dni;
        $this->correo_institucional  = $cargo->correo_institucional ;
        $this->nombre_equipo  = $cargo->nombre_equipo ;
        $this->usuario_red   = $cargo->usuario_red;
        $this->procesador  = $cargo->procesador;
        $this->memoria  = $cargo->memoria;
        $this->sistema_opreativo  = $cargo->sistema_opreativo;
        $this->mac_dispositivo  = $cargo->mac_dispositivo;
        $this->modo = 'edit';
        $this->title_modal = 'Editar Cargo';
        $this->button_Cargo = 'Actualizar Cargo';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    //ahora actualizarlo
    public function actualizar_Cargo()
    {
        if ($this->modo == 'create') {
            $cargo = new Cargo();
        } elseif ($this->modo == 'edit') {
            $cargo = Cargo::findOrFail($this->name_cargo);
        }

        $cargo->name_cargo = $this->name_cargo;
        $cargo->apellido_paterno = $this->apellido_paterno;
        $cargo->apellido_materno = $this->apellido_materno;
        $cargo->nombre = $this->nombre;
        $cargo->dni = $this->dni;
        $cargo->correo_institucional  = $this->correo_institucional ;
        $cargo->nombre_equipo = $this->nombre_equipo;
        $cargo->usuario_red  = $this->usuario_red ;
        $cargo->procesador = $this->procesador;
        $cargo->memoria  = $this->memoria;
        $cargo->sistema_opreativo = $this->sistema_opreativo;
        $cargo->mac_dispositivo = $this->mac_dispositivo;
        $cargo->save();
        $this->limpiar_modal();
    }

    public function mount()
    {
        $this->getAllIps();
    }

    public function getAllIps()
    {
        $this->ips = Ip::all();
    }
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
