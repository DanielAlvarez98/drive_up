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
                                <div class="mb-2 d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3
            p-sm-4  p-4 border rounded-3 "
                                    style="background-color: rgb(248, 250, 252); border-color: rgb(226, 232, 240);">

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

        {{-- modal instrucciones --}}
        <div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="exampleModalScrollableTitle"
            style="display: none; padding-right: 15px;" aria-modal="true" role="dialog">
            <div class="modal-dialog  modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="position-relative text-white p-4 p-lg-5"
                        style="background: linear-gradient(90deg,#2563eb,#1d4ed8);">

                        <button type="button" class=" btn-close position-absolute top-0 end-0 m-3 text-white border-0"
                            data-bs-dismiss="modal"></button>

                        </button>

                        <div class="d-flex align-items-center gap-3 mb-3">

                            <div class="d-flex align-items-start justify-content-between mb-4">
                                <div class=" p-3 rounded-4" style="background-color: #fff3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                        <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9
                                                                 C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3
                                                                 c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9
                                                                 l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path>
                                        <circle cx="7" cy="17" r="2"></circle>
                                        <path d="M9 17h6"></path>
                                        <circle cx="17" cy="17" r="2"></circle>
                                    </svg>
                                </div>
                            </div>

                            <span class="fs-3 fw-semibold">DRIVE UP</span>
                        </div>

                        <p class="mb-2 text-white">¡Bienvenido, {{ auth()->user()->name }}!</p>
                        <p class="mb-0 text-white">
                            Estamos encantados de tenerte aquí. Descubre todo lo que puedes hacer con DRIVE UP.
                        </p>
                    </div>
                    <div class="modal-body">
                        <div class="p-4 p-lg-5">

                            <h4 class="mb-4 text-dark">Comienza con estos pasos</h4>

                            <!-- PASO 1 -->
                            <div class="d-flex gap-3 mb-4">
                                <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-3"
                                    style="width:48px;height:48px;background:#dbeafe;color:#2563eb;">
                                    <strong>1</strong>
                                </div>

                                <div>
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                                            <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9
                                                             C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3
                                                             c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9
                                                             l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path>
                                            <circle cx="7" cy="17" r="2"></circle>
                                            <path d="M9 17h6"></path>
                                            <circle cx="17" cy="17" r="2"></circle>
                                        </svg>
                                        <h6 class="mb-0 text-dark">Registra tus vehículos</h6>
                                    </div>
                                    <p class="text-muted mb-0">
                                        Añade información de tus vehículos incluyendo placa, marca, modelo y una foto.
                                    </p>
                                </div>
                            </div>

                            <!-- PASO 2 -->
                            <div class="d-flex gap-3 mb-4">
                                <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-3"
                                    style="width:48px;height:48px;background:#dbeafe;color:#2563eb;">
                                    <strong>2</strong>
                                </div>

                                <div>
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <i class="bi bi-file-earmark-text text-primary"></i>
                                        <h6 class="mb-0 text-dark">Sube tus documentos</h6>
                                    </div>
                                    <p class="text-muted mb-0">
                                        Centraliza SOAT, tarjeta de propiedad, licencia de conducir y otros documentos
                                        importantes.
                                    </p>
                                </div>
                            </div>

                            <!-- PASO 3 -->
                            <div class="d-flex gap-3 mb-4">
                                <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-3"
                                    style="width:48px;height:48px;background:#dbeafe;color:#2563eb;">
                                    <strong>3</strong>
                                </div>

                                <div>
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <i class="bi bi-wrench text-primary"></i>
                                        <h6 class="mb-0 text-dark">Registra mantenimientos</h6>
                                    </div>
                                    <p class="text-muted mb-0">
                                        Mantén un historial completo de todos los mantenimientos y reparaciones de tus
                                        vehículos.
                                    </p>
                                </div>
                            </div>

                            <!-- PASO 4 -->
                            <div class="d-flex gap-3">
                                <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-3"
                                    style="width:48px;height:48px;background:#dbeafe;color:#2563eb;">
                                    <strong>4</strong>
                                </div>

                                <div>
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <i class="bi bi-bell text-primary"></i>
                                        <h6 class="mb-0 text-dark">Configura recordatorios</h6>
                                    </div>
                                    <p class="text-muted mb-0">
                                        Recibe alertas automáticas sobre vencimientos de documentos y mantenimientos
                                        programados.
                                    </p>
                                </div>
                            </div>

                            <!-- TIP -->
                            <div class="mt-4 pt-4 border-top">
                                <div class="p-3 rounded-3" style="background:#eff6ff;border:1px solid #bfdbfe;">
                                    <p class="mb-1 text-primary">
                                        💡 <strong>Tip:</strong> Comienza completando tu perfil y agregando tu primer
                                        vehículo
                                    </p>
                                    <p class="mb-0 text-primary-emphasis">
                                        Podrás acceder a todas las funciones desde el menú lateral en cualquier momento.
                                    </p>
                                </div>
                            </div>

                            <!-- BOTÓN -->
                            <div class="text-end mt-4">
                                <button class="btn text-white" data-bs-dismiss="modal" style="background:#2563eb;">
                                    Comenzar a usar DRIVE UP
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (auth()->user()->plan == 0)
            @section('extra_resource')
                <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js') }}"></script>

                @vite(['resources/assets/js/client/home.js'])
            @endsection
        @endif


    @endsection
    {{-- @section('extra_resource')
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js') }}"></script>

    @endsection --}}
