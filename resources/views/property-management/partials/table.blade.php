@php

    $skipRepeated = isset($skipRepeated) ? (bool) $skipRepeated : true;
    $repeatedIDS = [];

@endphp

<div class="mb-5"></div>
<div class="card">
    <div class="card-header">{{ $label }}</div>
    <div class="card-body pt-5">

        <!-- pagination is loeaded here -->
        @include('partials.pagination', ['rows' => $rows])

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('Property') }}</th>
                        <th scope="col">{{ __('Start Date') }}</th>
                        <th scope="col">{{ __('End Date') }}</th>
                        <th scope="col">{{ __('Fee') }}</th>

                        @if(!isRole('owner'))
                            <th scope="col">{{ __('Avg. Month') }}</th>
                            <th scope="col">{{ __('Finished') }}</th>
                        @endif

                        <th scope="col">&nbsp;</th>

                        @if(!isRole('owner'))
                            <th scope="col">&nbsp;</th>
                        @endif
                    </tr>

                </thead>
                <tbody>

                    @if(count($rows))
                        @foreach($rows as $row)

                            <!-- skip repeated control -->
                            @if (in_array($row->id, $repeatedIDS))
                                @php continue; @endphp
                            @endif
                            @php 
                                if (!in_array($row->id, $repeatedIDS)) {
                                    $repeatedIDS[] = $row->id;
                                }
                            @endphp

                            <tr>
                                <!-- id -->
                                <th scope="row">
                                    {{ $row->id }}
                                </th>

                                <!-- property -->
                                <td>
                                    @if ($row->property->hasTranslation())
                                        <a href="{{ route('properties.show', [$row->property->id]) }}">
                                            {{ $row->property->translate()->name }}
                                        </a>
                                    @endif
                                </td>

                                <!-- start_date -->
                                <td>{{ $row->start_date }}</td>

                                <!-- end_date -->
                                <td>{{ $row->end_date }}</td>

                                <!-- management_fee -->
                                <td>{{ priceFormat($row->management_fee) }} USD</td>

                                <!-- average_month -->
                                @if(!isRole('owner'))
                                    <td>{{ priceFormat($row->average_month) }} MXN</td>
                                    
                                    <!-- is_finished -->
                                    <td>{!! getStatusIcon($row->is_finished) !!}</td>
                                @endif


                                <td>
                                    <a href="{{ route('property-management-transactions', $row->id) }}" 
                                        alt="{{ __('Transactions') }}"
                                        class="text-primary mr-2">
                                        <i class="nav-icon i-Receipt-3 font-weight-bold"></i>
                                    </a>
                                </td>

                                <!-- actions -->
                                @if(!isRole('owner'))
                                    <td>
                                        @include('components.table.actions', [
                                            'params' => [$row->property->id, $row->id],
                                            'showRoute' => 'property-management.show',
                                            'editRoute' => 'property-management.edit',
                                            'deleteRoute' => 'property-management.destroy',
                                        ])
                                    </td>
                                @endif

                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>

        <!-- pagination is loeaded here -->
        @include('partials.pagination', ['rows' => $rows])

    </div>
</div>
