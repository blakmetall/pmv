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

@endphp

@if(isset($created_at))
    <td class="app-td-date"> {!! $created_at !!}</td>
@endif

@if(isset($updated_at))
    <td class="app-td-date"> {!! $updated_at !!}</td>
@endif

@if(isset($audited_at))
    <td class="app-td-date">
        {!! $audited_at !!}

        @if (isset($auditedBy) && $auditedBy) 
            <div class="pt-1">
                <a href="{{ route('users.show', [$auditedBy->profile->user->id]) }}">
                    {{ $auditedBy->profile->full_name }}
                </a>
            </div>
        @endif
    </td>
@endif
        
