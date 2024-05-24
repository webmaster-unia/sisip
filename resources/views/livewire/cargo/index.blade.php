<div>
    <div class="page-header d-print-none animate__animated animate__fadeIn animate__faster">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Cargo</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title text-uppercase">
                        Cargo
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">

                        <button type="button" class="btn btn-cyan d-none d-sm-inline-block" data-bs-toggle="modal"
                            wire:click="create" data-bs-target="#modal-cargo">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Ingresar Cargo
                        </button>

                        <button type="button" class="btn btn-teal d-sm-none btn-icon" data-bs-toggle="modal"
                            wire:click="create" data-bs-target="#modal-cargo" aria-label="Crear cargo">
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
                A continuación se muestra la lista de los Cargos registrados en el sistema.
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
                                        <th>Cargo</th>
                                        <th>Area</th>
                                        <th>IP</th>
                                        <th>Persona</th>
                                        <th>Correo Institucional</th>
                                        <th>Equipo</th>
                                        <th>Red</th>
                                        <th>Procesador</th>
                                        <th>Memoria</th>
                                        <th>SO</th>
                                        <th>MAC</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cargos as $item)
                                        <tr>
                                            <td>{{ $item->name_cargo }}</td>
                                            <td>{{ $item->area_ip->area->name }}</td>
                                            <td>{{ $item->area_ip->ip->ip }}</td>
                                            <td>{{ $item->nombre }} {{ $item->apellido_paterno }}
                                                {{ $item->apellido_materno }}</td>
                                            <td>{{ $item->correo_institucional ?? '-' }}</td>
                                            <td>{{ $item->nombre_equipo ?? '-' }}</td>
                                            <td>{{ $item->usuario_red ?? '-' }}</td>
                                            <td>{{ $item->procesador ?? '-' }}</td>
                                            <td>{{ $item->memoria ?? '-' }}</td>
                                            <td>{{ $item->sistema_operativo ?? '-' }}</td>
                                            <td>{{ $item->mac_dispositivo ?? '-' }}</td>
                                            <td>
                                            </td>
                                            <td>
                                                <div class="btn-list flex-nowrap justify-content-end">
                                                    <form wire:submit.prevent="eliminar_cargo({{ $item->id }})" style="display: inline;" class="d-inline">
                                                        @if (auth()->user()->permiso('cargo-delete'))
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta tarea?')">Eliminar</button>
                                                        @endif
                                                    </form>
                                                    @if (auth()->user()->permiso('cargo-edit'))
                                                    <button type="button" class="btn btn-sm btn-outline-azure "
                                                        data-bs-toggle="modal" data-bs-target="#modal-cargo"
                                                        wire:click="edit({{ $item->id }})">
                                                        Editar
                                                    </button>


                                                    @endif


                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        @if ($cargos->count() == 0 && $search != '')
                                            <tr>
                                                <td colspan="12">
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
                                                <td colspan="12">
                                                    <div class="text-center"
                                                        style="padding-bottom: 5rem; padding-top: 5rem;">
                                                        <span class="text-secondary">
                                                            No hay cargos registrados
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal cargo --}}
    <div class="modal fade modal-blur" id="modal-cargo" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $title_modal }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="limpiar_modal"></button>
                </div>
                <form autocomplete="off" novalidate wire:submit.prevent="guardar_cargo">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <label for="name_cargo" class="form-label required">
                                    Nombre del Cargo
                                </label>
                                <input type="text" class="form-control @error('name_cargo') is-invalid @enderror"
                                    id="name_cargo" wire:model.live="name_cargo"
                                    placeholder="Ingrese nombre de cargo" />

                            </div>
                            <div class="col-lg-6">
                                <label for="apellido_parterno" class="form-label">
                                    Apellido Paterno
                                </label>
                                <input type="text"
                                    class="form-control @error('apellido_parterno') is-invalid @enderror"
                                    id="apellido_parterno" wire:model.live="apellido_parterno"
                                    placeholder="Ingrese  apellido_parterno" />
                            </div>
                            <div class="col-lg-6">
                                <label for="apellido_materno" class="form-label">
                                    Apellido Materno
                                </label>
                                <input type="text"
                                    class="form-control @error('apellido_materno') is-invalid @enderror"
                                    id="apellido_materno" wire:model.live="apellido_materno"
                                    placeholder="Ingrese apellido_materno" />
                            </div>
                            <div class="col-lg-6">
                                <label for="nombre" class="form-label">
                                    Nombre
                                </label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                    id="nombre" wire:model.live="nombre" placeholder="Ingrese su nombre" />
                            </div>
                            <div class="col-lg-6">
                                <label for="dni" class="form-label">
                                    DNI
                                </label>
                                <input type="text" class="form-control @error('dni') is-invalid @enderror"
                                    id="dni" wire:model.live="dni" placeholder="Ingre su dni" />
                            </div>
                            <div class="col-lg-6">
                                <label for="correo_electronico" class="form-label">
                                    Correo Institucional
                                </label>
                                <input type="text"
                                    class="form-control @error('correo_electronico') is-invalid @enderror"
                                    id="correo_electronico" wire:model.live="correo_electronico"
                                    placeholder="Ingrese su correo_electronico" />
                            </div>
                            <div class="col-lg-6">
                                <label for="nombre_equipo" class="form-label">
                                    Nombre del Equipo
                                </label>
                                <input type="text"
                                    class="form-control @error('nombre_equipo') is-invalid @enderror"
                                    id="nombre_equipo" wire:model.live="nombre_equipo"
                                    placeholder="Ingrese nombre_equipo" />
                            </div>
                            <div class="col-lg-6">
                                <label for="usuario_red" class="form-label">
                                    Usuario de Red
                                </label>
                                <input type="text" class="form-control @error('usuario_red') is-invalid @enderror"
                                    id="usuario_red" wire:model.live="usuario_red"
                                    placeholder="Ingrese el usuario_red" />
                            </div>
                            <div class="col-lg-6">
                                <label for="procesador" class="form-label">
                                    Procesador
                                </label>
                                <input type="text" class="form-control @error('procesador') is-invalid @enderror"
                                    id="procesador" wire:model.live="procesador"
                                    placeholder="Ingrese el procesador" />
                            </div>
                            <div class="col-lg-6">
                                <label for="memoria" class="form-label">
                                    Memoria
                                </label>
                                <input type="text" class="form-control @error('memoria') is-invalid @enderror"
                                    id="memoria" wire:model.live="memoria" placeholder="Ingrese la memoria" />
                            </div>
                            <div class="col-lg-6">
                                <label for="sistema_operativo;" class="form-label">
                                    Sistema Operativo
                                </label>
                                <input type="text"
                                    class="form-control @error('sistema_operativo') is-invalid @enderror"
                                    id="sistema_operativo" wire:model.live="sistema_operativo"
                                    placeholder="Ingrese su sistema_operativo" />
                            </div>
                            <div class="col-lg-6">
                                <label for="mac_dispositivo" class="form-label">
                                    Mac del Dispositivo
                                </label>
                                <input type="text"
                                    class="form-control @error('mac_dispositivo') is-invalid @enderror"
                                    id="mac_dispositivo" wire:model.live="mac_dispositivo"
                                    placeholder="Ingrese mac_dispositivo" />
                            </div>
                            <div class="col-lg-12">
                                <label for="area" class="form-label required">Seleccione un área</label>
                                <select class="form-select @error('area') is-invalid @enderror"
                                    id="area" wire:model.live="area">
                                    <option value="">Seleccione un área</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">
                                            {{ $area->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label for="ip" class="form-label required">Seleccione un IP</label>
                                <select class="form-select @error('ip') is-invalid @enderror"
                                    id="ip" wire:model.live="ip">
                                    <option value="">Seleccione un IP</option>
                                    @foreach ($ips as $item)
                                        <option value="{{ $item->id }}"
                                            @php
                                                $exite = App\Models\AreaIp::where('ip_id', $item->id)->first();
                                                if ($exite) {
                                                    echo 'disabled';
                                                }
                                            @endphp
                                            >
                                            {{ $item->ip->ip }}
                                        </option>
                                    @endforeach
                                </select>
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
