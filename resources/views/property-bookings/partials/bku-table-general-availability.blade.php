@php
    $lang = LanguageHelper::current();
@endphp
<div class="mb-5"></div>
<div class="card">
    <div class="card-header">
        {{ $label }}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('Property') }}</th>
                        <th scope="col" colspan="14" style="text-align:center;">{{ __('Day') }}</th>
                        <th scope="col">{{ __('Rooms') }}</th>
                        <th scope="col">{{ __('Baths') }}</th>
                        <th scope="col">{{ __('Pax') }}</th>
                        <th scope="col">{{ __('Managed') }}</th>
                    </tr>

                </thead>
                <tbody>

                    @if(count($bookings))
                        @foreach($bookings as $booking)
                            @php
                                $managed     = ($booking->property->management)?__('YES'):__('NO');
                                $days        = getDatesFromRange($fromDate, $endDate, 'd-M-y');
                                $bookingDays = getDatesFromRange($booking->arrival_date, $booking->departure_date, 'd-M-y');
                                $firstDay = reset($bookingDays);
                                $endDay = end($bookingDays);
                            @endphp
                            <tr>
                                <!-- id -->
                                <th scope="row">
                                    {{ $booking->id }}
                                </th>

                                <!-- property -->
                                <td>
                                    {{ $booking->property->translations()->where('language_id', $lang->id)->first()->name}} <br/>
                                    {{ $booking->property->type->translations()->where('language_id', $lang->id)->first()->name }} |
                                    {{ $booking->property->zone->translations()->where('language_id', $lang->id)->first()->name }} |
                                    {{ $booking->property->zone->city->name }}
                                </td>

                                <!-- day -->
                                @foreach ($days as $day)
                                    @php
                                        if(in_array($day, $bookingDays)){
                                            $occupied = true;
                                        }else{
                                            $occupied = false;
                                        }
                                        if($day == $firstDay){
                                            $classDay = 'arrival-only';
                                        }else if($day == $endDay){
                                            $classDay = 'departure-only';
                                        }else{
                                            $classDay = '';
                                        }
                                    @endphp
                                    <td  class="{{ $classDay }}" style="background-color:{{ ($occupied)?'#D99694':'#C3D69B' }}">
                                        <span class="current-day">
                                            {{ $day }}
                                        </span>
                                    </td>
                                @endforeach

                                <!-- bedrooms -->
                                <td>{{ $booking->property->bedrooms }}</td>

                                <!-- baths -->
                                <td>{{ $booking->property->baths }}</td>

                                <!-- pax -->
                                <td>{{ $booking->property->pax }}</td>

                                <!-- managed -->
                                <td>{{ $managed }}</td>

                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>

    </div>
</div>
