@extends('layouts.app')


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Mis Vehículos</h3>
                    {{-- <p class="text-subtitle text-muted">For user to check they list</p> --}}
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="row" id="basic-table">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Lista de vehiculos</h4>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">
                                @forelse ($cars as $car)
                                    <div class="col">
                                        <div class="card h-100 border rounded-3 overflow-hidden shadow-sm hover-shadow">

                                            <!-- Imagen -->
                                            <div class="position-relative bg-light" style="height: 160px;">
                                                <img src="{{ asset('storage/' . $car->imagen) }}" alt="Nuevo S-Presso"
                                                    class="w-100 h-100 object-fit-contain p-3">
                                            </div>

                                            <!-- Contenido -->
                                            <div class="card-body p-3">
                                                <h6 class="card-title text-dark fw-semibold text-truncate mb-1">
                                                    {{ $car->modelo }}
                                                </h6>

                                                <p class="text-muted small mb-3">
                                                    Placa: {{ $car->placa }}
                                                </p>
                                                <div class="text-muted small mb-4">
                                                    <p class="mb-1 text-truncate">Marca: {{ $car->marca }}</p>
                                                    <p class="mb-1 text-truncate">Modelo: {{ $car->modelo }}</p>
                                                    <p class="mb-1">Año: {{ $car->anhoFab }}</p>
                                                </div>

                                                <!-- Botones -->
                                                <div class="d-flex gap-2">
                                                    <button type="button"
                                                        class=" icon dripicons-document-edit btn btn-outline-primary btn-sm w-100 d-flex align-items-center justify-content-center gap-2"
                                                        data-bs-toggle="modal" data-bs-target="#editCarModal"
                                                        data-url='{{ route('car.update', $car) }}'
                                                        data-send="{{ route('car.ajax', $car) }}"
                                                        enctype="multipart/form-data">

                                                        <span class="d-none d-sm-inline">Editar</span>
                                                    </button>
                                                    <form class="alertDelete" method="POST"
                                                        action="{{ route('car.destroy', $car->id) }}" accept-charset="UTF-8"
                                                        style="display:inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button
                                                            class=" icon dripicons-document-delete btn btn-outline-danger btn-sm w-100 d-flex align-items-center justify-content-center gap-2">

                                                            <span class="d-none d-sm-inline">Eliminar</span>
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                <p>No tiene vehiculos registrados</p>
                                @endforelse


                            </div>
                        </div>
                        {{-- <div class="card-body dataTable-container">
                            <table id="example" class="display">
                                <thead>
                                    <tr>
                                        <th>Marca</th>
                                        <th>Placa</th>
                                        <th>Año</th>
                                        <th>Kilometraje</th>
                                        <th>Modelo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cars as $car)
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="{{ asset('storage/' . $car->imagen) }}" alt="">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">{{ $car->marca }}</p>
                                                </div>
                                            </td>
                                            <td>{{ $car->placa }}</td>
                                            <td>{{ $car->anhoFab }}</td>
                                            <td>{{ $car->km }}</td>
                                            <td>{{ $car->modelo }}</td>
                                            <td>
                                                <button type="button" class="icon dripicons-document-edit"
                                                    style="color: green; border:none" data-bs-toggle="modal"
                                                    data-bs-target="#editCarModal" data-url='{{ route('car.update', $car) }}'
                                                    data-send="{{ route('car.ajax', $car) }}" enctype="multipart/form-data">
                                                </button>
                                                <form class="alertDelete" method="POST"
                                                    action="{{ route('car.destroy', $car->id) }}" accept-charset="UTF-8"
                                                    style="display:inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" title="Delete Student"
                                                        class="icon dripicons-document-delete"
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
                        </div> --}}
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card">

                        <div class="card-content">
                            <div class="card-body">
                                <div class="col-12">
                                    <h4 class="card-title">Registro</h4>
                                </div>
                                <form class="form form-vertical" role="form" id="createCarForm" method="POST"
                                    action="{{ route('car.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">Marca</label>
                                                    <input type="text" id="cmarca" class="form-control" name="marca"
                                                        placeholder="Marca" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">Placa</label>
                                                    <input type="text" id="cplaca" class="form-control" name="placa"
                                                        placeholder="Placa" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Año</label>
                                                    <select class="form-select" id="basicSelect" name="anhoFab" required>
                                                        <option value="null" disabled>Año</option>
                                                        @for ($year = now()->year; $year >= 1980; $year--)
                                                            <option value="{{ $year }}"
                                                                {{ old('anioFab') == $year ? 'selected' : '' }}>
                                                                {{ $year }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="password-vertical">Kilometraje</label>
                                                    <input type="number" id="ckm" class="form-control" name="km"
                                                        placeholder="Kilometraje" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="password-vertical">Modelo</label>
                                                    <input type="text" id="cmodelo" class="form-control" name="modelo"
                                                        placeholder="Modelo" required>
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
        @include('users.modalAutos.edit')

    </div>
@endsection
@section('extra_resource')
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>
    @vite(['resources/assets/css/vendors/dripicons/webfont.css'])
    @vite(['resources/assets/css/client/dripicons.css'])
    @vite(['resources/assets/js/client/car.js'])
@endsection
