@extends('layouts.app')

@section('content')

    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                @include('layouts.structure.estadisticas')

                <div class="row">
                    <div class="card">

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
                                        <div
                                            class="d-flex flex-column flex-md-row gap-2 justify-content-md-end ms-md-auto w-90 w-md-auto">

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
                    <div class="card">

                        <div class="card-header">
                            <h4>Mantenimientos Recientes</h4>
                        </div>
                        <div class="card-body">

                            @forelse ($mants as $mant)
                                <div
                                    class="mb-2 d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3
            p-sm-4  p-4 border rounded-3 " style="background-color: rgb(248, 250, 252); border-color: rgb(226, 232, 240);">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path
                                            d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.106-3.105c.32-.322.863-.22.983.218a6 6 0 0 1-8.259 7.057l-7.91 7.91a1 1 0 0 1-2.999-3l7.91-7.91a6 6 0 0 1 7.057-8.259c.438.12.54.662.219.984z">
                                        </path>
                                    </svg>

                                    <div class="flex-grow-1 min-w-0">
                                        <h6 class="text-dark mb-1 text-truncate">{{ $mant->name }}</h6>
                                        <small class="text-secondary">{{ $mant->car->placa }} •
                                            {{ $mant->fecRenov }}</small>
                                    </div>
                                    <div
                                        class="d-flex flex-column flex-md-row gap-2 justify-content-md-end ms-md-auto w-90 w-md-auto">

                                        <span class="badge rounded-pill text-success px-3 py-2">
                                            S/. {{ $mant->price }} </span>

                                    </div>

                                </div>
                            @empty
                                @if ($mants->count())
                                    <div class="px-4">
                                        No tiene mantenimientos recientes
                                    </div>
                                @endif
                            @endforelse



                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.structure.recordatorios')
        </section>
    @endsection
