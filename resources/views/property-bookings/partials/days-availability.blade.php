@php
    $bookings       = $property->bookings;
    $bookingDaysArr = [];
    $firstDays      = [];
    $endDays        = [];
    
    foreach ($bookings as $booking) {
        $bookingDaysArr[] = getDatesFromRange($booking->arrival_date, $booking->departure_date, 'd-M-y');
        $bookingDaysSE    = getDatesFromRange($booking->arrival_date, $booking->departure_date, 'd-M-y');
        $firstDays[]      = reset($bookingDaysSE);
        $endDays[]        = end($bookingDaysSE);
    }

    $bookingDays = arrayFlatten($bookingDaysArr);

@endphp

@foreach ($days as $day)
    @php
        if(in_array($day, $bookingDays)){
            $occupied = true;
        }else{
            $occupied = false;
        }

        if(in_array($day, $firstDays) && in_array($day, $endDays)){
            $classDay = 'arrival-departure-both';
        }else if(in_array($day, $firstDays)){
            $classDay = 'arrival-only';
        }else if(in_array($day, $endDays)){
            $classDay = 'departure-only';
        }else{
            $classDay = '';
        }
    @endphp

    <td class="{{ $classDay }}" style="background-color:{{ ($occupied)?'#D99694':'#C3D69B' }}">
        <span class="current-day">
            {{ $day }}
        </span>
    </td>
@endforeach