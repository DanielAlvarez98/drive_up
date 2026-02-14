@extends('layouts.app')


@section('content')
    @php

        use Carbon\Carbon;

        // false permite negativos

    @endphp

    <div class="page-heading">
        <div class="row mb-4">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="border rounded-4 p-4 shadow-sm 
            hover-shadow transition">

                    <p class="small mb-1">
                        Total documentos
                    </p>
                    <p class="  fs-3 mb-1">
                        {{ $totalDocuments }}
                    </p>

                </div>

            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class=" border rounded-4 p-4 shadow-sm 
            hover-shadow transition"
                    style="background-color: oklch(0.98 0.02 156.74)">

                    <p class="small mb-1" style="color: oklch(.527 .154 150.069)">
                        Vigentes
                    </p>
                    <p class="  fs-3 mb-1">
                        {{ $vigentes }}

                    </p>

                </div>

            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class=" border rounded-4 p-4 shadow-sm 
            hover-shadow transition"
                    style="background-color: oklch(.987 .026 102.212)">

                    <p class="small mb-1" style="color: oklch(.554 .135 66.442)">
                        Por vencer
                    </p>
                    <p class="  fs-3 mb-1">
                        {{ $porVencer }}
                    </p>

                </div>

            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class=" border rounded-4 p-4 shadow-sm 
            hover-shadow transition"
                    style="background-color: oklch(.971 .013 17.38)">

                    <p class="small mb-1" style="color: oklch(.505 .213 27.518)">
                        Vencidos
                    </p>
                    <p class="  fs-3 mb-1">
                        {{ $vencidos }}
                    </p>

                </div>

            </div>
        </div>
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Documentos</h3>
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
            <div class="row" id="basic-table">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Lista de Documentos</h4>
                        </div>
                        <div class="container-fluid">
                            <div class="card-body dataTable-container">
                                <table id="example" class="display">
                                    <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Vehiculo</th>
                                            <th>Fecha de emision</th>
                                            <th>Fecha de vencimiento</th>
                                            <th>Estado</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($documents as $doc)
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="p-2 bg-opacity-10 rounded">
                                                            <i class="bi bi-file-earmark-text-fill"
                                                                style="color: rgb(42, 42, 233)"></i>
                                                        </div>
                                                        <p class="font-bold ms-3 mb-0">{{ $doc->name }}</p>
                                                    </div>
                                                </td>
                                                <td>{{ $doc->car->placa ?? $doc->licen }}</td>
                                                <td>{{ $doc->fecEmit }}</td>
                                                <td>{{ $doc->fecRenov }}</td>
                                                @php
                                                    date_default_timezone_set('America/Lima');
                                                    $hoy = Carbon::today();
                                                    $limit = $hoy->copy()->addDays(7);
                                                    $fecha = Carbon::parse($doc->fecRenov);

                                                @endphp
                                                <td>

                                                    @if ($fecha->isPast())
                                                        <span
                                                            class="badge rounded-pill bg-danger-subtle text-danger px-3 py-2">
                                                            <i class="bi bi-x-circle-fill"></i>
                                                            Vencido
                                                        </span>
                                                    @elseif ($fecha->lte($limit))
                                                        <span
                                                            class="badge rounded-pill bg-warning-subtle text-warning px-3 py-2">
                                                            <i class="bi bi-exclamation-triangle-fill"></i>
                                                            Por vencer
                                                        </span>
                                                    @else
                                                        <span
                                                            class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                                                            <i class="bi bi-check-circle-fill"></i>
                                                            Vigente
                                                        </span>
                                                    @endif
                                                </td>


                                                <td>
                                                    <button type="button" class="icon dripicons-preview "
                                                        style="color: blue; border:none" data-bs-toggle="modal"
                                                        data-bs-target="#viewDoc" data-id="{{ $doc->id }}"
                                                        data-imagen="{{ asset('storage/' . $doc->imagen) }}"></button>
                                                    </button>


                                                    <button type="button" class="icon dripicons-document-edit"
                                                        style="color: green; border:none" data-bs-toggle="modal"
                                                        data-bs-target="#{{ $doc->tipo == '1' ? 'editPerModal' : 'editVehModal' }}"
                                                        data-url='{{ route('doc.update', $doc) }}'
                                                        data-send="{{ route('doc.ajax', $doc) }}"
                                                        enctype="multipart/form-data">
                                                    </button>
                                                    <form class="alertDelete" method="POST"
                                                        action="{{ route('doc.destroy', $doc->id) }}"
                                                        accept-charset="UTF-8" style="display:inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" title="Delete Document"
                                                            class="icon dripicons dripicons-trash"
                                                            style="color: red;border:none">
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <p>No tienes vehiculos registrados</p>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="col-12">
                                    <h4 class="card-title">Registro</h4>
                                </div>
                                <form class="form form-vertical" role="form" id="createDocForm" method="POST"
                                    action="{{ route(name: 'doc.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Tipo de documento</label>
                                                    <select class="form-select" id="tipoDocumento" name="tipo" required>
                                                        <option value="1">Personal</option>
                                                        <option value="2">Vehicular</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">Nombre del documento</label>
                                                    <input type="text" id="dname" class="form-control"
                                                        name="name" placeholder="Nombre" required>
                                                </div>
                                            </div>
                                            <div class="personal">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="contact-info-vertical">N°</label>
                                                        <input type="number" id="dlicen" class="form-control"
                                                            name="licen" placeholder="N°">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="password-vertical">Categoria</label>
                                                        <input type="number" id="dcategoria" class="form-control"
                                                            name="categoria" placeholder="Categoria">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="auto">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="password-vertical">Empresa</label>
                                                        <input type="text" id="dempresa" class="form-control"
                                                            name="empresa" placeholder="Empresa">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="contact-info-vertical">Auto</label>
                                                        <select class="form-select" id="basicSelect" name="car_id"
                                                            required>
                                                            <option selected disabled>Auto</option>
                                                            @foreach ($cars as $car)
                                                                <option value="{{ $car->id }}">{{ $car->marca }}
                                                                    ||
                                                                    {{ $car->placa }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="password-vertical">Fecha de emisión</label>
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
                                            <div class="col-12">
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
                                            </div>
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
        {{-- <section class="section">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="todos-tab" data-bs-toggle="tab" href="#todos"
                                        role="tab" aria-controls="todos" aria-selected="true">Todos</a>
                                </li>
                                @foreach ($carDocs as $carDoc)
                                    @php $car = $carDoc->first()->car; @endphp

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
                                                @foreach ($documents as $document)
                                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                        <div class="card card_carrusel shadow-sm rounded-3 p-2">
                                                            <div class="quotes display-2 text-body-tertiary">
                                                                <i class="bi bi-quote"></i>
                                                            </div>
                                                            <div class="card-body">
                                                                <div style="text-align: center">
                                                                    <img class="img_carrusel "style="height: 90px;"
                                                                        src="{{ asset('storage/' . $document->imagen) }}"
                                                                        alt="">
                                                                </div>
                                                                <button type="button" class="icon dripicons-document-edit"
                                                                    style="color: green; border:none" data-bs-toggle="modal"
                                                                    data-bs-target="#{{ $document->tipo == '1' ? 'editPerModal' : 'editVehModal' }}"
                                                                    data-url='{{ route('doc.update', $document) }}'
                                                                    data-send="{{ route('doc.ajax', $document) }}"
                                                                    enctype="multipart/form-data">
                                                                </button>
                                                                <form class="alertDelete" method="POST"
                                                                    action="{{ route('doc.destroy', $document->id) }}"
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
                                                                        <h5 class="card-title fw-bold">{{ $document->name }}
                                                                        </h5>
                                                                        @if ($document->licen)
                                                                            <div class="d-flex align-items-center">

                                                                                <span class="text-secondary fw-bold">N° :
                                                                                    {{ $document->licen }}</span>
                                                                            </div>
                                                                        @endif
                                                                        @if ($document->categoria)
                                                                            <div class="d-flex align-items-center">

                                                                                <span
                                                                                    class="text-secondary fw-bold">Categoria:
                                                                                    {{ $document->categoria }}</span>
                                                                            </div>
                                                                        @endif
                                                                        @if ($document->car_id)
                                                                            <div class="d-flex align-items-center">

                                                                                <span class="text-secondary fw-bold">Placa:
                                                                                    {{ $document->car->placa }}</span>
                                                                            </div>
                                                                        @endif
                                                                        @if ($document->empresa)
                                                                            <div class="d-flex align-items-center">
                                                                                <span
                                                                                    class="text-secondary fw-bold">Empresa:
                                                                                    {{ $document->empresa }}</span>
                                                                            </div>
                                                                        @endif
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="text-secondary fw-bold">F emision:
                                                                                {{ $document->fecEmit }}</span>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="text-secondary fw-bold">F
                                                                                renovación:
                                                                                {{ $document->fecRenov }}</span>
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
                                            @if ($documents->isEmpty())
                                                <div class="px-4">
                                                    No tiene documentos registrados
                                                </div>
                                            @endif


                                        </div>
                                    </div>
                                    @foreach ($carDocs as $carDocuments)
                                        @php $car = $carDocuments->first()->car; @endphp
                                        <div class="tab-pane fade {{ $loop->first ? 'show' : '' }}"
                                            id="car-{{ $car->id }}" role="tabpanel">

                                            <div id="carousel-{{ $car->id }}" class="carousel">
                                                <div class="carousel-inner">
                                                    @foreach ($carDocuments as $document)
                                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                            <div class="card card_carrusel shadow-sm rounded-3 p-2">
                                                                <div class="quotes display-2 text-body-tertiary">
                                                                    <i class="bi bi-quote"></i>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div style="text-align: center">
                                                                        <img class="img_carrusel "style="height: 90px;"
                                                                            src="{{ asset('storage/' . $document->imagen) }}"
                                                                            alt="">
                                                                    </div>
                                                                    <button type="button"
                                                                        class="icon dripicons-document-edit"
                                                                        style="color: green; border:none"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editVehModal"
                                                                        data-url='{{ route('doc.update', $document) }}'
                                                                        data-send="{{ route('doc.ajax', $document) }}"
                                                                        enctype="multipart/form-data">
                                                                    </button>
                                                                    <form class="alertDelete" method="POST"
                                                                        action="{{ route('doc.destroy', $document->id) }}"
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
                                                                                {{ $document->name }}
                                                                            </h5>
                                                                            @if ($document->licen)
                                                                                <div class="d-flex align-items-center">

                                                                                    <span class="text-secondary fw-bold">N°
                                                                                        :
                                                                                        {{ $document->licen }}</span>
                                                                                </div>
                                                                            @endif
                                                                            @if ($document->categoria)
                                                                                <div class="d-flex align-items-center">

                                                                                    <span
                                                                                        class="text-secondary fw-bold">Categoria:
                                                                                        {{ $document->categoria }}</span>
                                                                                </div>
                                                                            @endif
                                                                            @if ($document->car_id)
                                                                                <div class="d-flex align-items-center">

                                                                                    <span
                                                                                        class="text-secondary fw-bold">Placa:
                                                                                        {{ $document->car->placa }}</span>
                                                                                </div>
                                                                            @endif
                                                                            @if ($document->empresa)
                                                                                <div class="d-flex align-items-center">
                                                                                    <span
                                                                                        class="text-secondary fw-bold">Empresa:
                                                                                        {{ $document->empresa }}</span>
                                                                                </div>
                                                                            @endif
                                                                            <div class="d-flex align-items-center">
                                                                                <span class="text-secondary fw-bold">F
                                                                                    emision:
                                                                                    {{ $document->fecEmit }}</span>
                                                                            </div>
                                                                            <div class="d-flex align-items-center">
                                                                                <span class="text-secondary fw-bold">F
                                                                                    renovación:
                                                                                    {{ $document->fecRenov }}</span>
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
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card">

                        <div class="card-content">
                            <div class="card-body">
                                <div class="col-12">
                                    <h4 class="card-title">Registro</h4>
                                </div>
                                <form class="form form-vertical" role="form" id="createDocForm" method="POST"
                                    action="{{ route(name: 'doc.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Tipo de documento</label>
                                                    <select class="form-select" id="tipoDocumento" name="tipo"
                                                        required>
                                                        <option value="1">Personal</option>
                                                        <option value="2">Vehicular</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">Nombre del documento</label>
                                                    <input type="text" id="dname" class="form-control"
                                                        name="name" placeholder="Nombre" required>
                                                </div>
                                            </div>
                                            <div class="personal">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="contact-info-vertical">N°</label>
                                                        <input type="number" id="dlicen" class="form-control"
                                                            name="licen" placeholder="N°">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="password-vertical">Categoria</label>
                                                        <input type="number" id="dcategoria" class="form-control"
                                                            name="categoria" placeholder="Categoria">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="auto">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="password-vertical">Empresa</label>
                                                        <input type="text" id="dempresa" class="form-control"
                                                            name="empresa" placeholder="Empresa">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="contact-info-vertical">Auto</label>
                                                        <select class="form-select" id="basicSelect" name="car_id"
                                                            required>
                                                            <option selected disabled>Auto</option>
                                                            @foreach ($cars as $car)
                                                                <option value="{{ $car->id }}">{{ $car->marca }}
                                                                    ||
                                                                    {{ $car->placa }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="password-vertical">Fecha de emisión</label>
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
                                            <div class="col-12">
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
                                            </div>
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
        </section> --}}
        @include('users.modalDoc.edit')
        @include('users.modalDoc.editVeh')
        @include('users.modalDoc.viewDoc')

    </div>
@endsection
@section('extra_resource')
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>

    @vite(['resources/assets/css/vendors/dripicons/webfont.css'])
    @vite(['resources/assets/css/client/dripicons.css'])
    @vite(['resources/assets/js/client/doc.js'])
@endsection
