@extends('layouts.master')

@section('content-form')
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div id="auth-left">
                    {{-- <div class="">
                        <a href="index.html"><img src="{{ asset('storage/logos/autodrive.png') }}" alt="Logo" width="270px"
                                height="170px"></a>
                    </div> --}}
                    <h1 class="auth-title">Registro</h1>
                    <form action="index.html">
                        <div class="form-group position-relative has-icon-left mb-4">
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
            </form>
        </div>
        <div class="col-lg-7 d-none d-lg-block p-0">
            <div id="auth-right" class="auth-right">
                <img src="{{ asset('storage/logos/autodrive.png') }}" alt="Logo" class="auth-logo img-cover">
            </div>

        </div>
    </div>
@endsection
