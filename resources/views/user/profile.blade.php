@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('includes.message')
            <header>

                <div class="container">

                    <div class="profile">

                        <div class="profile-image">
                            {{-- route('avatar', ['filename' => $user->image]) --}}
                            @if ($user->image)
                                <img src="{{ route('avatar', ['filename' => $user->image]) }}" alt="profile_photo">
                            @else
                                <p class="avatar__profile_empty without-logo"></p>
                            @endif

                        </div>

                        <div class="profile-user-settings">

                            <h1 class="profile-user-name">
                                @if ($user->nick)
                                    {{ $user->nick }}
                                @else
                                    {{ $user->name }}
                                @endif
                            </h1>

                            @if (Auth::user()->id == $user->id)
                                <a href="{{route('config')}}" class="btn profile-edit-btn">Edit Profile</a>

                                <button class="btn profile-settings-btn" aria-label="profile settings"><i class="fas fa-cog"
                                        aria-hidden="true"></i></button>
                            @endif
                        </div>

                        <div class="profile-stats">

                            <ul>
                                <li><span class="profile-stat-count">164</span> posts</li>
                                <li><span class="profile-stat-count">188</span> followers</li>
                                <li><span class="profile-stat-count">206</span> following</li>
                            </ul>

                        </div>

                        <div class="profile-bio">
                            <span class="profile-real-name">{{ $user->name }} {{ $user->surname }}</span>
                            <p class="muted mb-0">Artist</p>
                            <p> Lorem ipsum dolor sit, amet consectetur
                                adipisicing elit 📷✈️🏕️</p>

                        </div>

                    </div>
                    <!-- End of profile section -->

                </div>
                <!-- End of container -->

            </header>

            <main>

                <div class="container">

                    <div class="gallery">
                        @if ($user->image)
                            @foreach ($user->images as $image)
                                <a class="gallery-item" tabindex="0" href="{{ route('detail', ['id' => $image->id]) }}">
                                    <img src="{{ route('image', ['filename' => $image->image_path]) }}" class="gallery-image"
                                        alt="">

                                    <div class="gallery-item-info">
                                        <ul>
                                            <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i
                                                    class="fas fa-heart" aria-hidden="true"></i> {{ count($image->likes) }}
                                            </li>
                                            <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i
                                                    class="fas fa-comment" aria-hidden="true"></i> {{ count($image->comments) }}
                                            </li>
                                        </ul>

                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="d-flex justify-content-center">
                                <p class="muted mt-5">Este usuario no ha hecho ningún post</p>
                            </div>
                        @endif

                    </div>
                    <!-- End of gallery -->

                    {{-- <div class="loader"></div> --}}

                </div>
                <!-- End of container -->

            </main>
        </div>
    </div>
@endsection
