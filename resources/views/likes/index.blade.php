@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-5">Favoritos</h1>
                
                @foreach ($likes as $like)
                    @include('includes.image', ['image' => $like->images])
                @endforeach
                {{-- PAGINACIÓN --}}
                {{$likes->links()}}
            </div>
        </div>
    </div>
@endsection
