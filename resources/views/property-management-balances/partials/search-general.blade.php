@php

$url = isset($url) ? $url : '';
$searchedCity = isset($_GET['city']) ? $_GET['city'] : '';

$currentYear = date('Y', strtotime('now'));
$currentMonth = date('m', strtotime('now'));

$yearSearched = isset($_GET['year']) ? $_GET['year'] : $currentYear;
$monthSearched = isset($_GET['month']) ? $_GET['month'] : $currentMonth;

$isYearInProgress = $currentYear === $yearSearched;

$months = [
    '01' => __('January'),
    '02' => __('February'),
    '03' => __('March'),
    '04' => __('April'),
    '05' => __('May'),
    '06' => __('June'),
    '07' => __('July'),
    '08' => __('August'),
    '09' => __('September'),
    '10' => __('October'),
    '11' => __('November'),
    '12' => __('December'),
];

@endphp

<form action="" action="get">
    <div class="row pt-3 mb-4">

        @if (!isRole('owner'))
            <div class="col-sm-6 col-md-1">
                <select name="city" class="form-control">
                    <option value="">-- {{ __('City') }}</option>

                    @if ($cities)
                        @foreach ($cities as $city)
                            @php
                                $selected = $searchedCity == $city->id ? 'selected' : '';
                            @endphp

                            <option value="{{ $city->id }}" {{ $selected }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        @endif
        
        <div class="col-md-1">
            <select name="year" class="form-control select-year">
                @for ($i = 0; $i < 60; $i++)
                    @php
                        $inputYear = $currentYear - $i;
                        $selected = $yearSearched == $inputYear ? ' selected ' : '';
                    @endphp

                    <option value="{{ $inputYear }}" {{ $selected }}>
                        {{ $inputYear }}
                    </option>
                @endfor
            </select>
            <input type="hidden" name="month" value="{{ $monthSearched }}">
        </div>

        <div class="col-md-8">
            <ul class="app-months-list">
                @foreach ($months as $monthNumber => $month)
                    <li>
                        @php
                            
                            $urlParams = [
                                'city' => $searchedCity,
                                'year' => $yearSearched,
                                'month' => $monthNumber,
                            ];
                            $monthUrl = $url . '?' . http_build_query($urlParams);
                            
                            $monthColorClass = '';
                            if ($isYearInProgress) {
                                if ($monthNumber !== 1) {
                                    $monthColorClass = ' app-month-inactive ';
                                }
                            
                                if ($monthNumber > 1 && $currentMonth >= $monthNumber) {
                                    $monthColorClass = '';
                                }
                            }
                            
                            $selecteMonthClass = $monthSearched == $monthNumber ? ' app-month-selected ' : '';
                            
                        @endphp
                        <a href="{{ $monthUrl }}"
                            class="{{ $monthColorClass }} {{ $selecteMonthClass }}">
                            {{ $month }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        
        <div class="col-sm-6 col-md-2 app-search-buttons">
            <button class="btn btn-dark btn-icon mr-2" type="submit">
                <span class="ul-btn__icon">
                    <i class="i-Magnifi-Glass1"></i>
                </span>
            </button>

            @if (isset($_GET['city']))
                <a href="{{ $url }}" class="btn btn-outline-dark btn-icon" role="button">
                    <span class="ul-btn__icon">
                        <i class="i-Restore-Window"></i>
                    </span>
                </a>
            @endif
        </div>
    </div>

</form>

