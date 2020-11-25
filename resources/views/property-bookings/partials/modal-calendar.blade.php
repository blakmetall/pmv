<!-- file modal -->
<div class="modal fade app-modal-calendar" id="{{ $modalID }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog app-table-file-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Property') }} {{ __('Availability') }}: {{ $propertyTranslation->name }} </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <div class="btns-container">
                            <a href="#" data-source="{{ $property->id }}" data-year="" data-target="#{{$modalID }}" class="modal-prev btn btn-dark">
                                {{ __('Prev Year') }}
                            </a>
                            <span class="modal-current"></span>
                            <a href="#" data-source="{{ $property->id }}" data-year="" data-target="#{{$modalID }}" class="modal-next btn btn-dark">
                                {{ __('Next Year') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="calendar-container">
                            <div class="app-modal-calendar-container" data-url="{{ route('property-calendar.calendar-modal') }}">
                                ...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>