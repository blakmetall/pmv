<form action="{{ route('cleaning-services.store') }}" method="post">
    @csrf
    @include('cleaning-services.partials.form-modal', ['row' => $cleaning_service])

    <input type="hidden" name="fromModal" value="1">
</form>