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

@endphp


@if(isset($updated_at))
    <td class="app-td-date"> {!! $updated_at !!}</td>
@endif

@if(isset($created_at))
    <td class="app-td-date"> {!! $created_at !!}</td>
@endif
        
