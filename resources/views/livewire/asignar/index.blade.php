<div>
    <div class="page-header d-print-none animate_animated animatefadeIn animate_faster">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Asignar</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title text-uppercase">
                        Asignar
                    </h2>
                </div>

            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="alert alert-info bg-info-lt m-0 mb-3 fw-bold animate_animated animatefadeIn animate_faster">
                    A continuación se muestra la lista de los Cargos registrados en el sistema.
                </div>
                <div class="page-body">
                    <div class="container-xl">
                        <!-- Row para los cards -->
                        <div>
                            <h1>Áreas y sus IPs Asignadas</h1>
                            <div class="row">
                                @foreach ($areas as $area)
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div
                                                class="ribbon ribbon-top {{ $area->is_active ? 'bg-green' : 'bg-red' }}">
                                                @if ($area->is_active)
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M5 12l5 5l10 -10" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M18 6l-12 12" />
                                                        <path d="M6 6l12 12" />
                                                    </svg>
                                                @endif
                                            </div>

                                            <div class="card-header">
                                                <strong>{{ $area->name }}</strong>
                                            </div>
                                            <div class="card-body">
                                                <p>Ip Inicio: {{ $area->ip_inicio }}</p>
                                                <p>Ip Fin: {{ $area->ip_fin }}</p>
                                                <p>Total de IPs asignadas: {{ $area->ips->count() }}</p>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-outline-azure"
                                                        data-bs-toggle="modal" data-bs-target="#modal-asig"
                                                        wire:click="loadIps({{ $area->id }})">
                                                        asignar
                                            </button>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal fade modal-blur" id="modal-asig" tabindex="-1" wire:ignore.self>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    IP
                                </h5>
                            </div>
                            @if ($selectedIps)
                                <ul>
                                    @foreach ($selectedIps as $ip)
                                        <li>{{ $ip->ip }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No hay IPs asignadas a esta área.</p>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-square" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
