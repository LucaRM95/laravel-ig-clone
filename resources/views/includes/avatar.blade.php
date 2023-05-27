@if (isset(Auth::user()->image))
    <img src="{{ route('avatar', ['filename' => Auth::user()->image]) }}" class="avatar__navbar">
@else
    <p class="avatar__navbar without-logo"></p>
@endif
