@php

    $url = route('cleaning-services.monthly-batch');

    $currentYear = date('Y', strtotime('now'));
    $currentMonth = date('m', strtotime('now'));

    $textSearched = isset($_GET['s']) ? $_GET['s'] : '';
    $yearSearched = isset($_GET['year']) ? $_GET['year'] : $currentYear;
    $monthSearched = isset($_GET['month']) ? $_GET['month'] : $currentMonth;

    $isYearInProgress = $currentYear === $yearSearched;

    $months = [
        1 => __('January'),
        2 => __('February'),
        3 => __('March'),
        4 => __('April'),
        5 => __('May'),
        6 => __('June'),
        7 => __('July'),
        8 => __('August'),
        9 => __('September'),
        10 => __('October'),
        11 => __('November'),
        12 => __('December'),
    ];

@endphp

<div class="container app-container mb-5">

    <div class="card">
        <div class="card-body">

            <form action="{{ $url }}" action="get">
                <div class="row pt-3">
                    <div class="col-md-2">
                        <select name="year" class="form-control" id="cleaning-option-batch-year-select">
                            @for($i = 0; $i < 60; $i++)
                                @php
                                    $inputYear = $currentYear - $i;
                                    $selected = ($yearSearched == $inputYear) ? ' selected ' : '';
                                @endphp

                                <option value="{{ $inputYear }}" {{ $selected }}>
                                    {{ $inputYear }}
                                </option>
                            @endfor
                        </select>
                        <input type="hidden" name="month" value="{{ $monthSearched }}">
                    </div>
                    <div class="col-md-10">
                        <ul class="app-months-list">

                            @foreach($months as $monthNumber => $month)
                                <li>
                                    @php

                                        $urlParams = [
                                            'year' => $yearSearched,
                                            'month' => $monthNumber,
                                        ];
                                        $monthUrl = $url . '?' . http_build_query($urlParams);

                                        $monthColorClass = '';
                                        if($isYearInProgress) {
                                            if($monthNumber !== 1) {
                                                // $monthColorClass = ' app-month-inactive ';
                                            }

                                            if($monthNumber > 1 && $currentMonth >= $monthNumber) {
                                                $monthColorClass = '';
                                            }
                                        }

                                        /*
                                        if(!monthHasPmTransactions($pm->id, $monthNumber, $yearSearched)) {
                                            $monthColorClass = ' app-month-inactive ';
                                        }
                                        */

                                        $selecteMonthClass = ($monthSearched == $monthNumber) ? ' app-month-selected ' : '';


                                    @endphp
                                    <a href="{{ $monthUrl }}" class="{{ $monthColorClass }} {{ $selecteMonthClass }}">
                                        {{ $month }}
                                    </a>
                                </li>
                            @endforeach
                           
                        </ul>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>