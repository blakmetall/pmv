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

                    @if(count($properties))
                        @foreach($properties as $index => $property)
                            @php
                                $managed     = ($property->management)?__('YES'):__('NO');
                                $days        = getDatesFromRange($fromDate, $endDate, 'd-M-y');
                            @endphp
                            <tr>
                                <!-- id -->
                                <th scope="row">
                                    {{ $property->id }}
                                </th>

                                <!-- property -->
                                <td>
                                    {{ $property->translations()->where('language_id', $lang->id)->first()->name}} <br/>
                                    {{ $property->type->translations()->where('language_id', $lang->id)->first()->name }} |
                                    {{ $property->zone->translations()->where('language_id', $lang->id)->first()->name }} |
                                    {{ $property->zone->city->name }}
                                </td>

                                <!-- day -->
                                @include('property-bookings.partials.days-availability', [
                                    'days' => $days,
                                    'property' => $property
                                ]);

                                <!-- bedrooms -->
                                <td>{{ $property->bedrooms }}</td>

                                <!-- baths -->
                                <td>{{ $property->baths }}</td>

                                <!-- pax -->
                                <td>{{ $property->pax }}</td>

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
