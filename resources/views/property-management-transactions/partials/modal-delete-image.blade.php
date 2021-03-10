<!-- delete image modal -->
<div class="modal fade app-modal-delete-image" id="{{ $modalID }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog app-table-file-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Are you sure, you want delete image?') }}</h5>
            </div>
            <div class="modal-body">
                <div class="app-modal-delete-image-container"
                    data-url="{{ route('property-management-transactions.confirm-delete-image') }}">
                    ...
                </div>
            </div>
        </div>
    </div>
</div>
