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
                        <div class="row">
                            <!-- Card 1 -->
                            @foreach($areas as $area)
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $area->name }}</h3>
                                </div>
                                    <div class="card-body">
                                        <ul>
                                            <p>Cantidad de IPS: {{ $area->cantidad }}</p>
                                            <p>Ip inicio: {{ $area->ip_inicio }}</p>
                                            <p>Ip fin: {{ $area->ip_fin }}</p>
                                            <p>Estado: {{ $area->is_active }}</p>
                                        </ul>
                                        <p>Total de IPs asignadas: {{ $area->ips->count() }}</p>
                                    </div>
                                    <button type="button" class="btn btn-square"
                                        data-bs-toggle="modal" data-bs-target="#modal-asig"
                                        wire:click="#">
                                        Detalles
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!--modal detalles -->
                <div class="modal fade" id="modal-asig" tabindex="-1" role="dialog" aria-labelledby="cargoModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cargoModalLabel">Cargos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
