<form action="{{ route('cleaning-services.update', $cleaning_service) }}" method="post" id="form-cleaning-service">
    @csrf
    @include('cleaning-services.partials.form-modal', ['row' => $cleaning_service])

    <input type="hidden" name="fromModal" value="1">
</form>
