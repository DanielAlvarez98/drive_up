@extends('layouts.master')

@section('content-form')
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div id="auth-left">
                    {{-- <div class="">
                        <a href="index.html"><img src="{{ asset('storage/logos/autodrive.png') }}" alt="Logo" width="270px"
                                height="170px"></a>
                    </div> --}}
                    <h1 class="">¡Ingrese a DriveUp!</h1>
                    <form action="index.html">
                        <div class="form-group position-relative has-icon-left mb-4">
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
                                class="font-bold">Registrate aquí </a>.</p>
                    </div>
                </div>

            </form>
        </div>
        <div class="col-lg-7 d-none d-lg-block p-0">
            <div id="auth-right" class="auth-right">
                <img src="{{ asset('assets/logos/autodrive.png') }}" alt="Logo" class="auth-logo img-cover">
            </div>

        </div>
    </div>
@endsection
