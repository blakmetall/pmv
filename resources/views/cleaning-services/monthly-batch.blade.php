@extends('layouts.horizontal-master')

@section('heading-content')

    @include('components.heading', ['label' => __('Monthly Batch')])

    <!-- separator -->
    <div class="mb-4"></div>

@endsection

@section('main-content')

    <?php
        $tmpProperties = [
            'property 1',
            'property 2',
            'property 3',
        ];

        $tmpDaysInMonth = 30;
    ?>

    <div class="px-4">
        <div class="table-responsive app-cleaning-table">
            <table class="table">
                <thead>
                    <tr>
                        <th class="cleaning-th-property">&nbsp;</th>
                        <th>&nbsp;</th>

                        @for($i = 0; $i < $tmpDaysInMonth; $i++)
                            <th class="cleaning-th-days">{{ $i + 1 }}</th>
                        @endfor

                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($tmpProperties as $tmpProperty)
                        <tr>
                            <td class="cleaning-td-property">{{ $tmpProperty}}</td>
                            <td>&nbsp;</td>

                            @for($i = 0; $i < $tmpDaysInMonth; $i++)
                                <td class="cleaning-td-days">
                                    <div class="cleaning-td-content">
                                        <a href="#">{{ __('Add') }}</a>

                                        {{-- fake services for some fake properties and some days --}}
                                        @if ($tmpProperty == 'property 1' && ($i == 2 || $i == 7 || $i == 21))
                                            <div class="pt-2">
                                                <a href="#" class="cleaning-td-service-finished">#44569</a>
                                                <a href="#" class="cleaning-td-service-finished">#44569</a>
                                            </div>
                                        @endif

                                        {{-- fake services for some fake properties and some days --}}
                                        @if ($tmpProperty == 'property 2' && ($i == 5 || $i == 9 || $i == 16))
                                            <div class="pt-2">
                                                <a href="#" class="cleaning-td-service-finished">#3831</a>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            @endfor

                            <td>
                                <a href="#">Crear transacción mensual</a>
                            </td>

                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
