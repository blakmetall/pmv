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

    <div class="px-4">
        <div class="table-responsive app-cleaning-table">
            <table class="table">
                <thead>
                    <tr>
                        <th class="cleaning-th-property">{{ __('Property') }}</th>
                        <th>{{ __('Services') }}</th>
                        @for($i = 1; $i <= $daysInMonth; $i++)
                            <th class="cleaning-th-days">{{ $i }}</th>
                        @endfor

                        <th class="cleaning-th-transaction">{{ __('Monthly Transaction') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($properties as $item)
                        @php
                            $monthlyCleaningServices = $item->property->monthlyCleaningServices($currentMonth->format('m'), $currentMonth->format('Y'))
                        @endphp

                        <tr>
                            <td class="cleaning-td-property">{{ $item->name }}</td>
                            <td class="cleaning-td-info">{{ count($monthlyCleaningServices) }}</td>

                            @for($i = 1; $i <= $daysInMonth; $i++)
                                @php
                                    $zero = ($i < 9)?'0':'';
                                @endphp
                                <td class="cleaning-td-days">
                                    <div class="cleaning-td-content">
                                        <a href="#" data-toggle="modal" data-property="{{ $item->property_id }}" data-maid-fee="{{ $item->property->maid_fee }}" data-load-fee="true" data-date="{{ $currentMonthFormat.'-'.$zero.$i }}" data-target="#{{$modalID }}" class="btn-add-service">
                                            <i class="i-Add"></i>
                                        </a>

                                        @if($monthlyCleaningServices)
                                            <div class="pt-2">
                                                @foreach ($monthlyCleaningServices as $cleaning_service)
                                                    @php
                                                    $modalEditID = 'cleaning-service-edit-' . strtotime('now') . rand(1,99999);
                                                    @endphp
                                                    @include('cleaning-services.partials.modal-edit', ['cleaning_service' => $cleaning_service->id])
                                                    @php
                                                        $date   = $cleaning_service->date;
                                                        $d      = new DateTime($date);
                                                        $status = ($cleaning_service->is_finished)?'finished':'open';
                                                    @endphp
                                                    @if($d->format('d') == $i)
                                                        <a href="#" data-toggle="modal" data-property="{{ $item->property_id }}" data-maid-fee="{{ $item->property->maid_fee }}" data-load-fee="false" data-date="{{ $currentMonthFormat.'-'.$zero.$i }}" data-target="#{{$modalEditID }}" class="cleaning-td-service cleaning-td-service-<?=$status?>">
                                                            #{{ $cleaning_service->id }}
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            @endfor

                            <td class="cleaning-td-days">
                                <a href="{{ route('property-management.generate-pm-transaction-monthly', $item->property_id) }}" class="btn-create-transaction">{{ __('Create') }}&nbsp;&nbsp;<i class="i-Add"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
