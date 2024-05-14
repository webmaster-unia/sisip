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
                                <tbody>
                                    <thead>
                                        <tr>
                                            <th>Name Cargo</th>
                                            <th>Area_Ip_Id</th>
                                            <th>Apellido Paterno</th>
                                            <th>Apellido Materno</th>
                                            <th>Nombre</th>
                                            <th>Dni</th>
                                            <th>Correo Electronico</th>
                                            <th>Nombre Equipo</Em></th>
                                            <th>Usuario Red</th>
                                            <th>Procesador</th>
                                            <th>Memoria</th>
                                            <th>Sistema Operativo</th>
                                            <th>Mac Dispositivo</th>
                                        </tr>
                                    </thead>

                                    @forelse ($cargos as $item)
                                        <tr>
                                            <td>
                                            <td>
                                                <div class="btn-list flex-nowrap justify-content-end">
                                                    {{-- <button type="button" class="btn btn-sm btn-outline"
                                                    data-bs-toggle="modal" data-bs-target="#modal-ciclo-ver"
                                                    wire:click="show({{ $item->id }})">
                                                    Ver
                                                </button> --}}

                                                    <form wire:submit.prevent="eliminar_area({{ $item->id }})"
                                                        style="display: inline;" class="d-inline">
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('¿Estás seguro de que quieres eliminar esta area?')">Eliminar</button>
                                                    </form>
                                                    <button type="button" class="btn btn-sm btn-outline-azure"
                                                        data-bs-toggle="modal" data-bs-target="#modal-rol"
                                                        wire:click="edit({{ $item->id }})">
                                                        Editar
                                                    </button>

                                                </div>
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
                        Cargo
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="limpiar_modal"></button>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="Name Cargo" class="form-label">
                            Name Cargo
                        </label>
                        <input type="text" class="form-control @error('Name Cargo') is-invalid @enderror"
                            id="Name Cargo" wire:model.live="Name Cargo" placeholder="Ingrese el Nombre Cargo" />
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="Area_ip_id" class="form-label">
                                Area IP ID
                            </label>
                            <input type="int" class="form-control @error('Area_ip_id') is-invalid @enderror"
                                id="Area_ip_id" wire:model.live="Area_ip_id" placeholder="Ingrese Area_ip_id" />
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="Apllido_Paterno" class="form-label">
                                        Apellido Paterno
                                    </label>
                                    <input type="text"
                                        class="form-control @error('Apllido_Paterno') is-invalid @enderror"
                                        id="Apllido_Paterno" wire:model.live="Apllido_Paterno"
                                        placeholder="Ingrese su Apllido_Paterno" />
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="Apllido_Materno" class="form-label">
                                                Apellido Materno
                                            </label>
                                            <input type="text"
                                                class="form-control @error('Apllido_Materno') is-invalid @enderror"
                                                id="Apllido_Materno" wire:model.live="Apllido_Materno"
                                                placeholder="Ingrese su Apllido_Materno" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="Nombre" class="form-label">
                                                Nombre
                                            </label>
                                            <input type="text"
                                                class="form-control @error('Nombre') is-invalid @enderror"
                                                id="Nombre" wire:model.live="Nombre"
                                                placeholder="Ingrese su Nombre" />
                                        </div>

                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="DNI" class="form-label">
                                                DNI
                                            </label>
                                            <input type="text"
                                                class="form-control @error('DNI') is-invalid @enderror" id="DNI"
                                                wire:model.live="DNI" placeholder="Ingrese su DNI" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="Correo_electronico" class="form-label">
                                                Correo Electronico
                                            </label>
                                            <input type="text"
                                                class="form-control @error('Correo_electronico') is-invalid @enderror"
                                                id="Correo_electronico" wire:model.live="Correo_electronico"
                                                placeholder="Ingrese su Correo_electronico" />
                                        </div>

                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="Nombre_Equipo" class="form-label">
                                                Nombre Equipo
                                            </label>
                                            <input type="text"
                                                class="form-control @error('Nombre_Equipo') is-invalid @enderror"
                                                id="Nombre_Equipo" wire:model.live="Nombre_Equipo"
                                                placeholder="Ingrese el Nombre_Equipo" />


                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="Usuario_Red" class="form-label">
                                                            Usuario Red
                                                        </label>
                                                        <input type="text"
                                                            class="form-control @error('Usuario_Red') is-invalid @enderror"
                                                            id="Usuario_Red" wire:model.live="Usuario_Red"
                                                            placeholder="Ingrese su Usuario_Red" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="Procesador" class="form-label">
                                                            Procesador
                                                        </label>
                                                        <input type="text"
                                                            class="form-control @error('Procesador') is-invalid @enderror"
                                                            id="Procesador" wire:model.live="Procesador"
                                                            placeholder="Ingrese el Procesador" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="Memoria" class="form-label">
                                                            Memoria
                                                        </label>
                                                        <input type="text"
                                                            class="form-control @error('Memoria') is-invalid @enderror"
                                                            id="Memoria" wire:model.live="Memoria"
                                                            placeholder="Ingrese la Memoria" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="Sistema_Operativo" class="form-label">
                                                            Sistema Operativo
                                                        </label>
                                                        <input type="text"
                                                            class="form-control @error('Sistema_Operativo') is-invalid @enderror"
                                                            id="Sistema_Operativo" wire:model.live="Sistema_Operativo"
                                                            placeholder="Ingrese su Sistema_Operativo" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="mac_dispositivo" class="form-label">
                                                            mac dispositivo
                                                        </label>
                                                        <input type="text"
                                                            class="form-control @error('Mac_Dispositivo') is-invalid @enderror"
                                                            id="Mac_Dispositivo" wire:model.live="Mac_Dispositivo"
                                                            placeholder=" Ingrese su Mac_Dispositivo" />
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        {{-- modal para Area --}}
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="Nombre" class="form-label required">
                                    Nombre Del Area
                                </label>
                                <select class="form-select @error('nombre') is-invalid @enderror" id="nombre"
                                    wire:model.live="nombre">
                                    <option value="">Seleccione una are</option>
                                    <option>
                                        <h5>
                                            Area 1
                                        </h5>
                                    </option>
                                    <option>
                                        <h5>
                                            Area 2
                                        </h5>
                                    </option>
                                    <option>
                                        <h5>
                                            Area 3
                                        </h5>
                                    </option>
                                </select>
                            </div>
                        </div>
                        {{-- Modal Para asignar IP --}}
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="Nombre" class="form-label required">
                                    Sleccione una IP
                                </label>
                                <select class="form-select @error('nombre') is-invalid @enderror" id="nombre"
                                    wire:model.live="nombre">
                                    <option value="">Escoja una de las IPS</option>
                                    <option>
                                        <from autocomplete="off" novalidate wire:submit.prevent="asignar_ip">
                                            <div class="modal-body">
                                                <!-- error si intentas crear un campo vacio-->
                                                @if (session()->has('error'))
                                                <div class="alert alert-danger">
                                                    {{ session ('error') }}
                                                </div>
                                                @endif
                                                <div class="mb-3">
                                                    <button type="button" class="btn btn-primary"
                                                        wire:click="filtrarIps('172.16.0.1')">IP 72.16.0.*</button>
                                                    <button type="button" class="btn btn-primary"
                                                        wire:click="filtrarIps('172.16.0.2')">IP 72.16.1.*</button>
                                                    <button type="button" class="btn btn-primary"
                                                        wire:click="filtrarIps('172.16.0.3')">IP 72.16.2.*</button>
                                                    <button type="button" class="btn btn-primary"
                                                        wire:click="filtrarIps('172.16.0.4')">IP 72.16.3.*</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @php
                                                    $collection = collect($filtrar_Ips);
                                                    $chunks = $collection->chunk(35);
                                                @endphp
                                                @foreach($ips as $ip)
                                                    <div class="col-md-6">
                                                        @foreach ($ips as $ips )
                                                            <label>
                                                                <input type="checkbox" wire:model="selectedPermisos.{{ $ip->id }}">
                                                                {{ $ip->ip}}
                                                                <button type="submit" class="btn btn-cyan ms-auto">
                                                                    {{ $button_VerIps}}
                                                                </button    >
                                                            </label>
                                                        @endforeach

                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        </form>
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
