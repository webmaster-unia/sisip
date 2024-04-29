<div>
    <div class="page-header d-print-none animate__animated animate__fadeIn animate__faster">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Configuración</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Permisos</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title text-uppercase">
                        Permisos
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <button type="button" class="btn btn-cyan d-none d-sm-inline-block" data-bs-toggle="modal"
                            wire:click="create" data-bs-target="#modal-permisos">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Crear permiso
                        </button>
                        <button type="button" class="btn btn-teal d-sm-none btn-icon" data-bs-toggle="modal"
                            wire:click="create" data-bs-target="#modal-rol" aria-label="Crear permiso">
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
                A continuación se muestra la lista de permisos registrados en el sistema.
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
                                        <th>Permisos</th>
                                        <th>slug</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($permisos as $item )
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
                                            <div class="btn-list flex-nowrap justify-content-end">
                                                {{-- <button type="button" class="btn btn-sm btn-outline"
                                                    data-bs-toggle="modal" data-bs-target="#modal-ciclo-ver"
                                                    wire:click="show({{ $item->id }})">
                                                    Ver
                                                </button> --}}

                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                        wire:click="eliminarPermiso({{ $item->id }})">
                                                    Eliminar
                                                </button>


                                                <button type="button" class="btn btn-sm btn-outline-azure "
                                                    data-bs-toggle="modal" data-bs-target="#modal-permisos"
                                                    wire:click="edit({{ $item->id }})">
                                                    Editar
                                                </button>



                                            </div>
                                        </td>
                                    </tr>

                                    @empty
                                    @if ($permisos->count() == 0 && $search != '')
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
                                                        No hay permisos registradas
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif

                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer {{ $permisos->hasPages() ? 'py-0' : '' }}">
                            @if ($permisos->hasPages())
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center text-secondary">
                                    Mostrando {{ $permisos->firstItem() }} - {{ $permisos->lastItem() }} de {{
                                        $permisos->total()}} registros
                                </div>
                                <div class="mt-3">
                                    {{ $permisos->links() }}
                                </div>
                            </div>
                            @else
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center text-secondary">
                                    Mostrando {{ $permisos->firstItem() }} - {{ $permisos->lastItem() }} de {{
                                        $permisos->total()}} registros
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal permisos --}}
    <div class="modal fade modal-blur" id="modal-permisos" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ $title_modal }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="limpiar_modal"></button>
            </div>
            <form autocomplete="off" novalidate
                    wire:submit.prevent="{{ $modo === 'edit' ? 'actualizarPermiso' : 'guardar_permiso' }}">
                <div class="modal-body">
                    <!-- error si intenta crear un campo vacio-->
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="row">
                        <!-- Espacio para agregar nombre -->
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" wire:model="name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                        wire:click="limpiar_modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-cyan ms-auto">
                        {{$button_modal}} 
                    </button>


                </div>
            </form>
        </div>
    </div>
</div>

</div>
