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


    <div class="page-heading">
        <h3>Mi Vehiculos</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                @include('layouts.structure.estadisticas')

                <div class="row">
                    <div class="col-12 col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Notificaciones</h4>
                            </div>
                            <div class="card-body">
                                @if (count($alerts))
                                    @foreach ($alerts as $alert)
                                        <div class="alert alert-{{ $alert['type'] }}">
                                            <h6> <i class="bi {{ $alert['icon'] }}"></i> {{ $alert['title'] }}</h6>
                                            <p>{{ $alert['text'] }} {{ $alert['days'] }} días</p>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-primary">
                                        <h6> <i class="bi bi-check Heading"></i>Documentacion y mantenimientos al dia</h6>
                                        <p>No tienes pendientes</p>
                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>
                    <div class="col-md-4 col-sm-8">
                        <div class="card">
                            <div class="card-content">
                                <img class=" m-2 img-fluid" src="{{ asset('storage/' . $car->imagen) }}"
                                    alt="Card image cap" height="300px" width="320px">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h5 class="card-title fw-bold">{{ $car->marca }}
                                            </h5>
                                            <div class="d-flex align-items-center">
                                                <span class="text-secondary">Placa:
                                                    {{ $car->placa }}</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="text-secondary">Año Fabricacion:
                                                    {{ $car->anhoFab }}</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="text-secondary">Kilometraje:
                                                    {{ $car->km }}km</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="text-secondary">Modelo:
                                                    {{ $car->modelo }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.structure.recordatorios')

        </section>
    @endsection
    @section('extra_resource')
        @vite(['resources/assets/css/vendors/dripicons/webfont.css'])
        @vite(['resources/assets/css/client/dripicons.css'])
    @endsection
