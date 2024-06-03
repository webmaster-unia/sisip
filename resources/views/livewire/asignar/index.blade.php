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
                                    <h3 class="card-title">{{ $area }}</h3>
                                </div>
                                    <div class="card-body">
                                        <p class="text-secondary">This is some text within a card body.</p>
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
                <div class="page-body">
                    <div class="container-xl">
                        <div class="row">
                            @foreach($cargos as $cargo)
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $cargo->name_cargo }}</h3>
                                </div>
                                    <div class="card-body">
                                        <ul>
                                            @foreach ($cargo->areas as $cargo)
                                            <li>{{ $cargos->areas }}</li>
                                            <p>Total de Cargos {{ $cargos->areas->count()}}</p>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ $cargo->area_ip }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <ul>
                                                    @foreach ($cargo->area_ip as $cargo)
                                                    <li>{{ $cargos->area_ip }}</li>
                                                    <p>Total de Cargos {{ $cargos->area_ip->count()}}</p>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
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
