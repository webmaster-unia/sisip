<?php

namespace App\Livewire\Area;

use App\Models\Area;
use App\Models\AreaIp;
use App\Models\Ip;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

#[Title('Areas - IP OTI')]
#[Layout('components.layouts.app')]

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use WithFileUploads;

    #[Url('mostrar')]
    public $mostrar_paginate = '10';

    #[Url('buscar')]
    public $search = '';


    //Varibles Modal

    //para modal de asignar IP
    public $title_modal_ip = 'Asignar IP';
    public $button_modal_ip = 'Asignar IP';

    //para modal de crear y editar
    public $title_modal = 'Crear nueva Area';
    public $button_modal = 'Crear area';

    //para eliminar
    public $button_modal_eliminar = "Eliminar Area";
    public $modo = 'create';



    //variables para formulario
    #[Validate('required|string|max:255')]
    public $name;
    #[Validate('nullable|string|max:255')]

    public $abreviation;
    #[Validate('nullable|numeric')]
    public $cantidad;
    #[Validate('nullable|string|max:100')]
    public $ip_inicio;
    #[Validate('nullable|string|max:100')]


    //para almacenar las ip
    public $selectIps = [];
    public $id_eliminar;
    public $alm_ip;
    public $ips;
    public $mensaje = '';
    public $ip_fin;
    public $is_active;

    public $area_id;

    public $filteredIps = [];


    //crear area
    public function create()
    {
        $this->limpiar_modal();
        $this->modo = 'create';
        $this->title_modal = 'Crear nueva Area';
        $this->button_modal = 'Crear area';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function limpiar_modal()
    {
        $this->reset([
            'name',
            'slug',
            'abreviation',
            'cantidad',
            'ip_inicio',
            'ip_fin',
            'is_active'
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }
    //guardar crear
    public function guardar_area()
    {

        //para hacer que no ingrese campos vacios
        if (empty($this->name) || empty($this->cantidad) || empty($this->ip_inicio) || empty($this->ip_fin)) {
            session()->flash('error', 'Por favor, complete todos los campos.');
            return;
        }

        $area = new Area();
        $area->name = $this->name;
        $slug = strtolower(str_replace(' ', '-', $this->name));
        $area->slug = $slug;
        $area->abreviation = $this->abreviation;
        $area->cantidad = $this->cantidad;
        $area->ip_inicio = $this->ip_inicio;
        $area->ip_fin = $this->ip_fin;
        $area->save();
        $this->mensaje = 'El area se ah creado correctamente';
        $this->limpiar_modal();
        return redirect()->route('area.index');
    }


    //editar prueba almacenar
    public function edit($id)
    {
        $area = Area::findOrFail($id);
        $this->area_id = $id;
        $this->name = $area->name;
        $this->abreviation = $area->abreviation;
        $this->cantidad = $area->cantidad;
        $this->ip_inicio = $area->ip_inicio;
        $this->ip_fin = $area->ip_fin;
        $this->modo = 'edit';
        $this->title_modal = 'Editar Area';
        $this->button_modal = 'Actualizar Area';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    //ahora actualizarlo
    public function actualizar_area()
    {
        if ($this->modo == 'create') {
            $area = new Area();
        } elseif ($this->modo == 'edit') {
            $area = Area::findOrFail($this->area_id);
        }

        $area->name = $this->name;
        $slug = strtolower(str_replace(' ', '-', $this->name));
        $area->slug = $slug;
        $area->abreviation = $this->abreviation;
        $area->cantidad = $this->cantidad;
        $area->ip_inicio = $this->ip_inicio;
        $area->ip_fin = $this->ip_fin;
        $area->save();
        $this->limpiar_modal();
        return redirect()->route('area.index');
    }


    //agregar (boton) para asignar una ip
    //abrir um modal
    //lista de checkbox de ips disponibles
    //se guarde en la tabla area_ip, solo guardar los ID



    //obtener las ip para mostar en mi modal
    public function mount()
    {
        $this->getAllIp();
    }

    public function getAllIp()
    {
        $this->ips = Ip::all();
    }

    //filtrar las ip e el moddal
    public function filtrarIps($filtro)
    {


        // Verificar si el filtro seleccionado es opcion 0,1,2 o  3
        if ($filtro === '172.16.0.1') {
            // Filtrar todas las IPs que tengan el número 0 como penúltimo número yasi sucesivamente hasta el 3
            $this->filteredIps = Ip::whereRaw("substring_index(substring_index(ip, '.', -2), '.', 1) = '0'")->get();
        } elseif ($filtro === '172.16.0.2') {

            $this->filteredIps = Ip::whereRaw("substring_index(substring_index(ip, '.', -2), '.', 1) = '1'")->get();
        } elseif ($filtro === '172.16.0.3') {

            $this->filteredIps = Ip::whereRaw("substring_index(substring_index(ip, '.', -2), '.', 1) = '2'")->get();
        } elseif ($filtro === '172.16.0.4') {

            $this->filteredIps = Ip::whereRaw("substring_index(substring_index(ip, '.', -2), '.', 1) = '3'")->get();
        } else {

            $this->filteredIps = Ip::where('ip', 'like', "$filtro%")->get();
        }



    }


    //activar desactivar
    public function cambiar_estado($id, $value)
    {
        $is_active = Area::find($id);
        if ($is_active) {
            if ($value == true) {
                $is_active->is_active = false;
            } else {
                $is_active->is_active = true;
            }
            $is_active->save();
        }
    }



    public function cargar_asignar_ips($id)
    {
        //dd($id);
        $area = Area::findOrFail($id);
        $this->area_id = $id;
        $this->selectIps= $area->ips->pluck('id')->toArray();
    }

    public function asignar_ips()
    {
        //dd($this->all());
        $area = Area::findOrFail($this->area_id);

        $area->ips()->sync($this->selectIps);
        $this->dispatch('toast-basico',
            text: 'Permisos asignados correctamente',
            tipo: 'success'
        );
        $this->dispatch(
            'modal',
            modal: '#modal-ip',
            action: 'hide'
        );
        $this->reset();

    }



    //asignar ip a un area


    /*
    public function asignar()
    {
        $rol = new Rol();
        $rol->nombre = $this->nombre;
        $rol->estado = $this->estado == true ? 1 : 0;
        $rol->save();
        $rol->permisos()->sync($this->permiso); // $this->permiso es el array que contiene todos los id de permiso
        // mostramos mensaje
        $this->dispatch('toast-basico', text: 'El rol se creo correctamente', color: 'success');
    }
*/


    //separar por columnas d
    //que exista opciones
    //cada opcion que selecccione me muestre la columna que se selcciono
    //sepracion 0 1 2 3

    //eliminar

    public function eliminar_area($id)
    {

        $areas = Area::find($id);
        if ($areas) {
            $areas->delete();
            $this->mensaje = 'El área se ha eliminado correctamente';
        } else {
            $this->mensaje = 'No se pudo eliminar el área';
        }

        $this->limpiar_modal();
    }


    public function render()
    {
        $areas = Area::search($this->search)
            ->orderBy('created_at', 'desc')
            ->paginate($this->mostrar_paginate);
        return view('livewire.area.index', [
            'areas' => $areas,
        ]);
    }
}
