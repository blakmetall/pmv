@if (Session::has('success'))
    <div class="app-container app-centered">
        <div class="alert alert-success app-alert-success mb-4" role="alert">
            {!! Session::get('success') !!}
        </div>
    </div>
@endif

@if (Session::has('error'))
    <div class="app-container app-centered">
        <div class="alert alert-danger app-alert-danger mb-4" role="alert">
            {!! Session::get('error') !!} 
            @if(isset($_GET['adults_sing'])) 
                - <a href="{{ route('public.reservations', [App::getLocale(), $property->property_id]) }}" class="btn-send-query">{{ __('Send Query') }}
                </a>
            @endif
        </div>
    </div>
@endif
