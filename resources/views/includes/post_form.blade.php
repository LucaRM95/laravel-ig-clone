<div class="card-body">
    <form method="POST" action="{{ isset($image_post) ? route('update') : route('upload') }}" enctype="multipart/form-data">
        @csrf

        @if (isset($image_post))
            <input type="hidden" name="image_id" value={{$image_post->id}}>
        @endif

        <div class="row mb-3">
            <label id="image_container" for="image_path" class="col-md-12 col-form-label text-md-end card mb-3">
                @if( isset($image_post) )
                    <img class="card-img-top" src="{{ route('image', ['filename' => $image_post->image_path]) }}" alt="post_photo">
                @else
                    <div id="image_preview" class="card-img-top__preview"></div>
                @endif
            </label>
            <div class="col-md-12">
                <input id="image_path" name="image_path" type="file"
                    class="form-control @error('image_path') is-invalid @enderror" value="{{ old('image_path') }}"
                    {{isset($image_post) ? '' : 'required'}} autofocus onchange="image_preview(event)" />

                @error('image_path')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="input-group">
                    <div class="input-group-text" style="border-right: none">
                        <div class="fa-solid fa-comment"></div>
                    </div>
                    <textarea id="description" name="description" class="form-control" aria-label="Description" autofocus
                        style="border-left: none">
                        {{ isset($image_post) ? $image_post->description : 'Descripción' }}
                    </textarea>
                </div>

                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-0 justify-content-center">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ isset($image_post) ?__('Actualizar foto') : __('Subir foto') }}
                </button>
            </div>
        </div>
    </form>
</div>
