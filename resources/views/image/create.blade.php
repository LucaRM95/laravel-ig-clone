@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ isset($image_post) ? __('Edit your picture') : __('Post your picture') }}</div>
                    @if(isset($image_post))
                        @include('includes.post_form', $image_post)
                    @else
                        @include('includes.post_form')
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
