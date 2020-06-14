@php


    $search = isset($_GET['s']) ? $_GET['s'] : '';
    $url = isset($url) ? $url : '';

    $yearSearched = isset($_GET['year']) ? $_GET['year'] : $currentYear;
    $monthSearched = isset($_GET['month']) ? $_GET['month'] : $currentMonth;

    $currentYear = date('Y', strtotime('now'));
    $currentMonth = date('m', strtotime('now'));

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

                <div class="row row-xs">
                    <div class="col-md-10">
                        <input 
                            class="form-control" 
                            placeholder="{{ __('Search...') }}" 
                            type="text" 
                            name="s" 
                            value="{{ $search }}"/>
                    </div>
                    <div class="col-md-2 text-md-right app-search-buttons">
                        <button class="btn btn-dark btn-icon mr-2" type="submit">
                            <span class="ul-btn__icon">
                                <i class="i-Magnifi-Glass1"></i>
                            </span>
                        </button>

                        @if(isset($_GET['s']))
                            <a href="{{ $url }}" class="btn btn-outline-dark btn-icon" role="button">
                                <span class="ul-btn__icon">
                                    <i class="i-Restore-Window"></i>
                                </span>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col-md-2">
                        <select name="year" class="form-control">
                            @for($i = 0; $i < 60; $i++)
                                @php
                                    $selected = ($yearSearched == ($currentYear - $i)) ? ' selected ' : '';
                                @endphp

                                <option value="{{ $currentYear - $i }}" {{ $selected }}>
                                    {{ $currentYear - $i }}
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

                                        $colorClass = '';

                                        if($isYearInProgress) {
                                            if($monthNumber !== 1) {
                                                $colorClass = ' app-month-inactive ';
                                            }

                                            if($monthNumber > 1 && $currentMonth >= $monthNumber) {
                                                $colorClass = '';
                                            }
                                        }

                                        $colorClass .= ($monthSearched == $monthNumber) ? ' app-month-selected ' : '';

                                        $urlParams = [
                                            's' => $search,
                                            'year' => $yearSearched,
                                            'month' => $monthNumber,
                                        ];
                                        $monthUrl = $url . '?' . http_build_query($urlParams);

                                    @endphp
                                    <a href="{{ $monthUrl }}" class="{{ $colorClass }}">
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