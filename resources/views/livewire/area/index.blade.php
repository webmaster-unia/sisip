<div>
    <div class="page-header d-print-none animate__animated animate__fadeIn animate__faster">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Area</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title text-uppercase">
                        Areas
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <button type="button" class="btn btn-cyan d-none d-sm-inline-block" data-bs-toggle="modal"
                            wire:click="create" data-bs-target="#modal-area">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Crear Area
                        </button>
                        <button type="button" class="btn btn-teal d-sm-none btn-icon" data-bs-toggle="modal"
                            wire:click="create" data-bs-target="#modal-rol" aria-label="Crear rol">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="alert alert-info bg-info-lt m-0 mb-3 fw-bold animate__animated animate__fadeIn animate__faster">
                A continuación se muestra la lista de areas registrados en el sistema.
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <div class="card animate__animated animate__fadeIn animate__faster">
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-secondary">
                                    Mostrar
                                    <div class="mx-2 d-inline-block">
                                        <select wire:model.live="mostrar_paginate" class="form-select form-select-sm">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                        </select>
                                    </div>
                                    entradas
                                </div>
                                <div class="ms-auto text-secondary">
                                    Buscar:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm"
                                            wire:model.live.debounce.500ms="search" aria-label="Search invoice">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap table-striped  datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1">No.</th>
                                        <th>Area</th>
                                        <th>Slug</th>
                                        <th>Abreviation</th>
                                        <th>Cantidad</th>
                                        <th>Ip Inicio</th>
                                        <th>Ip Fin</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($areas as $item )
                                    <tr>
                                        <td>
                                            {{$item->id}}
                                        </td>
                                        <td>
                                            {{$item->name}}
                                        </td>
                                        <td>
                                            {{$item->slug}}
                                        </td>
                                        <td>
                                            {{$item->abreviation}}
                                        </td>
                                        <td>
                                            {{$item->cantidad}}
                                        </td>
                                        <td>
                                            {{$item->ip_inicio}}
                                        </td>
                                        <td>
                                            {{$item->ip_fin}}
                                        </td>
                                        <td>
                                            @if ($item->is_active == 1)
                                            <span class="status status-teal px-3 py-2">
                                                <span class="status-dot status-dot-animated"></span>
                                                Activo
                                            </span>
                                            @else
                                            <span class="status status-red px-3 py-2">
                                                <span class="status-dot status-dot-animated"></span>
                                                Inactivo
                                            </span>
                                            @endif

                                        </td>
                                        <td>
                                            <div class="btn-list flex-nowrap justify-content-end">
                                                {{-- <button type="button" class="btn btn-sm btn-outline"
                                                    data-bs-toggle="modal" data-bs-target="#modal-ciclo-ver"
                                                    wire:click="show({{ $item->id }})">
                                                    Ver
                                                </button> --}}






                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                         data-bs-toggle="modal" data-bs-target="#modal-eliminar"
                                                         wire:click="#"
                                                        >Eliminar
                                                    </button>

                                                <button type="button" class="btn btn-sm btn-outline-azure "
                                                    data-bs-toggle="modal" data-bs-target="#modal-area"
                                                    wire:click="edit({{ $item->id }})">
                                                    Editar
                                                </button>
                                                <button wire:click="({{$item->id}})" class="btn btn-sm btn-outline-warning"
                                                    data-bs-toggle="modal" data-bs-target="#modal-ip" >
                                                    Asignar IP
                                                </button>


                                            </div>
                                        </td>
                                    </tr>



                                    @empty
                                    @if ($areas->count() == 0 && $search != '')
                                        <tr>
                                            <td colspan="7">
                                                <div class="text-center"
                                                    style="padding-bottom: 5rem; padding-top: 5rem;">
                                                    <span class="text-secondary">
                                                        No se encontraron resultados para
                                                        "<strong>{{ $search }}</strong>"
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="7">
                                                <div class="text-center"
                                                    style="padding-bottom: 5rem; padding-top: 5rem;">
                                                    <span class="text-secondary">
                                                        No hay areas registradas
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif

                                @endforelse
                                </tbody>


                            </table>
                        </div>
                        <div class="card-footer {{ $areas->hasPages() ? 'py-0' : '' }}">
                            @if ($areas->hasPages())
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center text-secondary">
                                    Mostrando {{ $areas->firstItem() }} - {{ $areas->lastItem() }} de {{
                                        $areas->total()}} registros
                                </div>
                                <div class="mt-3">
                                    {{ $areas->links() }}
                                </div>
                            </div>
                            @else
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center text-secondary">
                                    Mostrando {{ $areas->firstItem() }} - {{ $areas->lastItem() }} de {{
                                        $areas->total()}} registros
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal rol --}}
    <div class="modal fade modal-blur" id="modal-area" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $title_modal }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="limpiar_modal"></button>
                </div>
                <form autocomplete="off" novalidate wire:submit.prevent="{{ $modo === 'edit' ? 'actualizar_area' : 'guardar_area' }}" >
                    <div class="modal-body">

                        <!-- error si intenta crear un campo vacio-->
                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label required">
                                        Nombre del Area
                                    </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="nombre" wire:model.live="name" placeholder="Ingrese nombre del Area" />
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="slug" class="form-label">
                                        Slug
                                    </label>
                                    <input type="text"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        id="slug" wire:model.live="slug"
                                        placeholder="Ingrese Slug" />
                                    @error('slug')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="abreviation" class="form-label">
                                        Abreviation
                                    </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="abreviation" wire:model.live="abreviation" placeholder="Ingrese abreviacion" />
                                    @error('abreviation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="cantidad" class="form-label">
                                        cantidad
                                    </label>
                                    <input type="text" class="form-control @error('cantidad') is-invalid @enderror"
                                        id="cantidad" wire:model.live="cantidad" placeholder="Ingrese cantidad" />
                                    @error('cantidad')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="ip_inicio" class="form-label">
                                        IP Inicio
                                    </label>
                                    <input type="text" class="form-control @error('ip_inicio') is-invalid @enderror"
                                        id="ip_inicio" wire:model.live="ip_inicio" placeholder="Ingrese inicio del IP" />
                                    @error('ip_inicio')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="ip_fin" class="form-label">
                                        IP Fin
                                    </label>
                                    <input type="text" class="form-control @error('ip_fin') is-invalid @enderror"
                                        id="ip_fin" wire:model.live="ip_fin" placeholder="Ingrese fin del ip" />
                                    @error('ip_fin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            wire:click="limpiar_modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-cyan ms-auto">
                            {{ $button_modal }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Para asignar IP --}}
    <div class="modal fade modal-blur" id="modal-ip" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $title_modal_ip }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="limpiar_modal"></button>
                </div>
                <form autocomplete="off" novalidate wire:submit.prevent="asignar_ip" >
                    <div class="modal-body">
                        <!-- error si intenta crear un campo vacio-->
                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                    </div>
                    <div class="row">
                        @foreach($ips as $ip)
                            <div class="col-md-4">
                                <label>
                                    <input type="checkbox" wire:model="selectedIps.{{ $ip->id }}">
                                    {{ $ip->ip }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            wire:click="limpiar_modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-cyan ms-auto">
                            {{ $button_modal_ip }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- modal para eliminar --}}
    <div class="modal fade modal-blur" id="modal-eliminar" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Eliminar Una area
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="limpiar_modal"></button>
                </div>
                <form autocomplete="off" novalidate wire:submit.prevent="confirmar_eliminar" >
                    <div class="modal-body">
                    </div>
                    <div>
                        <h4>¿Estas Seguro que quieres eliminar esta Area?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            wire:click="limpiar_modal">
                            Cancelar
                        </button>
                        <button type="button" class="btn btn-cyan ms-auto">
                            {{ $button_modal_eliminar }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
