@php
    $id = isset($id) ? $id : '';
    $disabled = isset($disabled) ? $disabled : false;
    $edit_route = isset($edit_route) ? $edit_route : '';
    $cancel_route = isset($cancel_route) ? $cancel_route : '';
    $delete_route = isset($delete_route) ? $delete_route : '';
    $routeParams = isset($routeParams) && is_array($routeParams) ? $routeParams : [];
    $cancelParams = isset($cancelParams) && is_array($cancelParams) ? $cancelParams : [];

    $skipEdit = isset($skipEdit) ? (bool) $skipEdit : false;
    $skipDelete = isset($skipDelete) ? (bool) $skipDelete : false;
    $skipCancel = isset($skipCancel) ? (bool) $skipCancel : false;

@endphp

<div class="card form-actions">
    <div class="card-footer bg-transparent">
        <div class="mc-footer">
            <div class="row">
                <div class="col-lg-12">

                    @if(!$disabled)
                        @if(!$skipEdit)
                            <button type="submit" class="btn  btn-primary m-1">
                                {{ __('Send Email') }}
                            </button>
                        @endif

                        @if($cancel_route && !$skipCancel)
                            <a href="{{ route($cancel_route, $cancelParams) }}" class="btn btn-outline-secondary m-1" role="button">
                                {{ __('Cancel') }}
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>