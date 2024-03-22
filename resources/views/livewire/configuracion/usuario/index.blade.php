<div>
    <div class="page-header d-print-none animate__animated animate__fadeIn animate__faster">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Configuración</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Usuarios</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title text-uppercase">
                        Usuarios
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <button type="button" class="btn btn-cyan d-none d-sm-inline-block" data-bs-toggle="modal"
                            wire:click="create" data-bs-target="#modal-usuario">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Crear
                        </button>
                        <button type="button" class="btn btn-teal d-sm-none btn-icon" data-bs-toggle="modal"
                            wire:click="create" data-bs-target="#modal-usuario" aria-label="Crear usuario">
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
                A continuación se muestra la lista de usuarios registrados en el sistema.
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
                                        <th>Usuario</th>
                                        <th>Correo</th>
                                        <th>Rol</th>
                                        <th>F. Creación</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($usuarios as $item)
                                    <tr>
                                        <td>
                                            <span class="text-secondary">{{ $item->id }}</span>
                                        </td>
                                        <td class="d-flex align-items-center gap-2">
                                            <img src="{{ $item->avatar ? asset($item->avatar) : $item->avatar }}" alt="avatar" class="avatar">
                                            <span class="fw-bold">
                                                {{ $item->name }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $item->email }}
                                        </td>
                                        <td>
                                            <span class="badge bg-cyan-lt py-2 px-3">
                                                {{ $item->rol->nombre ?? 'Sin rol' }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $item->created_at }}
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
                                                <button type="button" class="btn btn-sm btn-outline-azure"
                                                    data-bs-toggle="modal" data-bs-target="#modal-usuario"
                                                    wire:click="edit({{ $item->id }})">
                                                    Editar
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    @if ($usuarios->count() == 0 && $search != '')
                                    <tr>
                                        <td colspan="7">
                                            <div class="text-center" style="padding-bottom: 5rem; padding-top: 5rem;">
                                                <span class="text-secondary">
                                                    No se encontraron resultados para "<strong>{{ $search }}</strong>"
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="7">
                                            <div class="text-center" style="padding-bottom: 5rem; padding-top: 5rem;">
                                                <span class="text-secondary">
                                                    No hay ciclos registrados
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer {{ $usuarios->hasPages() ? 'py-0' : '' }}">
                            @if ($usuarios->hasPages())
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center text-secondary">
                                    Mostrando {{ $usuarios->firstItem() }} - {{ $usuarios->lastItem() }} de {{
                                    $usuarios->total()}} registros
                                </div>
                                <div class="mt-3">
                                    {{ $usuarios->links() }}
                                </div>
                            </div>
                            @else
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center text-secondary">
                                    Mostrando {{ $usuarios->firstItem() }} - {{ $usuarios->lastItem() }} de {{
                                    $usuarios->total()}} registros
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal ciclo --}}
    <div class="modal" id="modal-usuario" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $title_modal }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="limpiar_modal"></button>
                </div>
                <form autocomplete="off" novalidate wire:submit="guardar_ciclo">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-center mb-3">
                                    @if ($avatar)
                                    <img src="{{ $avatar->temporaryUrl() }}" alt="avatar" class="avatar avatar-md object-fit-cover">
                                    @else
                                    <img src="{{ 'https://ui-avatars.com/api/?name=' . $this->nombre . '&size=64&&color=FFFFFF&background=000000' }}" alt="avatar" class="avatar avatar-md">
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="avatar" class="form-label">
                                        Avatar
                                    </label>
                                    <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                        id="avatar" wire:model.live="avatar" accept="image/*" />
                                    @error('avatar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label required">
                                        Nombre
                                    </label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                        id="nombre" wire:model.live="nombre" placeholder="Ingrese su nombre" />
                                    @error('nombre')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="correo_electronico" class="form-label required">
                                        Correo electrónico
                                    </label>
                                    <input type="email" class="form-control @error('correo_electronico') is-invalid @enderror"
                                        id="correo_electronico" wire:model.live="correo_electronico" placeholder="Ejemplo: example@unia.edu.pe" />
                                    @error('correo_electronico')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="contraseña" class="form-label required">
                                        Contraseña
                                    </label>
                                    <input type="password" class="form-control @error('contraseña') is-invalid @enderror"
                                        id="contraseña" wire:model.live="contraseña" placeholder="********"/>
                                    @error('contraseña')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="$contraseña_confirmacion" class="form-label required">
                                        Confirmar contraseña
                                    </label>
                                    <input type="password" class="form-control @error('$contraseña_confirmacion') is-invalid @enderror"
                                        id="$contraseña_confirmacion" wire:model.live="$contraseña_confirmacion" placeholder="********"/>
                                    @error('$contraseña_confirmacion')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="rol" class="form-label required">
                                        Rol
                                    </label>
                                    <select class="form-select @error('rol') is-invalid @enderror" id="rol"
                                        wire:model.live="rol">
                                        <option value="">Seleccione un rol</option>
                                        @foreach ($roles as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('rol')
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
</div>
