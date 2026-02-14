@extends('layouts.app')


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Mantenimientos</h3>
                    {{-- <p class="text-subtitle text-muted">For user to check they list</p> --}}
                </div>
                {{-- <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Table</li>
                        </ol>
                    </nav>
                </div> --}}
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="row">
                <div class="col-12 col-md-8">
                    {{-- <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="todos-tab" data-bs-toggle="tab" href="#todos"
                                        role="tab" aria-controls="todos" aria-selected="true">Todos</a>
                                </li>
                                @foreach ($carMants as $carMant)
                                    @php $car = $carMant->first()->car; @endphp

                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="car-{{ $car->id }}-tab" data-bs-toggle="tab"
                                            href="#car-{{ $car->id }}" role="tab">
                                            {{ $car->marca }}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="todos" role="tabpanel"
                                        aria-labelledby="todos-tab">
                                        <div id="testimonialCarousel" class="carousel">
                                            <div class="carousel-inner tab-pane fade active show" id="todos"
                                                role="tabpanel" aria-labelledby="profile-tab">
                                                @foreach ($maintenances as $maintenance)
                                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                        <div class="card card_carrusel shadow-sm rounded-3 p-2">
                                                            <div class="quotes display-2 text-body-tertiary">
                                                                <i class="bi bi-quote"></i>
                                                            </div>
                                                            <div class="card-body">
                                                                <div style="text-align: center">
                                                                    <img class="img_carrusel "style="height: 90px;"
                                                                        src="{{ asset('storage/' . $maintenance->imagen) }}"
                                                                        alt="">
                                                                </div>
                                                                <button type="button" class="icon dripicons-document-edit"
                                                                    style="color: green; border:none" data-bs-toggle="modal"
                                                                    data-bs-target="#editMantModal"
                                                                    data-url='{{ route('mant.update', $maintenance) }}'
                                                                    data-send="{{ route('mant.ajax', $maintenance) }}"
                                                                    enctype="multipart/form-data">
                                                                </button>
                                                                <form class="alertDelete" method="POST"
                                                                    action="{{ route('mant.destroy', $maintenance->id) }}"
                                                                    accept-charset="UTF-8" style="display:inline">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="icon dripicons-document-delete"
                                                                        style="color: red;border:none">
                                                                    </button>
                                                                </form>
                                                                <div class="d-flex align-items-center pt-4">
                                                                    <div>
                                                                        <h5 class="card-title fw-bold">
                                                                            {{ $maintenance->name }}
                                                                        </h5>
                                                                        <div class="d-flex align-items-center">

                                                                            <span class="text-secondary fw-bold">Placa:
                                                                                {{ $maintenance->car->placa }}</span>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">

                                                                            <span class="text-secondary fw-bold">Marca:
                                                                                {{ $maintenance->marca }}</span>
                                                                        </div>

                                                                        @if ($maintenance->numero)
                                                                            <div class="d-flex align-items-center">

                                                                                <span class="text-secondary fw-bold">N °:
                                                                                    {{ $maintenance->numero }}</span>
                                                                            </div>
                                                                        @endif
                                                                        <div class="d-flex align-items-center">

                                                                            <span class="text-secondary fw-bold">Precio: S/
                                                                                {{ $maintenance->price }}</span>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="text-secondary fw-bold">F mant:
                                                                                {{ $maintenance->fecEmit }}</span>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="text-secondary fw-bold">F
                                                                                renovación:
                                                                                {{ $maintenance->fecRenov }}</span>
                                                                        </div>
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
                                            @if ($maintenances->isEmpty())
                                                <div class="px-4">
                                                    No tiene mantenimientos registrados
                                                </div>
                                            @endif


                                        </div>
                                    </div>
                                    @foreach ($carMants as $carMant)
                                        @php $car = $carMant->first()->car; @endphp
                                        <div class="tab-pane fade {{ $loop->first ? 'show' : '' }}"
                                            id="car-{{ $car->id }}" role="tabpanel">

                                            <div id="carousel-{{ $car->id }}" class="carousel">
                                                <div class="carousel-inner">
                                                    @foreach ($carMant as $maintenance)
                                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                            <div class="card card_carrusel shadow-sm rounded-3 p-2">
                                                                <div class="quotes display-2 text-body-tertiary">
                                                                    <i class="bi bi-quote"></i>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div style="text-align: center">
                                                                        <img class="img_carrusel "style="height: 90px;"
                                                                            src="{{ asset('storage/' . $maintenance->imagen) }}"
                                                                            alt="">
                                                                    </div>
                                                                    <button type="button"
                                                                        class="icon dripicons-document-edit"
                                                                        style="color: green; border:none"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editMantModal"
                                                                        data-url='{{ route('mant.update', $maintenance) }}'
                                                                        data-send="{{ route('mant.ajax', $maintenance) }}"
                                                                        enctype="multipart/form-data">
                                                                    </button>
                                                                    <form class="alertDelete" method="POST"
                                                                        action="{{ route('mant.destroy', parameters: $maintenance->id) }}"
                                                                        accept-charset="UTF-8" style="display:inline">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="icon dripicons-document-delete"
                                                                            style="color: red;border:none">
                                                                        </button>
                                                                    </form>
                                                                    <div class="d-flex align-items-center pt-4">
                                                                        <div>
                                                                            <h5 class="card-title fw-bold">
                                                                                {{ $maintenance->name }}
                                                                            </h5>
                                                                            <div class="d-flex align-items-center">

                                                                                <span class="text-secondary fw-bold">Placa:
                                                                                    {{ $maintenance->car->placa }}</span>
                                                                            </div>
                                                                            <div class="d-flex align-items-center">

                                                                                <span class="text-secondary fw-bold">Marca:
                                                                                    {{ $maintenance->marca }}</span>
                                                                            </div>

                                                                            @if ($maintenance->numero)
                                                                                <div class="d-flex align-items-center">

                                                                                    <span
                                                                                        class="text-secondary fw-bold">N°:
                                                                                        {{ $maintenance->numero }}</span>
                                                                                </div>
                                                                            @endif
                                                                          <div class="d-flex align-items-center">

                                                                            <span class="text-secondary fw-bold">Precio: S/
                                                                                {{ $maintenance->price }}</span>
                                                                        </div>

                                                                            <div class="d-flex align-items-center">
                                                                                <span class="text-secondary fw-bold">F
                                                                                    mant:
                                                                                    {{ $maintenance->fecEmit }}</span>
                                                                            </div>
                                                                            <div class="d-flex align-items-center">
                                                                                <span class="text-secondary fw-bold">F
                                                                                    renovación:
                                                                                    {{ $maintenance->fecRenov }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
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
                                    @endforeach


                                </div>


                            </div>
                        </div>
                    </div> --}}
                    <div class="accordion" id="accordionExample">

                        @forelse ($carMants as $car)
                            @php
                                $totalGastado = $car->maintenances->sum('price');
                            @endphp
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#{{ $car->id }}" aria-expanded="false"
                                        aria-controls="collapseOne">
                                        <div class="p-3 bg-opacity-10 rounded">
                                            <i class="bi bi-wrench text-primary fs-4"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 text-dark">Vehiculo {{ $car->placa }}</h6>

                                            <div class="d-flex flex-wrap gap-3 small text-muted">

                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="bi bi-file-text"></i>
                                                    <span>{{ $car->maintenances->count() }}</span>
                                                </div>

                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="bi bi-currency-dollar"></i>
                                                    <span> S/. {{ number_format($totalGastado, 2) }}
                                                    </span>
                                                </div>

                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="bi bi-clock"></i>
                                                    <span>{{ $car->maintenances->first()->fecEmit }}</span>
                                                </div>

                                            </div>
                                    </button>
                                </h2>
                                <div id="{{ $car->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                    <div class="accordion-body">
                                        @foreach ($car->maintenances as $mant)
                                            <div class="card-body">

                                                <div class="position-relative">

                                                    <!-- línea vertical -->
                                                    <div class="position-absolute top-0 start-0 ms-4 h-100 border-start">
                                                    </div>

                                                    <!-- ITEM TIMELINE -->
                                                    <div class="d-flex gap-3 position-relative">
                                                        <!-- Icono timeline -->
                                                        <i class="bi bi-wrench "
                                                            style="color: oklch(.558 .288 302.321)"></i>
                                                        <!-- Card mantenimiento -->
                                                        <div class=" flex-grow-1 shadow-sm">

                                                            <div class="card-body">

                                                                <div
                                                                    class="d-flex justify-content-between flex-wrap gap-2 mb-2">

                                                                    <div>
                                                                        <h6 class="mb-1">{{ $mant->name }}</h6>

                                                                        <div
                                                                            class="d-flex flex-wrap gap-3 small text-muted">
                                                                            <span><i class="bi bi-calendar"></i>
                                                                                {{ $mant->fecEmit }}</span>
                                                                            <span><i class="bi bi-speedometer2"></i>
                                                                                {{ $mant->km }}</span>

                                                                        </div>
                                                                    </div>

                                                                    <div class="text-end">
                                                                        <div class="text-primary">S/.  {{ $mant->price }}</div>

                                                                        <div class="mt-1">
                                                                            <button
                                                                                class="btn btn-sm btn-light text-primary"data-bs-toggle="modal"
                                                                                data-bs-target="#editMantModal"
                                                                                data-url='{{ route('mant.update', $mant) }}'
                                                                                data-send="{{ route('mant.ajax', $mant) }}"
                                                                                enctype="multipart/form-data">
                                                                                <i class="bi bi-pencil"></i>
                                                                            </button>

                                                                            <form class="alertDelete" method="POST"
                                                                                action="{{ route('mant.destroy', $mant->id) }}"
                                                                                accept-charset="UTF-8"
                                                                                style="display:inline">
                                                                                @method('DELETE')
                                                                                @csrf
                                                                                <button
                                                                                    class="btn btn-sm btn-light text-danger">
                                                                                    <i class="bi bi-trash"></i>
                                                                                </button>
                                                                            </form>

                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="border-top pt-2 small text-muted">
                                                                    {{ $mant->marca }} {{ $mant->numero ?? '--' }}
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            </div>

                        @empty
                        @endforelse

                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card">

                        <div class="card-content">
                            <div class="card-body">
                                <div class="col-12">
                                    <h4 class="card-title">Registro</h4>
                                </div>
                                <form class="form form-vertical" role="form" id="createMantForm" method="POST"
                                    action="{{ route(name: 'mant.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">Nombre</label>
                                                    <input type="text" id="name" class="form-control" name="name"
                                                        placeholder="Nombre" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">Marca</label>
                                                    <input type="text" id="marca" class="form-control" name="marca"
                                                        placeholder="Marca" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">N°</label>
                                                    <input type="number" id="numero" class="form-control"
                                                        name="numero" placeholder="N°">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Precio</label>
                                                    <input type="number" id="price" class="form-control"
                                                        name="price" placeholder="Precio">
                                                </div>
                                            </div>
                                                 <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">KM</label>
                                                    <input type="number" id="km" class="form-control"
                                                        name="km" placeholder="Kilometro">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Auto</label>
                                                    <select class="form-select" id="basicSelect" name="car_id" required>
                                                        <option value="" selected disabled>Auto</option>
                                                        @foreach ($cars as $car)
                                                            <option value="{{ $car->id }}">{{ $car->marca }}
                                                                ||
                                                                {{ $car->placa }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="password-vertical">Fecha de mantenimiento</label>
                                                    <input type="date" id="dfecEmit" class="form-control"
                                                        max="{{ date('Y-m-d') }}" name="fecEmit" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="password-vertical">Fecha de renovacion</label>
                                                    <input type="date" id="dfecRenov" class="form-control"
                                                        min="{{ date('Y-m-d') }}" name="fecRenov" required>
                                                </div>
                                            </div>
                                            {{-- <div class="col-12">
                                                <div class="filepond--root image-preview-create filepond--hopper"
                                                    data-style-button-remove-item-position="left"
                                                    data-style-button-process-item-position="right"
                                                    data-style-load-indicator-position="right"
                                                    data-style-progress-indicator-position="right"
                                                    data-style-button-remove-item-align="false" style="height: 76px;">
                                                    <input class="filepond--browser" type="file" name="imagen"
                                                        required id="filepond--browser-8447r0jza"
                                                        aria-controls="filepond--assistant-8447r0jza"
                                                        aria-labelledby="filepond--drop-label-8447r0jza"
                                                        accept="image/png,image/jpg,image/jpeg">
                                                    <div class="filepond--drop-label"
                                                        style="transform: translate3d(0px, 0px, 0px); opacity: 1;"><label
                                                            for="filepond--browser-8447r0jza"
                                                            id="filepond--drop-label-8447r0jza">Drag &amp; Drop your files
                                                            or <span class="filepond--label-action"
                                                                tabindex="0">Browse</span></label></div>
                                                    <div class="filepond--list-scroller"
                                                        style="transform: translate3d(0px, 0px, 0px);">
                                                        <ul class="filepond--list" role="list"></ul>
                                                    </div>
                                                    <div class="filepond--panel filepond--panel-root"
                                                        data-scalable="true">
                                                        <div class="filepond--panel-top filepond--panel-root"></div>
                                                        <div class="filepond--panel-center filepond--panel-root"
                                                            style="transform: translate3d(0px, 8px, 0px) scale3d(1, 0.6, 1);">
                                                        </div>
                                                        <div class="filepond--panel-bottom filepond--panel-root"
                                                            style="transform: translate3d(0px, 68px, 0px);"></div>
                                                    </div><span class="filepond--assistant"
                                                        id="filepond--assistant-8447r0jza" role="alert"
                                                        aria-live="polite" aria-relevant="additions"></span>
                                                    <div class="filepond--drip"></div>
                                                    <fieldset class="filepond--data">
                                                        <legend>Files</legend>
                                                    </fieldset>
                                                </div>
                                            </div> --}}
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('users.modalMant.edit')

    </div>
@endsection
@section('extra_resource')
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>

    @vite(['resources/assets/css/vendors/dripicons/webfont.css'])
    @vite(['resources/assets/css/client/dripicons.css'])
    @vite(['resources/assets/js/client/mant.js'])
@endsection
