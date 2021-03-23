@php
    $lang = LanguageHelper::current();
@endphp

<div class="mb-5"></div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">{{ __('Property') }}</th>
                <th scope="col" colspan="14" style="text-align:center">{{ __('Day') }}</th>
                <th scope="col">{{ __('Bedrooms') }}</th>
                <th scope="col">{{ __('Baths') }}</th>
                <th scope="col">{{ __('Pax') }}</th>
                <th scope="col">{{ __('Managed') }}</th>
            </tr>
        </thead>

        <tbody>

            @if (count($properties))
                @foreach ($properties as $index => $property)
                    @php
                        $managed = ($property->management)?__('YES'):__('NO');
                        $days = getDatesFromRange($fromDate, $endDate, 'd-M-y');
                    @endphp

                    <tr>
                        <!-- index -->
                        <th scope="row">
                            {{ $index + 1 }}
                        </th>

                        <!-- id -->
                        <th scope="row">
                            {{ $property->id }}
                        </th>

                        <!-- property -->
                        <td>
                            {{ $property->translate()->name }} <br />
                            {{ $property->type->translate()->name }} |
                            {{ $property->zone->translate()->name }} |
                            {{ $property->zone->city->name }}
                        </td>

                        <!-- day -->
                        @include('property-bookings.partials.days-availability', [
                            'days' => $days,
                            'property' => $property
                        ])

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
