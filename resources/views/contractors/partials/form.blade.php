@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp


<fieldset {{ $disabled }}>

    <!-- load fields -->
    @include('contractors.partials.form-fields', ['row' => $row])

</fieldset>


<!-- form actions -->
<div class="card">
    <div class="card-footer bg-transparent">
        <div class="mc-footer">
            <div class="row">
                <div class="col-lg-12">

                    @if ($disabled) 
                        <a 
                            href="{{ route('contractors.edit', [$row->id]) }}"
                            class="btn btn-outline-secondary m-1" 
                            role="button">
                                {{  __('Edit') }}
                        </a>
                    @endif

                    @if (!$disabled) 
                        <!-- create button -->
                        <button type="submit" class="btn  btn-primary m-1">
                            @if( ! $row->id )
                                {{ __('Create') }}
                            @else
                                {{ __('Update') }}
                            @endif
                        </button>

                        <a href="{{ route('contractors') }}" class="btn btn-outline-secondary m-1" role="button">
                            {{  __('Cancel') }}
                        </a>
                    @endif
                    
                    @if( $row->id )
                        <a href="{{ route('contractors.destroy', [$row->id]) }}" type="button" class="btn  btn-danger m-1 footer-delete-right">
                            {{ __('Delete') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>