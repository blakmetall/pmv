@php
    $modalID = 'transaction-edit-' . strtotime('now') . rand(1,99999);
@endphp

<a href="#" class="d-inline-block text-primary app-icon-link mr-1" data-toggle="modal" data-target="#{{ $modalID }}">
    <img src="/images/edit.gif" style="width: 15px;" />
</a>


<!-- file modal -->
<div class="modal fade app-transaction-modal" id="{{ $modalID }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog app-table-file-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Edit Transaction') }}</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="app-transaction-modal-container" data-url="{{ route('property-management-transactions.edit-ajax', [$pm->id, $transaction->id]) }}">
                    ...
                </div>
            </div>
        </div>
    </div>
</div>
