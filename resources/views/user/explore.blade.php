@extends('layouts.app')

@section('content')
    <div class="d-flex container justify-content-center">
        <section class="explore-section">
            @foreach ($images as $image)
                <div class="gallery-item box bigger">
                    <img class="box bigger" src="{{route('image', ['filename' => $image->image_path])}}" alt="post-{{$image->id}}">
                    <div class="gallery-item-info">
                        <ul>
                            <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i
                                    class="fas fa-heart" aria-hidden="true"></i> {{count($image->likes)}}
                            </li>
                            <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i
                                    class="fas fa-comment" aria-hidden="true"></i> {{count($image->comments)}}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="gallery-item box">
                    <img class="box" src="{{ route('image', ['filename' => $image->image_path])}}" alt="post-{{$image->id}}">
                    <div class="gallery-item-info">
                        <ul>
                            <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i
                                    class="fas fa-heart" aria-hidden="true"></i> {{count($image->likes)}}
                            </li>
                            <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i
                                    class="fas fa-comment" aria-hidden="true"></i> {{count($image->comments)}}
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
@endsection
