<form action="{{ route('cleaning-services.store') }}" method="post" id="form-cleaning-service">
    <div id="error-fields" class="alert alert-danger app-alert-danger mb-4" role="alert">
        {{ __('Please fill all required fields') }}
    </div>
    @csrf
    @include('cleaning-services.partials.form-modal', ['row' => $cleaning_service])

    <input type="hidden" name="fromModal" value="1">
</form>
