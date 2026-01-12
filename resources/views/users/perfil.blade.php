@extends('layouts.app')


@section('content')
    <div class="page-heading">

        <!-- Basic Tables start -->
        <section class="section">

            {{-- @method('PATCH') --}}
            <div class="container py-5">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="text-dark">Mi Perfil</h1>

                    <div class="d-flex gap-2">
                        <button id="btnEdit" class="btn btn-primary d-flex align-items-center gap-2">
                            <i class="bi bi-pencil"></i>
                            Editar
                        </button>
                        <form class="form form-vertical" action="{{ route('perfil.edit') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <button type="submit" class="btn btn-danger d-flex align-items-center gap-2 edit-mode d-none">
                                <i class="bi bi-save"></i>
                                Guardar
                            </button>

                    </div>
                </div>

                <!-- Perfil -->
                <div class="card mb-4">
                    <div class="card-body d-flex align-items-center gap-4">
                       <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
     style="width: 96px; height: 96px;">
    <i class="bi bi-person fs-1 d-flex align-items-center justify-content-center"></i>
</div>


                        <div>
                            <h5 class="mb-1">{{ $user->name }}</h5>
                            <small class="text-muted">Conductor registrado</small>
                        </div>
                    </div>
                </div>

                <!-- Información Personal -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4">Información Personal</h5>

                        <div class="mb-3">
                            <label class="text-muted small d-flex align-items-center gap-2">
                                <i class="bi bi-person"></i> Nombre completo
                            </label>
                            <p class="view-mode mb-0">{{ $user->name }}</p>
                            <input type="text" name="name" class="form-control edit-mode d-none"
                                value="{{ $user->name }}">
                        </div>

                        <div class="mb-3">
                            <label class="text-muted small d-flex align-items-center gap-2">
                                <i class="bi bi-envelope"></i> Correo electrónico
                            </label>
                            <p class="view-mode mb-0">{{ $user->email }}</p>

                            <input type="email" name="email" class="form-control edit-mode d-none"
                                value="{{ $user->email }}">
                        </div>

                        <div>
                            <label class="text-muted small d-flex align-items-center gap-2">
                                <i class="bi bi-telephone"></i> Teléfono
                            </label>
                            <p class="view-mode mb-0">{{ $user->phone ?? 'No especificado' }}</p>
                            <input type="text" name="phone" class="form-control edit-mode d-none"
                                value="{{ $user->phone }}">
                        </div>
                    </div>
                </div>
                </form>

                <!-- Licencia -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4">Licencia de Conducir</h5>

                        <div>
                            <label class="text-muted small d-flex align-items-center gap-2">
                                <i class="bi bi-credit-card"></i> Número de licencia
                            </label>
                            <p class="mb-0">No especificado</p>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
@section('extra_resource')
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>

    @vite(['resources/assets/js/client/perfil.js'])
@endsection
