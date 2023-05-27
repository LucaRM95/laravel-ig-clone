@extends('layouts.app')

@section('content')
    <div class="d-flex container" style="height: 75%">
        <div class="smartphone" style="padding: 0">
            @include('includes.carousel')
        </div>
        <div class="form-container">
            <div class="d-flex flex-column justify-content-center form-container__assets" >
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h2 class="mb-5" style="margin-left: 7.5rem"> User Register </h2>

                    <div class="row mb-3">
                        <div class="col-md-8 offset-md-2">
                            <div class="input-group">
                                <div class="input-group-text" style="border-right: none">
                                    <div class="fa-solid fa-user"></div>
                                </div>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Name">

                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8 offset-md-2">
                            <div class="input-group">
                                <div class="input-group-text" style="border-right: none">
                                    <div class="fa-solid fa-user"></div>
                                </div>
                                <input id="surname" type="text"
                                    class="form-control @error('surname') is-invalid @enderror" name="surname"
                                    value="{{ old('surname') }}" required autocomplete="surname" autofocus
                                    placeholder="Surname">

                            </div>
                            @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8 offset-md-2">
                            <div class="input-group">
                                <div class="input-group-text" style="border-right: none">
                                    <div class="fa-solid fa-user-secret"></div>
                                </div>
                                <input id="nick" type="text"
                                    class="form-control @error('nick') is-invalid @enderror" name="nick"
                                    value="{{ old('nick') }}" required autocomplete="nick" placeholder="Nickname"
                                    autofocus>

                            </div>
                            @error('nick')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8 offset-md-2">
                            <div class="input-group">
                                <div class="input-group-text" style="border-right: none">
                                    <div class="fa-solid fa-envelope"></div>
                                </div>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required placeholder="Email address"
                                    autocomplete="email">

                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class=" col-md-8 offset-md-2">
                            <div class="input-group">
                                <div class="input-group-text" style="border-right: none">
                                    <div class="fa-solid fa-lock"></div>
                                </div>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password" placeholder="Password">
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
                        <div class="col-md-8 offset-md-2">
                            <div class="input-group">
                                <div class="input-group-text" style="border-right: none">
                                    <div class="fa-solid fa-lock"></div>
                                </div>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Confirm Password">
                                <label class="input-group-text btn btn-light" onclick="showPasswordToConfirm()">
                                    <div id="password_confirm_view" class="show_pass"></div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-2">
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="form-container__assets--section-links mt-3 pt-3 pb-3">
                    <p class="mb-0 pb-0">
                        ¿tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
