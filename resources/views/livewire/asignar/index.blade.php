<div>
    <div class="page-header d-print-none animate__animated animate__fadeIn animate__faster">
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
                <div
                    class="alert alert-info bg-info-lt m-0 mb-3 fw-bold animate__animated animate__fadeIn animate__faster">
                    A continuación se muestra la lista de los Cargos registrados en el sistema.
                </div>
                <div class="page-body">
                    <div class="container-xl">
                        <!-- Row para los cards -->
                        <div>
                            <h1>Áreas y sus IPs Asignadas</h1>
                            <div class="row">
                                @foreach($areas as $area)
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="ribbon ribbon-top {{ $area->is_active ? 'bg-green' : 'bg-red' }}">
                                                @if ($area->is_active)
                                                    <!-- Ícono de slash si está activo -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M4 8l12 12"></path>
                                                    </svg>
                                                @else
                                                    <!-- Ícono de x si está inactivo -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
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
                                            <a href="#" class="btn btn-square">
                                                Detalles
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
