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
                            wire:click="create" data-bs-target="#modal-asignar">
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
            <div
                class="alert alert-info bg-info-lt m-0 mb-3 fw-bold animate__animated animate__fadeIn animate__faster">
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
                                        <select wire:model.live="mostrar_paginate"
                                            class="form-select form-select-sm">
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
                                        <th>name cargo</th>
                                        <th>area ip id</th>
                                        <th>apellido paterno</th>
                                        <th>apellido materno</th>
                                        <th>nombre</th>
                                        <th>dni</th>
                                        <th>correo electronico</th>
                                        <th>nombre equipo</th>
                                        <th>usuario red</th>
                                        <th>procesador</th>
                                        <th>memoria</th>
                                        <th>procesador</th>
                                        <th>sistema operativo</th>
                                        <th>mac dispositivo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cargos as $item)
                                        <tr>
                                            <td>
                                                {{ $item->id }}
                                            </td>
                                            <td>
                                                {{ $nama_cargo->name_cargo }}
                                            </td>
                                            <td>
                                                {{ $apellido_paterno->apellido_paterno }}
                                            </td>
                                            <td>
                                                {{ $apellido_materno->paellido_materno }}
                                            </td>
                                            <td>
                                                {{ $nombre->nombre }}
                                            </td>
                                            <td>
                                                {{ $dni->dni }}
                                            </td>
                                            <td>
                                                {{ $correo_electronico->correo_electronico }}
                                            </td>
                                            <td>
                                                {{ $nombre_equipo->nombre_equipo }}
                                            </td>
                                            <td>
                                                {{ $usuario_red->usuario_red }}
                                            </td>
                                            <td>
                                                {{ $procesador->procesador }}
                                            </td>
                                            <td>
                                                {{ $memoria->memoria }}
                                            </td>
                                            <td>
                                                {{ $procesador->procesador }}
                                            </td>
                                            <td>
                                                {{$sistema_operativo->sistema_operativo}}
                                            </td>
                                            <td>
                                                {{ $mac_dispositivo->mac_dispositivo }}
                                            </td>
                                        </tr>
                                    @empty
                                        @if ($cargos->count() == 0 && $search != '')
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
    <div class="modal fade modal-blur" id="modal-asignar" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $title_modal }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="limpiar_modal"></button>
                    <from autocomplete="off" novalidate
                    wire:submit.prevent="{{ $modo === 'edit' ? 'actualizar_cargo' : 'guardar_cargo' }}">
                    </from>
                    <div class="modal-body">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="name_cargo" class="form-label required">
                                name cargo
                            </label>
                            <input type="text" class="form-control @error('name_cargo') is-invalid @enderror"
                                id="name_cargo" wire:model.live="name_cargo"
                                placeholder="Ingrese nombre de cargo" />

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="area_ip_id" class="form-label required">
                                area ip id
                            </label>
                            <input type="text" class="form-control @error('area_ip_id') is-invalid @enderror"
                                id="area_ip_id" wire:model.live="area_ip_id"
                                placeholder="Ingrese nombre del area de ip_id" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="apellido_parterno" class="form-label required">
                                apellido paterno
                            </label>
                            <input type="text" class="form-control @error('apellido_parterno') is-invalid @enderror"
                                id="apellido_parterno" wire:model.live="apellido_parterno"
                                placeholder="Ingrese  apellido_parterno" />

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="apellido_materno" class="form-label required">
                                apellido materno
                            </label>
                            <input type="text" class="form-control @error('apellido_materno') is-invalid @enderror"
                                id="apellido_materno" wire:model.live="apellido_materno"
                                placeholder="Ingrese apellido_materno" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="nombre" class="form-label required">
                                nombre
                            </label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                id="nombre" wire:model.live="nombre"
                                placeholder="Ingrese su nombre" />

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="dni" class="form-label required">
                                dni
                            </label>
                            <input type="text" class="form-control @error('dni') is-invalid @enderror"
                                id="dni" wire:model.live="dni"
                                placeholder="Ingre su dni" />

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="correo_electronico" class="form-label required">
                                correo electronico
                            </label>
                            <input type="text" class="form-control @error('correo_electronico') is-invalid @enderror"
                                id="correo_electronico" wire:model.live="correo_electronico"
                                placeholder="Ingrese su correo_electronico" />

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="nombre_equipo" class="form-label required">
                                nombre equipo
                            </label>
                            <input type="text" class="form-control @error('nombre_equipo') is-invalid @enderror"
                                id="nombre_equipo" wire:model.live="nombre_equipo"
                                placeholder="Ingrese nombre_equipo" />

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="usuario_red" class="form-label required">
                                usuario red
                            </label>
                            <input type="text" class="form-control @error('usuario_red') is-invalid @enderror"
                                id="usuario_red" wire:model.live="usuario_red"
                                placeholder="Ingrese el usuario_red" />

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="procesador" class="form-label required">
                                procesador
                            </label>
                            <input type="text" class="form-control @error('procesador') is-invalid @enderror"
                                id="procesador" wire:model.live="procesador"
                                placeholder="Ingrese el procesador" />

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="nombre" class="form-label required">
                                Nombre del Area
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="nombre" wire:model.live="name"
                                placeholder="Ingrese nombre del Area" />

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="memoria" class="form-label required">
                                memoria
                            </label>
                            <input type="text" class="form-control @error('memoria') is-invalid @enderror"
                                id="memoria" wire:model.live="memoria"
                                placeholder="Ingrese la memoria" />

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="sistema_operativo;" class="form-label required">
                                sistema operativo;
                            </label>
                            <input type="text" class="form-control @error('sistema_operativo') is-invalid @enderror"
                                id="sistema_operativo" wire:model.live="sistema_operativo"
                                placeholder="Ingrese su sistema_operativo" />

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="mac_dispositivo" class="form-label required">
                               mac dispositivo
                            </label>
                            <input type="text" class="form-control @error('mac_dispositivo') is-invalid @enderror"
                                id="mac_dispositivo" wire:model.live="mac_dispositivo"
                                placeholder="Ingrese mac_dispositivo" />

                        </div>
                    </div>
                </div>

                {{-- modal para area --}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="nombre" class="form-label required">Ingrese área</label>
                            <select class="form-select @error('nombre') is-invalid @enderror" id="nombre" wire:model.live="nombre">
                                <option value="">Seleccione una área</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {{-- modal para IP --}}
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="nombre" class="from-label required">
                            selesciona una ip
                        </label>
                        <select class="form-select @error('nombre') is-invalid @enderror" id="nombre"
                        wire:model.live="nombre">
                        <option value="">Escoja una IP
                        </option>
                        <from autocomplete="off" novalidate wire:submit.prevent="asignar_ip">
                            <div class="modal-body">
                                <!-- error si intentas crear un campo vacio-->
                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <option>
                                <div class="mb-3">
                                <button type="button" class="btn btn-primary"
                                    wire:click="filtrarIps('172.16.0.1')">IP 72.16.0.*</button>
                                <button type="button" class="btn btn-primary"
                                    wire:click="filtrarIps('172.16.0.2')">IP 72.16.1.*</button>
                                <button type="button" class="btn btn-primary"
                                    wire:click="filtrarIps('172.16.0.3')">IP 72.16.2.*</button>
                                <button type="button" class="btn btn-primary"
                                    wire:click="filtrarIps('172.16.0.4')">IP 72.16.3.*</button>
                                </option>
                            </div>
                        </from>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
