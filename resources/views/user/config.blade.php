@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @include('includes.message')
                <div class="card">
                    <div class="card-header">Configuración de mi cuenta</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('update') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-7 offset-md-3">
                                    <div class="input-group">
                                        <div class="input-group-text" style="border-right: none">
                                            <div class="fa-solid fa-envelope"></div>
                                        </div>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ Auth::user()->name }}" required autocomplete="name" 
                                            style="border-left: none" autofocus>
                                    </div>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-7 offset-md-3">
                                    <div class="input-group">
                                        <div class="input-group-text" style="border-right: none">
                                            <div class="fa-solid fa-user"></div>
                                        </div>
                                        <input id="surname" type="text"
                                            class="form-control @error('surname') is-invalid @enderror" name="surname"
                                            value="{{ Auth::user()->surname }}" required autocomplete="surname" 
                                            style="border-left: none" autofocus>
                                    </div>

                                    @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-7 offset-md-3">
                                    <div class="input-group">
                                        <div class="input-group-text" style="border-right: none">
                                            <div class="fa-solid fa-user-secret"></div>
                                        </div>
                                        <input id="nick" type="text"
                                            class="form-control @error('nick') is-invalid @enderror" name="nick"
                                            value="{{ Auth::user()->nick }}" required autocomplete="nick" 
                                            style="border-left: none" autofocus>
                                    </div>

                                    @error('nick')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-7 offset-md-3">
                                    <div class="input-group">
                                        <div class="input-group-text" style="border-right: none">
                                            <div class="fa-solid fa-envelope"></div>
                                        </div>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ Auth::user()->email }}" required autocomplete="email" style="border-left: none" >
                                    </div>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 align-items-center">
                                <label id="image_preview" for="image_path" class="col-md-4 col-form-label text-md-end">
                                    @if (isset(Auth::user()->image))
                                        <img id="avatar" src="{{ route('avatar', ['filename' => Auth::user()->image]) }}"
                                            class="avatar">
                                    @else
                                        <p id="avatar" class="avatar without-logo"></p>
                                    @endif
                                </label>

                                <div class="col-md-6">
                                    <input id="image_path" type="file"
                                        class="form-control @error('image_path') is-invalid @enderror" name="image_path"
                                        autocomplete="avatar" onchange="image_preview_avatar(event)">

                                    @error('image_path')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar cambios
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
