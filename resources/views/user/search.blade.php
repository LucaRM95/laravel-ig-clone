@extends('layouts.app')

@section('content')
    <div class="container" style="width: 50%">
        <div class="row justify-content-center">
            <h1>Buscar</h1>
            <form method="POST" class="input-group col-md-8 mb-5" action="{{ route('search') }}">
                @csrf

                <input name="search" class="form-control" type="text" required>
                <button type="submit" class="input-group-text ">
                    <i class="fa-solid fa-search"></i>
                </button>
            </form>
            <hr>
            <div class="col-md-8 mt-3">
                @if (isset($search))
                    @include('includes.message')
                    @foreach ($search as $user)
                        <a href="{{ route('profile', ['id' => $user->id]) }}" class="search-users d-flex align-items-center">
                            @if ($user->image)
                                <img class="avatar me-5" src="{{ route('avatar', ['filename' => $user->image]) }}" alt="profile_photo">
                            @else
                                <p class="avatar without-logo me-5"></p>
                            @endif
                                
                            <div class="d-flex flex-column">
                                <span class="profile-real-name">
                                    @if($user->nick)
                                        {{$user->nick}}
                                    @else
                                        {{$user->name}}
                                    @endif
                                </span>
                                <p class="muted">{{$user->name}} {{$user->surname}} - 500 followers</p>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="d-flex justify-content-center mt-5">
                        <p class="muted">No se encontraron resultados.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
