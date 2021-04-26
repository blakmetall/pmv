@php 
    $trimTime = isset($trimTime) ? (bool) $trimTime : false;

    if(isset($created_at)) {
        if ($trimTime) {
            $created_parts = explode(' ', $created_at);
            $created_at = $created_parts[0];
        } else {
            $created_parts = explode(' ', $created_at);
            $created_at = $created_parts[0];
            if(isset($created_parts[1])) {
                $created_at .= '<br>' . $created_parts[1];
            }
        }
    }

    if(isset($updated_at)) {
        if ($trimTime) {
            $updated_parts = explode(' ', $updated_at);
            $updated_at = $updated_parts[0];
        } else {
            $updated_parts = explode(' ', $updated_at);
            $updated_at = $updated_parts[0];
            if(isset($updated_parts[1])) {
                $updated_at .= '<br>' . $updated_parts[1];
            }
        }
    }

    if((isset($audited_at) && $audited_at != '') && isset($auditedBy)) {
        if ($trimTime) {
            $audited_parts = explode(' ', $audited_at);
            $audited_at = $audited_parts[0];
        } else {
            $audited_parts = explode(' ', $audited_at);
            $audited_at = $audited_parts[0];
            if(isset($audited_parts[1])) {
                $audited_at .= '<br>' . $audited_parts[1];
            }
        }
    }

    // to control created and updated user visualization
    $creator = false;
    $editor = false;
    $hasCreator = false;
    $hasEditor = false;

    if(isset($model) && is_object($model)) {
        $creator = $model->creator;

        if($creator) {
            $hasCreator = true;
        }

        $editor = $model->editor;
        if($editor) {
            $hasEditor = true;
        }
    }
 
@endphp

@if(isset($created_at))
    <td class="app-td-date">

        <!-- updated by -->
        <div class="position-relative">
            <span>{!! $created_at !!}</span>
    
            @if ($hasCreator && !isRole('owner')) 
                <a href="javascript:;" data-toggle="tooltip" data-placement="bottom" title="{{ $creator->profile->full_name }}"
                    class="app-tooltip-person">
                    <i class="not-print material-icons">person</i>
                </a>
            @endif
        </div>

    </td>
@endif

@if(isset($updated_at))
    <td class="app-td-date"> 

        <!-- updated by -->
        <div class="position-relative">
            <span>{!! $updated_at !!}</span>

            @if ($hasEditor && !isRole('owner')) 
                <a href="javascript:;" data-toggle="tooltip" data-placement="bottom" title="{{ $editor->profile->full_name }}"
                    class="app-tooltip-person">
                    <i class="not-print material-icons">person</i>
                </a>
            @endif
        </div>

    </td>
@endif

@if(isset($audited_at))
    <td class="app-td-date">

        <!-- audited by -->
        <div class="position-relative">
            <span>{!! $audited_at !!}</span>

            @if (isset($auditedBy) && $auditedBy && !isRole('owner')) 
                <a href="javascript:;" data-toggle="tooltip" data-placement="bottom" title="{{ $auditedBy->profile->full_name }}"
                    class="app-tooltip-person">
                    <i class="not-print material-icons">person</i>
                </a>
            @endif
        </div>
    </td>
@endif
        
