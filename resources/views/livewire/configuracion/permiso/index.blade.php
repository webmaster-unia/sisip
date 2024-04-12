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
                                        <th>Nombre</th>
                                        <th>Slug</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($usuarios as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td class="d-flex align-items-center gap-2">
                                            <img src="{{ $item->avatar ? asset($item->avatar) : $item->avatar }}" alt="avatar" class="avatar">
                                            <span class="fw-bold">
                                                {{ $item->name }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-list flex-nowrap justify-content-end">
                                                <button type="button" class="btn btn-sm btn-outline-azure"
                                                    data-bs-toggle="modal" data-bs-target="#modal-usuario" wire:click="ver_user({{ $item->id }})">
                                                    Ver
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-azure"
                                                    data-bs-toggle="modal" data-bs-target="#modal-usuario"
                                                    wire:click="edit_user({{ $item->id }})">
                                                    Editar
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        
                        <div class="card-footer {{ $usuarios->hasPages() ? 'py-0' : '' }}">
                            @if ($usuarios->hasPages())
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center text-secondary">
                                    Mostrando {{ $usuarios->firstItem() }} - {{ $usuarios->lastItem() }} de {{ $usuarios->total() }} registros
                                </div>
                                <div class="mt-3">
                                    {{ $usuarios->links() }}
                                </div>
                            </div>
                            @else
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center text-secondary">
                                    Mostrando {{ $usuarios->firstItem() }} - {{ $usuarios->lastItem() }} de {{ $usuarios->total() }} registros
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
    <div class="modal fade modal-blur" id="modal-rol" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">

                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="limpiar_modal"></button>
                </div>
                <form autocomplete="off" novalidate wire:submit="guardar_ciclo">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label required">
                                        Nombre
                                    </label>
                                    <input type="text" class="form-control"
                                        id="nombre" wire:model.live="nombre" placeholder="Ingrese su nombre" />

                                    <div class="invalid-feedback">

                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">
                                        Descripcion
                                    </label>
                                    <input type="text" class="form-control"
                                        id="descripcion" wire:model.live="descripcion" placeholder="Ingrese la descripcion del rol" />

                                    <div class="invalid-feedback">

                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12">
            <div class="mb-3">
                <label class="form-label">Permisos</label><br>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="permiso1" wire:model="permisos" value="permiso1">
                    <label class="form-check-label" for="permiso1">Usuario</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="permiso2" wire:model="permisos" value="permiso2">
                    <label class="form-check-label" for="permiso2">Roles</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="permiso3" wire:model="permisos" value="permiso3">
                    <label class="form-check-label" for="permiso3">Permiso</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="permiso4" wire:model="permisos" value="permiso4">
                    <label class="form-check-label" for="permiso4">Area</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="permiso5" wire:model="permisos" value="permiso5">
                    <label class="form-check-label" for="permiso5">IP</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="permiso6" wire:model="permisos" value="permiso6">
                    <label class="form-check-label" for="permiso6">Cargo</label>
                </div>
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
                            {{$button_modal}} 

                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
