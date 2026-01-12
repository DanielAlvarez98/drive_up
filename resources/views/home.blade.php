@extends('layouts.app')

@section('content')
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}


    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                @include('layouts.structure.estadisticas')

                <div class="row">
                    <div class="card">
                        {{-- <div class="card-header">
                                <h4>Mis Vehículos</h4>
                                <div class="container bg-body-tertiary py-3">
                                    <div id="testimonialCarousel" class="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($cars as $car)
                                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                    <div class="card card_carrusel shadow-sm rounded-3 p-2">
                                                        <div class="quotes display-2 text-body-tertiary">
                                                            <i class="bi bi-quote"></i>
                                                        </div>
                                                        <div class="card-body">

                                                            <a href="{{ route('car.show', $car->id) }}">
                                                                <img class="img_carrusel"
                                                                    src="{{ asset('storage/' . $car->imagen) }}"
                                                                    alt="">
                                                            </a>
                                                            <div class="d-flex align-items-center pt-4">
                                                                <div>
                                                                    <h5 class="card-title fw-bold">{{ $car->marca }}
                                                                    </h5>
                                                                    <span class="text-secondary">Placa:
                                                                        {{ $car->placa }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <a class="carousel-control-prev" type="button" href="#testimonialCarousel"
                                            data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                        <a class="carousel-control-next" role="button" href="#testimonialCarousel"
                                            data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </a>

                                    </div>
                                    @if ($cars->count())
                                        <div class="px-4">
                                            <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>ver
                                                todos</button>
                                        </div>
                                    @else
                                        <div class="px-4">
                                            No tiene vehículos registrados
                                        </div>
                                    @endif

                                </div>
                            </div> --}}


                        <div class="card-header">
                            <h4>Mis vehículos</h4>
                        </div>
                        <div class="card-body">


                            @forelse ($cars as $car)
                                <a href="{{ route('car.show', $car['id']) }}" class="text-decoration-none">
                                    <div
                                        class="mb-2 d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3
            p-sm-4  p-4 border rounded-3 border-secondary-subtle">

                                        <img src="{{ asset('storage/' . $car['imagen']) }}" alt="Nuevo S-Presso"
                                            class="flex-shrink-0 rounded object-fit-contain"
                                            style="width: 64px; height: 48px;">

                                        <div class="flex-grow-1 min-w-0">
                                            <h6 class="text-dark mb-1 text-truncate">{{ $car['marca'] }}</h6>
                                            <small class="text-secondary">Placa: {{ $car['placa'] }}</small>
                                        </div>
                                        <div class="d-flex flex-column flex-md-row gap-2 justify-content-md-end ms-md-auto w-100 w-md-auto">

                                            @if (empty($car['alerts']))
                                                <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                                                    Al día
                                                </span>
                                            @else
                                                @foreach ($car['alerts'] as $alert)
                                                    <span class="badge rounded-pill {{ $alert['icon'] }} px-3 py-2">
                                                        {{ $alert['title'] }} </span>
                                                @endforeach
                                            @endif
                                        </div>

                                    </div>
                                </a>
                            @empty
                                @if ($cars->count())
                                    <div class="px-4">
                                        No tiene vehículos registrados
                                    </div>
                                @endif
                            @endforelse

                            <div class="px-4">
                                <a href="{{ route('car.index') }}"
                                    class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>
                                    + Agregar nuevo vehículo</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.structure.recordatorios')
        </section>
    @endsection
