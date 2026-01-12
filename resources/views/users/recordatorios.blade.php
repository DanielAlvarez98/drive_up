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
        <h3>Mi Recordatorios</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                                 @include('layouts.structure.estadisticas')

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @forelse ($cars as $car)
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="primero-tab"
                                                data-bs-toggle="tab" href="#car{{ $car['id'] }}" role="tab"
                                                aria-controls="primero" aria-selected="true">
                                                {{ $car['marca'] }}</a>
                                        </li>
                                    @empty

                                        No tiene autos registrados
                                    @endforelse

                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    @forelse ($cars as $car)
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                            id="car{{ $car['id'] }}" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12 col-xl-6">
                                                    <div class="card">

                                                        <div class="card-header">
                                                            <h4>Notificaciones</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            @if (empty($car['alerts']))
                                                                <div class="alert alert-primary">
                                                                    <i class="bi bi-check-circle"></i>
                                                                    Documentación y mantenimientos al día
                                                                </div>
                                                            @else
                                                                @foreach ($car['alerts'] as $alert)
                                                                    <div class="alert alert-{{ $alert['type'] }}">
                                                                        <i class="bi {{ $alert['icon'] }}"></i>
                                                                        <strong>{{ $alert['title'] }}</strong><br>
                                                                        {{ $alert['text'] }} {{ $alert['days'] }} días
                                                                    </div>
                                                                @endforeach
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 shadow-sm p-3 calendar"
                                                    data-events='@json($car['alerts'])'>

                                                    <h5 class="text-center fw-bold mb-3 monthYear"></h5>

                                                    <div class="calendar-grid text-center">
                                                        <div class="fw-semibold text-muted">DOM</div>
                                                        <div class="fw-semibold text-muted">LUN</div>
                                                        <div class="fw-semibold text-muted">MAR</div>
                                                        <div class="fw-semibold text-muted">MIE</div>
                                                        <div class="fw-semibold text-muted">JUE</div>
                                                        <div class="fw-semibold text-muted">VIE</div>
                                                        <div class="fw-semibold text-muted">SAB</div>
                                                    </div>

                                                    <div class="calendar-grid text-center calendarDays"></div>
                                                </div>


                                            </div>
                                        </div>
                                    @empty
                                        Nada registrado
                                    @endforelse

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
        @vite(['resources/assets/css/client/calendar.css'])
        @vite(['resources/assets/js/client/calendar.js'])
    @endsection
