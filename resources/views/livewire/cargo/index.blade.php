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
                                    <tbody>
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
                    <div class="row">
                        @foreach($ips as $ip)
                            <div class="col-md-6">
                                <label>
                                    <input type="checkbox" wire:model="selectedPermisos.{{ $ip->id }}">
                                    {{ $ip->ip}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                </form>
            </div>
        </div>
        {{-- modal asigarn --}}
    </div>
    </div>
