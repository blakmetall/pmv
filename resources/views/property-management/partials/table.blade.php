@php

    $skipRepeated = isset($skipRepeated) ? (bool) $skipRepeated : true;
    $repeatedIDS = [];

@endphp

<div class="mb-3"></div>

<div class="d-inline">
    <?= __('Properties') ?>: {{ $total }}
</div>
<div class="ml-3 d-inline text-success">
    <?= __('Active') ?>: {{ $active }}
</div>
<div class="ml-3 d-inline text-danger">
    <?= __('Finished') ?>: {{ $finished }}
</div>

<div class="mb-2"></div>
<!-- unfinished table -->

<div class="table-responsive">
    <table class="table table-striped">
        <thead>

            <tr>
                <th scope="col">{{ __('Property ID') }}</th>
                <th scope="col">{{ __('Property') }}</th>
                <th scope="col">{{ __('Start Date') }}</th>
                <th scope="col">{{ __('Fee') }}</th>

                @if (!isRole('owner'))
                    <th scope="col" width="15%">&nbsp;</th>
                @endif
            </tr>

        </thead>
        <tbody>

            @if (count($rows))
                @foreach ($rows as $row)

                    <!-- show only non finished -->
                    @php
                        if ($row->is_finished) {
                            continue;
                        }
                    @endphp

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
                        {{-- <th scope="row">
                            {{ $row->id }}
                        </th> --}}

                        <!-- Property id -->
                        <th scope="row">
                            {{ $row->property->id }}
                        </th>

                        <!-- property -->
                        <td>
                            @if ($row->property->hasTranslation())
                                <a href="{{ route('property-management.show', [$row->property->id, $row->id]) }}"
                                    class="underline">
                                    {{ $row->property->translate()->name }}
                                </a>
                            @endif
                        </td>

                        <!-- start_date -->
                        <td>{{ $row->start_date }}</td>

                        <!-- management_fee -->
                        <td>{{ priceFormat($row->management_fee) }} USD</td>

                        {{-- <td>
                            <a href="{{ route('property-management-transactions', [$row->id]) }}" 
                                alt="{{ __('Transactions') }}"
                                class="text-primary mr-2">
                                <i class="nav-icon i-Receipt-3 font-weight-bold"></i>
                            </a>
                        </td> --}}

                        <!-- actions -->
                        @if (!isRole('owner'))
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



@php

$hasFinishedPropertyManagements = false;
foreach ($rows as $row) {
    if ($row->is_finished) {
        $hasFinishedPropertyManagements = true;
        break;
    }
}

@endphp


@if ($hasFinishedPropertyManagements)
    <!-- finished table -->
    <div class="mb-5"></div>
    
    <div class="container app-container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="breadcrumb app-breadcrumb">
                        <h2>Finished</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">{{ __('Property ID') }}</th>
                    <th scope="col">{{ __('Property') }}</th>
                    <th scope="col">{{ __('Start Date') }}</th>
                    <th scope="col">{{ __('Fee') }}</th>

                    @if (!isRole('owner'))
                        <th scope="col" width="15%">&nbsp;</th>
                    @endif
                </tr>
            </thead>

            <tbody>
                @if (count($rows))
                    @foreach ($rows as $row)

                        <!-- show only finished filter -->
                        @php
                            if (!$row->is_finished) {
                                continue;
                            }
                        @endphp

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
                            {{-- <th scope="row">
                                {{ $row->id }}
                            </th> --}}

                            <!-- property id -->
                            <th scope="row">
                                {{ $row->property->id }}
                            </th>

                            <!-- property -->
                            <td>
                                @if ($row->property->hasTranslation())
                                    <a href="{{ route('properties.show', [$row->property->id]) }}"
                                        class="underline">
                                        {{ $row->property->translate()->name }}
                                    </a>
                                @endif
                            </td>

                            <!-- start_date -->
                            <td>{{ $row->start_date }}</td>

                            <!-- management_fee -->
                            <td>{{ priceFormat($row->management_fee) }} USD</td>

                            {{-- <td>
                                <a href="{{ route('property-management-transactions', [$row->id]) }}" 
                                    alt="{{ __('Transactions') }}"
                                    class="text-primary mr-2">
                                    <i class="nav-icon i-Receipt-3 font-weight-bold"></i>
                                </a>
                            </td> --}}

                            <!-- actions -->
                            @if (!isRole('owner'))
                                <td>
                                    @include('components.table.actions', [
                                    'params' => [$row->property->id, $row->id],
                                    'showRoute' => 'property-management.show',
                                    'editRoute' => 'property-management.edit',
                                    'deleteRoute' => 'property-management.destroy',
                                    'skipDelete' => true,
                                    ])
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endif
