@extends('layouts.master')

@section('content-form')
    <div class="">
        <div class="row min-vh-100">

            <!-- LADO IZQUIERDO (INFO) -->
            <div
                class="col-lg-5 d-none d-lg-flex flex-column justify-content-between p-5 position-relative bg-white overflow-hidden">

                <!-- Fondo -->
                <div class="position-absolute top-0 start-0 w-100 h-100"
                    style="background: linear-gradient(135deg,#f8f9fa,#e9f2ff);"></div>

                <!-- CONTENIDO -->
                <div class="position-relative z-1">

                    <div class="text-center mb-5">
                        <img src="{{ asset('assets/logos/logodrive.png') }}" class="img-fluid" style="max-height:150px;">
                    </div>

                    <p class="text-secondary fs-5 text-center mx-auto" style="max-width:420px;">
                        Únete a miles de conductores que ya confían en DRIVE UP para gestionar sus vehículos </p>

                </div>

                <!-- CARDS -->
                <div class="position-relative z-1">

                    <div class="p-4 rounded shadow-lg text-white"
                        style="background: linear-gradient(135deg,#3178bf,#7198bf);">

                        <h6 class="mb-4 text-white">¿Por qué elegir DRIVE UP?</h6>

                        <ul class="list-unstyled mb-0">

                            <li class="d-flex align-items-center mb-3">
                                <div class=" bg-opacity-25 rounded-circle p-2 me-3">
                                    <i class="bi bi-check-circle-fill text-white"></i>
                                </div>
                                <span>Gestión completa de documentos vehiculares</span>
                            </li>

                            <li class="d-flex align-items-center mb-3">
                                <div class=" bg-opacity-25 rounded-circle p-2 me-3">
                                    <i class="bi bi-check-circle-fill text-white"></i>
                                </div>
                                <span>Recordatorios automáticos de vencimientos</span>
                            </li>

                            <li class="d-flex align-items-center mb-3">
                                <div class=" bg-opacity-25 rounded-circle p-2 me-3">
                                    <i class="bi bi-check-circle-fill text-white"></i>
                                </div>
                                <span>Historial completo de mantenimientos</span>
                            </li>

                            <li class="d-flex align-items-center">
                                <div class=" bg-opacity-25 rounded-circle p-2 me-3">
                                    <i class="bi bi-check-circle-fill text-white"></i>
                                </div>
                                <span>Interfaz intuitiva y fácil de usar</span>
                            </li>

                        </ul>
                    </div>

                </div>


                <div class="position-relative z-1 text-center text-muted small">
                    © 2025 DRIVE UP
                </div>

            </div>

            <div class="col-12 col-lg-7 p-0">
                <div id="" class="auth-right"
                    style="background: linear-gradient(135deg, rgb(45, 64, 145) 0%, rgb(49, 120, 191) 50%, rgb(45, 127, 145) 100%);">
                    {{-- <img src="{{ asset('assets/logos/autodrive.png') }}" alt="Logo" class="auth-logo img-cover"> --}}

                    <div style="padding: 4rem; background: white;">

                        <div class="mb-8 text-center">
                            <h1 class="text-gray-900 mb-2">Crear Cuenta</h1>
                            <p class="text-gray-600">Completa el formulario para comenzar a usar DRIVE UP</p>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf <div class="form-group position-relative has-icon-left mb-4">
                                <input id="name" type="text" name="name"
                                    class="form-control form-control-xl @error('name') is-invalid @enderror"
                                    placeholder="Nombre" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input id="email" type="email" name="email"
                                    class="form-control form-control-xl @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" required placeholder="Correo">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-control-icon">
                                    <i class="bi bi-envelope"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input id="phone" type="number" name="phone" maxlength="9" pattern="[0-9]{9}"
                                    inputmode="numeric"
                                    class="form-control form-control-xl @error('phone') is-invalid @enderror"
                                    value="{{ old('number') }}" placeholder="Telefono  (opcional)">
                                <div class="form-control-icon">
                                    <i class="bi bi-phone"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input id="password" type="password" name="password"
                                    class="form-control form-control-xl @error('password') is-invalid @enderror" required
                                    placeholder="Contraseña">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input id="password-confirm" type="password" name="password_confirmation"
                                    class="form-control form-control-xl" placeholder="Confirmar Contraseña">
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg">Registrar</button>
                        </form>
                        <div class="text-center mt-5 text-lg fs-4">
                            <p class='text-gray-600'>Ya tienes una cuenta? <a href="{{ route('login') }}"
                                    class="font-bold">Inicia aquí</a>.</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
