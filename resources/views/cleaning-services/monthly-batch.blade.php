@extends('layouts.horizontal-master')

@section('heading-content')
    @include('components.heading', ['label' => __('Monthly Batch')])

    <!-- separator -->
    <div class="mb-4"></div>
@endsection

@php
    $modalID = 'cleaning-service-create-' . strtotime('now') . rand(1,99999);
    $daysInMonth = $currentMonth->daysInMonth;
    $currentMonthFormat = $currentMonth->format('Y-m');
@endphp

@section('main-content')
    @include('cleaning-services.partials.modal-create')

    <div class="pt-5"></div>

    @include('cleaning-services.partials.monthly-batch-filter')

    @include('cleaning-services.partials.iconography')

    <div class="table-responsive app-cleaning-table">
        <table class="table">
            <thead>
                <tr>
                    <th class="cleaning-th-property">{{ __('Property') }}</th>
                    <th>{{ __('Services') }}</th>
                    @for($i = 1; $i <= $daysInMonth; $i++)
                        @php
                            $monthLoop = carbonCreate($currentMonth->year, $currentMonth->month, 0);
                            $monthLoop = $monthLoop->addDays($i);
                            $day = $monthLoop->format('l');
                        @endphp
                        <th class="cleaning-th-days">{{ $i }} ({{ __($day) }})</th>
                    @endfor

                    <th class="cleaning-th-transaction">{{ __('Monthly Transaction') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach($properties as $item)
                    @php
                        // filter by cleaning_staff_id
                        if($cleaning_staff_id) {
                            $staff_ids = $item->property->cleaning_staff_ids;

                            if(!$staff_ids) {
                                continue;
                            }

                            if( ! (is_array($staff_ids) && in_array($cleaning_staff_id, $staff_ids)) ) {
                                continue;
                            }
                        }
                    @endphp

                    @php
                        $monthlyCleaningServices = $item->property->monthlyCleaningServices($currentMonth->format('m'), $currentMonth->format('Y'));
                        switch ($item->property->cleaning_option_id) {
                            case 1:
                                //Daily
                                $color = 'green';
                                break;
                            case 2:
                                //Once a week
                                $color = 'white';
                                break;
                            case 3:
                                //Twice a week
                                $color = 'brown';
                                break;
                            case 4:
                                //Three times a week
                                $color = 'pink';
                                break;
                            case 5:
                                //Every 15 days
                                $color = 'yellow';
                                break;
                            case 6:
                                //Once a month
                                $color = 'purple';
                                break;
                            case 7:
                                //Never
                                $color = 'black';
                                break;
                            case 8:
                                //N/A
                                $color = 'red';
                                break;
                            default:
                                $color = 'white';
                                break;
                        }
                    @endphp

                    <tr class="hoverable">
                        <td class="cleaning-td-property hover-action">
                            <div class="monthly-batch-iconography">
                                <div class="square-clean" style="background-color:{{ $color }}"></div>
                                <a href="#" data-toggle="modal" data-source="{{ $item->property_id }}" data-year="{{ $currentMonth->format('Y') }}"
                                    data-target="#modal-availability-modal">
                                    <i class="nav-icon i-Calendar-4 font-weight-bold"></i>&nbsp;&nbsp;&nbsp;
                                </a>
                                <div>{{ $item->name }}</div>
                            </div>
                        </td>
                        <td class="cleaning-td-info">{{ count($monthlyCleaningServices) }}</td>

                        @for($i = 1; $i <= $daysInMonth; $i++)
                            @php
                                $zero = ($i < 10)?'0':'';
                            @endphp
                            <td class="cleaning-td-days">
                                <div class="cleaning-td-content">
                                    <a href="#" data-toggle="modal" data-property="{{ $item->property_id }}" data-maid-fee="{{ $item->property->maid_fee }}" data-load-fee="true" data-date="{{ $currentMonthFormat.'-'.$zero.$i }}" data-target="#{{$modalID }}" class="btn-add-service">
                                        {{ $i }} &nbsp; <i class="i-Add"></i>
                                    </a>

                                    @if($monthlyCleaningServices)
                                        <div class="pt-2">
                                            @foreach ($monthlyCleaningServices as $cleaning_service)
                                                @php
                                                $modalEditID = 'cleaning-service-edit-' . strtotime('now') . rand(1,99999);
                                                @endphp
                                                @include('cleaning-services.partials.modal-edit', ['cleaning_service' => $cleaning_service->id])
                                                @php
                                                    $date        = $cleaning_service->date;
                                                    $d           = new DateTime($date);
                                                    $currentDate = new DateTime();
                                                    if($cleaning_service->is_finished){
                                                        $status = 'finished';
                                                    }else{
                                                        if($d < $currentDate){
                                                            $status = 'open';
                                                        }else{
                                                            $status = 'overdue';
                                                        }
                                                    }
                                                @endphp
                                                @if($d->format('d') == $i)
                                                    <a href="#" data-toggle="modal" data-property="{{ $item->property_id }}" data-maid-fee="{{ $item->property->maid_fee }}" data-load-fee="false" data-date="{{ $currentMonthFormat.'-'.$zero.$i }}" data-target="#{{$modalEditID }}" class="cleaning-td-service cleaning-td-service-<?=$status?>">
                                                        #{{ $cleaning_service->id }} <br>
                                                        @foreach ( $cleaning_service->cleaningServicesStatus as $css)
                                                            {{ $css->name }}
                                                        @endforeach
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </td>
                        @endfor

                        <td class="cleaning-td-days">
                            @if(can('edit', 'cleaning-services'))
                                <a href="{{ route('property-management.generate-pm-transaction-monthly', [$item->property_id, $_GET['year'], $_GET['month']]) }}" class="btn-create-transaction">
                                    {{ __('Create') }}&nbsp;&nbsp;<i class="i-Add"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
