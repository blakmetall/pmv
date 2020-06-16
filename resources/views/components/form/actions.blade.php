@php 
    $id = isset($id) ? $id : ''; 
    $disabled = isset($disabled) ?  $disabled : false;
    $edit_route = isset($edit_route) ? $edit_route : '';
    $cancel_route = isset($cancel_route) ? $cancel_route : '';
    $delete_route = isset($delete_route) ? $delete_route : '';
    $routeParams = isset($routeParams) && is_array($routeParams) ? $routeParams : [];

    if ($id && ($disabled || $delete_route)) {
        $routeParams[] = $id;
    }

    $skipDelete = isset($skipDelete) ? (bool) $skipDelete : false;

@endphp

<div class="card form-actions">
    <div class="card-footer bg-transparent">
        <div class="mc-footer">
            <div class="row">
                <div class="col-lg-12">

                    @if ($disabled && $id) 
                        <a 
                            href="{{ route($edit_route, $routeParams) }}" 
                            class="btn btn-outline-secondary m-1" 
                            role="button">
                                {{  __('Edit') }}
                        </a>
                    @endif

                    @if (!$disabled)
                        <button type="submit" class="btn  btn-primary m-1">
                            @if( !$id )
                                {{ __('Create') }}
                            @else
                                {{ __('Update') }}
                            @endif
                        </button>

                        @if ($cancel_route)
                            <a href="{{ route($cancel_route, $routeParams) }}" class="btn btn-outline-secondary m-1" role="button">
                                {{  __('Cancel') }}
                            </a>
                        @endif
                    @endif

                    <!-- if editing might be a chance to delete -->
                    @if( $id && $delete_route && !$skipDelete)
                        <a 
                            href="{{ route($delete_route, $routeParams) }}" 
                            class="btn btn-danger m-1 footer-delete-right" 
                            role="button">
                                {{ __('Delete') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>