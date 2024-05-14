<?php

namespace App\Livewire\Cargo;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
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

    //variables para el el formulario cargo

    #[Validate('required|max:100')]

    public $name_cargo;
    #[Validate('max:255')]

    public $area_ip_id;
    #[Validate('required|max:255')]

    public $apellido_paterno;
    #[Validate('required|max:255')]

    public $apellido_materno;
    #[Validate('required|max:255')]

    public $nombre;
    #[Validate('required|max:255')]
    public $dni;
    #[Validate('required|max:255')]

    public $correo_electronico;
    #[Validate('required|max:255')]

    public $nombre_equipo;
    #[Validate('required|max:255')]

    public $usuario_red;
    #[Validate('required|max:255')]

    public $procesador;
    #[Validate('required|max:255')]

    public $memoria;
    #[Validate('required|max:255')]

    public $sistema_operativo;
    #[Validate('required|max:255')]

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
            // Verificar si el filtro seleccionado es opcion 0,1,2 o  3
            if ($filtro === '172.16.0.1') {
                // Filtrar todas las IPs que tengan el número 0 como penúltimo número yasi sucesivamente hasta el 3
                $this->filtrar_Ips = Ip::whereRaw("substring_index(substring_index(ip, '.', -2), '.', 1) = '0'")->get();
            } elseif ($filtro === '172.16.0.2') {

                $this->filtrar_Ips = Ip::whereRaw("substring_index(substring_index(ip, '.', -2), '.', 1) = '1'")->get();
            } elseif ($filtro === '172.16.0.3') {

                $this->filtrar_Ips = Ip::whereRaw("substring_index(substring_index(ip, '.', -2), '.', 1) = '2'")->get();
            } elseif ($filtro === '172.16.0.4') {

                $this->filtrar_Ips = Ip::whereRaw("substring_index(substring_index(ip, '.', -2), '.', 1) = '3'")->get();
            } else {

                $this->filtrar_Ips = Ip::where('ip', 'like', "$filtro%")->get();
            }
    }

    //Muestras para las IPS

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

        $cargos = Cargo::search($this->search)
        ->orderBy('id', 'asc')
        ->paginate($this->mostrar_paginate);
        return view('livewire.cargo.index',[
            'cargos'=>$cargos,
        ]);
    }
}
