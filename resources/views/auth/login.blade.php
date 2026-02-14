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
                        Gestiona toda la información de tus vehículos y conductores en un solo lugar
                    </p>

                </div>

                <!-- CARDS -->
                <div class="position-relative z-1">

                    <div class="d-flex gap-3 p-4 rounded shadow mb-3 text-white"
                        style="background: linear-gradient(135deg,#3178bf,#7198bf);">
                        <div class="bg-opacity-25 p-2 rounded">
                            <div class=" p-2 rounded-3" style="background-color: #fff3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="text-white">
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
                        <div>
                            <h6 class="mb-1 text-white">Gestión de Vehículos</h6>
                            <small class="text-white">
                                Registra y administra toda la información de tus vehículos
                            </small>
                        </div>
                    </div>

                    <div class="d-flex gap-3 p-4 rounded shadow mb-3 text-white"
                        style="background: linear-gradient(135deg,#2d7f91,#3178bf);">
                        <div class="bg-opacity-25 p-2 rounded">
                            <div class=" p-2 rounded-3" style="background-color: #fff3">

                                <i class="bi bi-file-earmark-text fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-white mb-1">Gestión de Vehículos</h6> <small class="text-white">
                                Mantén todos tus documentos organizados y actualizados
                            </small>
                        </div>
                    </div>

                    <div class="d-flex gap-3 p-4 rounded shadow text-white"
                        style="background: linear-gradient(135deg,#2d4091,#3178bf);">
                        <div class="bg-opacity-25 p-2 rounded">
                            <div class=" p-2 rounded-3" style="background-color: #fff3">

                                <i class="bi bi-bell fs-4"></i>
                            </div>

                        </div>
                        <div>
                            <h6 class="mb-1 text-white">Recordatorios Inteligentes</h6>
                            <small class="text-white">
                                Recibe alertas sobre vencimientos y mantenimientos
                            </small>
                        </div>
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
                            <h1 class="text-gray-900 mb-2">¡Bienvenido de vuelta!</h1>
                            <p class="text-gray-600">Ingresa tus credenciales para acceder a tu cuenta</p>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf <div class="form-group position-relative has-icon-left mb-4">
                                <input type="email" id="email" name="email"
                                    class="form-control form-control-xl  @error('email') is-invalid @enderror"
                                    placeholder="Correo" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input id="password" type="password" name="password"
                                    class="form-control form-control-xl @error('password')  is-invalid @enderror"
                                    placeholder="Password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Ingresar</button>
                        </form>
                        <div class="text-center mt-5 text-lg fs-4">
                            <p class="text-gray-600">No tienes una cuenta? <a href="{{ route('register') }}"
                                    class="font-bold">Registrate
                                    aquí </a>.</p>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
