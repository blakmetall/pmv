<form action="{{ route('property-management-transactions.update', [$pm->id, $transaction->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('property-management-transactions.partials.form', ['row' => $transaction])

    <input type="hidden" name="fromModal" value="1">
</form>