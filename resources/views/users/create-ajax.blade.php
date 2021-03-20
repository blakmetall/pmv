<form action="{{ route('users.store-ajax') }}" method="post" id="store-ajax">
    @csrf
    @include('users.partials.form-modal', ['row' => $user])

    <input type="hidden" name="fromModal" value="1">
</form>