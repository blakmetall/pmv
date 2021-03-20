<form action="{{ route('contacts.store') }}" method="post">
    @csrf
    @include('contacts.partials.form', ['row' => $contact])

    <input type="hidden" name="fromModal" value="1">
</form>