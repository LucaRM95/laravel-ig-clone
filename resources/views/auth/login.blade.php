@extends('layouts.app')

@section('content')
    <div class="d-flex container" style="height: 75%">
        <div class="smartphone" style="padding: 0">
            @include('includes.carousel')
        </div>
        <div class="form-container">
            <div class="d-flex flex-column justify-content-center form-container__assets" >
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h2 class="mb-5" style="margin-left: 7.5rem"> User login </h2>

                    <div class="row mb-3">
                        <div class="col-md-8 offset-md-2">
                            <div class="input-group">
                                <div class="input-group-text" style="border-right: none">
                                    <div class="fa-solid fa-envelope"></div>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
                                    style="border-left: none" placeholder="Email address" autofocus>
    
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8 offset-md-2">
                            <div class="input-group">
                                <div class="input-group-text" style="border-right: none">
                                    <div class="fa-solid fa-lock"></div>
                                </div>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    style="border-left: none" autocomplete="current-password" placeholder="Password">
                                <label class="input-group-text btn btn-light" onclick="showPassword()">
                                    <div id="password_view" class="show_pass"></div>
                                </label>
                            </div>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-2">

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>

                            <br>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link ms-5" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
                <div class="form-container__assets--section-links mt-3 pt-3 pb-3">
                    <p class="mb-0 pb-0">
                        ¿No tienes una cuenta? <a class="btn btn-link" href="{{ route('register') }}">Regístrate</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

