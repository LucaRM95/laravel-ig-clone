<div class="card mb-4">
    <div
        class="card-header d-flex {{ Auth::user()->id == $image->user_id ? 'justify-content-evenly' : 'justify-content-start' }} align-items-center">
        @if ($image->user->image)
            <img src="{{ route('avatar', ['filename' => $image->user->image]) }}"
                class="avatar__navbar {{ Auth::user()->id == $image->user_id ? '' : 'me-3' }}">
        @else
            <p class="avatar__navbar without-logo {{ Auth::user()->id == $image->user_id ? '' : 'me-3' }}"></p>
        @endif
        <p class="pub-user mb-0">
            <a href="{{ route('profile', ['id' => $image->user->id]) }}">
                {{ $image->user->name . ' ' . $image->user->surname }}
                <span>{{ ' | @' . $image->user->nick }}</span>
            </a>
        </p>
        @if (Auth::user()->id == $image->user_id)
            <div id="dropdownActionsImage" class="dropdown d-flex justify-content-end" style="width: 50%">
                <button class="btn btn-link actions dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownActionsImage">
                    <li>
                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmModal">
                            <i class="fa-solid fa-trash"></i> Eliminar
                        </button>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('edit', ['id' => $image->id]) }}">
                            <i class="fa-solid fa-pencil"></i> Editar
                        </a>
                    </li>
                </ul>
            </div>
        @endif
    </div>

    <div class="card mb-3">
        <img src="{{ route('image', ['filename' => $image->image_path]) }}" alt="">
    </div>
    <div class="card-body">
        <div class="card-text d-inline-flex">
            <strong class="me-3">{{ '@' . $image->user->nick }}</strong>
            <p>
                {{ $image->description }}
            </p>
        </div>
        {{-- \FormatTime::LongTimeFilter($image->created_at) --}}
        <p class="card-text"><small
                class="text-muted">{{ \Carbon\Carbon::now()->diffForHumans($image->created_at) }}</small>
        </p>
        <div class="d-inline-flex align-items-center" style="width: 100%">
            <div class="d-flex align-items-center likes me-4">
                <?php $user_like = false; ?>
                @foreach ($image->likes as $like)
                    @if ($like->user->id == Auth::user()->id)
                        <?php $user_like = true; ?>
                    @endif
                @endforeach
                @if ($user_like)
                    <img id="like_{{ $image->id }}"
                        onclick="likeDetector({{ $image->id }}, 'like_{{ $image->id }}')"
                        src="{{ asset('img/heart-red.png') }}" alt="">
                @else
                    <img id="unlike_{{ $image->id }}"
                        onclick="likeDetector({{ $image->id }}, 'unlike_{{ $image->id }}')"
                        src="{{ asset('img/heart-grey.png') }}" alt="">
                @endif
                <span id="count_likes" class="likes__count ms-2">{{ count($image->likes) }}</span>
            </div>
            @if (url()->full() == 'http://proyecto-laravel.com.devel')
                <div class="comments">
                    <h4>
                        <a href="{{ route('detail', ['id' => $image->id]) }}">
                            Comentarios ({{ count($image->comments) }})
                        </a>
                    </h4>
                </div>
            @else
                <div class="comments">
                    <h4>
                        <a href="{{ route('detail', ['id' => $image->id]) }}">
                            Comentarios({{ count($image->comments) }})
                        </a>
                        <a class="btn btn-link" data-bs-toggle="collapse" href="#commentsCollapse" role="button"
                            aria-expanded="false" aria-controls="commentsCollapse">Ver comentarios</a>
                    </h4>
                </div>
            @endif

        </div>
        @if (url()->full() != 'http://proyecto-laravel.com.devel')
            <div class="row">
                <div class="col">
                    <div class="collapse multi-collapse" id="commentsCollapse">
                        <div class="card card-body">
                            @if (count($image->comments) > 0)
                                @foreach ($image->comments as $comment)
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-content-center mt-4">
                                            @if ($comment->user->image)
                                                <img src="{{ route('avatar', ['filename' => $comment->user->image]) }}"
                                                    class="avatar__navbar me-4">
                                            @else
                                                <p class="avatar__navbar without-logo me-4"></p>
                                            @endif
                                            <span class="profile-real-name">
                                                {{ $comment->user->nick }}
                                                <span class="muted">
                                                    {{ ' @' . $comment->user->name }} {{ $comment->user->surname }}
                                                </span>
                                            </span>
                                            <p class="ms-5">{{ $comment->content }}</p>
                                        </div>
                                        @if (Auth::user()->id == $image->user_id || Auth::user()->id == $comment->user_id)
                                            <div class="d-flex justify-content-between" style="width: 6%">
                                                <a class="actions"
                                                    href="{{ route('delete', ['id' => $comment->id]) }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="d-flex justify-content-center">
                                    <p class="muted mb-0">No hay comentarios</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <form method="POST" class="mt-3" action="{{ route('save') }}">
            @csrf
            <input type="hidden" name="image_id" value="{{ $image->id }}">
            <div class="input-group">
                <textarea id="content" name="content" class="form-control" aria-label="With textarea" required></textarea>
                <button type="submit" class="input-group-text btn btn-light icon">
                    <img src="{{ asset('img/comment.png') }}" alt="">
                </button>
            </div>
            @error('content')
                <span>
                    <strong class="invalid-feedback" role="alert">{{ $message }}</strong>
                </span>
            @enderror
        </form>
    </div>
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Eliminar publicación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Esta seguro que desea eliminar esta publicación?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a type="button" href="{{ route('delete_image', ['id' => $image->id]) }}" class="btn btn-primary">Confirmar</a>
                </div>
            </div>
        </div>
    </div>
</div>
