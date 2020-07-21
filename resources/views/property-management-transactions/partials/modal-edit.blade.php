@php
    $modalID = 'transaction-edit-' . strtotime('now') . rand(1,99999);
@endphp

<a href="#" class="text-primary app-icon-link mr-1" data-toggle="modal" data-target="#{{ $modalID }}">
    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
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