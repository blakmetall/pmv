<!-- file modal -->
<div class="modal fade app-cleaning-service-modal" id="{{ $modalEditID }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog app-table-file-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Edit Cleaning Service') }}</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="app-cleaning-service-modal-container" data-url="{{ route('cleaning-services.edit-ajax', [$cleaning_service]) }}">
                    ...
                </div>
            </div>
        </div>
    </div>
</div>