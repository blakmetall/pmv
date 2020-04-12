
@if (Session::has('success'))
    <div class="container app-container app-centered">
        <div class="alert alert-success app-alert-success mb-4" role="alert">
            {{ Session::get('success') }}
        </div>
    </div>
@endif

@if (Session::has('error'))
    <div class="container app-container app-centered">
        <div class="alert alert-danger app-alert-danger mb-4" role="alert">
            {{ Session::get('error') }}
        </div>
    </div>
@endif