<!-- file modal -->
<div class="modal fade app-modal-notification" id="{{ $modalID }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog app-table-file-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Preview of Notification') }}</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="app-modal-notification-container" data-url="{{ route('property-management-transactions.confirm-email') }}">
                    ...
                </div>
            </div>
        </div>
    </div>
</div>