@if (session('message'))
    <div class="alert alert-{{session('error')? 'danger': 'success'}}">
        {{ session('message') }}
    </div>
@endif
