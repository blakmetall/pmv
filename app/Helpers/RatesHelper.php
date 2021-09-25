<?php

namespace App\Helpers;

use Carbon\Carbon;

class RatesHelper
{
    public static function getTotalBookingDays($arrival_date_str, $departure_date_str)
    {
        $arrival_date = Carbon::createFromFormat('Y-m-d', $arrival_date_str);
        $departure_date = Carbon::createFromFormat('Y-m-d', $departure_date_str);

        return $arrival_date->diffInDays($departure_date);
    }

    public static function getPropertyRate($property, $notUserates, $from_date = '', $to_date = '')
    {
        // prepare return data
        $data = [
            'totalDays' => 0,
            'total' => 0,
            'nightlyAvgRate' => 0,
            'nightlyAppliedRate' => 0,
            'ratesPrices' => [],
        ];

        // prepare requested dates
        if (!$from_date || !$to_date) {
            $from_date = date('Y-m-d', strtotime('now'));
            $to_date = date('Y-m-d', strtotime('+7 days'));
        }

        // carbonize dates
        $from_date = Carbon::createFromFormat('!Y-m-d', $from_date);
        $to_date = Carbon::createFromFormat('!Y-m-d', $to_date);
        $requestDate = $from_date;
        $requestEndDate = $to_date;

        // regular average nightly
        $nightlyAmount = 0;

        // set totalDays
        $data['totalDays'] = $from_date->diffInDays($to_date);

        // get property rates
        if ($property->rates) {
            $rates = $property->rates()->orderBy('start_date', 'asc')->get();
            $rateApplied = false;
            // $rateAppliedMonths = false;
            // $rateAppliedWeeks = false;
            // $rateAppliedNights = false;
            foreach ($rates as $k => $rate) {
                $nights = 0;
                $weeks = 0;
                $months = 0;

                // prepare rate carbonized dates
                $rate_start_date = Carbon::createFromFormat('!Y-m-d', $rate->start_date);
                $rate_one_day_before = Carbon::createFromFormat('!Y-m-d', $rate->start_date);
                $rate_end_date = Carbon::createFromFormat('!Y-m-d', $rate->end_date);

                // if ($rateAppliedMonths && $rateAppliedWeeks && $rateAppliedNights) {
                //     $rate_one_day_before->subDays(1);
                // }

                // if ($rateApplied) {
                //     $rate_one_day_before->subDays(1);
                // }

                if (
                    $requestDate->eq($rate_start_date) ||
                    $requestDate->eq($rate_end_date) ||
                    $requestDate->between($rate_start_date, $rate_end_date)
                ) {
                    $data['ratesPrices'][$rate->id]['monthlyDiscount']   = 0;
                    $data['ratesPrices'][$rate->id]['monthsRateOneDayBefore'] = 0;
                    $data['ratesPrices'][$rate->id]['monthsRequestDate'] = 0;
                    $data['ratesPrices'][$rate->id]['monthsCompareDate'] = 0;
                    $data['ratesPrices'][$rate->id]['monthlyDiscount']   = 0;
                    $data['ratesPrices'][$rate->id]['monthlyTotal']      = 0;
                    $data['ratesPrices'][$rate->id]['weeklyDiscount']    = 0;
                    $data['ratesPrices'][$rate->id]['weeksRateOneDayBefore'] = 0;
                    $data['ratesPrices'][$rate->id]['weeksRequestDate']  = 0;
                    $data['ratesPrices'][$rate->id]['weeksCompareDate']  = 0;
                    $data['ratesPrices'][$rate->id]['weeklyTotal']       = 0;
                    $data['ratesPrices'][$rate->id]['nightlyDiscount']   = 0;
                    $data['ratesPrices'][$rate->id]['nightsRateOneDayBefore'] = 0;
                    $data['ratesPrices'][$rate->id]['nightsRequestDate'] = 0;
                    $data['ratesPrices'][$rate->id]['nightsCompareDate'] = 0;
                    $data['ratesPrices'][$rate->id]['nightlyTotal']      = 0;

                    // if has monthly rate
                    if ($rate->monthly && $rate->monthly > 0) {
                        // verify if current rate has more than one month ahead
                        $rateAvailableMonths = $requestDate->diffInMonths($rate_end_date);
                        if ($rateAvailableMonths) {

                            // verify if requested end date is between rate
                            $finalCompareDate = $requestEndDate;
                            if (!$requestEndDate->between($rate_start_date, $rate_end_date)) {
                                $finalCompareDate = $rate_end_date;
                            }

                            $requestMonths = $requestDate->diffInMonths($finalCompareDate);
                            //ESTO LO PUSE LA ULTIMA VEZ
                            $requestDaysMonths = $requestDate->diffInDays($finalCompareDate);

                            if ($requestMonths <= $rateAvailableMonths) {
                                $months = $requestMonths;
                            } else {
                                $months = $rateAvailableMonths;
                            }

                            //$rateAppliedMonths = $months > 0;
                            $rateApplied = $months > 0;

                            //$rateAppliedMonths
                            if ($rateApplied) {
                                //ESTO LO PUSE LA ULTIMA VEZ
                                $nightlyMonthlyTotal = $rate->nightly * $requestDaysMonths;

                                $data['ratesPrices'][$rate->id]['months'] = $months;
                                $data['ratesPrices'][$rate->id]['monthsRateOneDayBefore'] = $rate_one_day_before->format('Y-m-d');
                                $data['ratesPrices'][$rate->id]['monthsRequestDate'] = $requestDate->format('Y-m-d');
                                $data['ratesPrices'][$rate->id]['monthsCompareDate'] = $finalCompareDate->format('Y-m-d');
                                $data['ratesPrices'][$rate->id]['monthlyRate'] = $rate->monthly;
                                $data['ratesPrices'][$rate->id]['monthlyTotal'] = $rate->monthly * $months;
                                $data['ratesPrices'][$rate->id]['monthlyDiscount'] = $nightlyMonthlyTotal;
                            }

                            // get next initial request date
                            $requestDate->addMonths($months);
                        }
                    }

                    // if has weekly rate
                    if ($rate->weekly && $rate->weekly > 0) {

                        $rateAvailableWeeks = $requestDate->diffInWeeks($rate_end_date);

                        if ($rateAvailableWeeks) {
                            // verify if requested end date is between rate
                            $finalCompareDate = $requestEndDate;
                            // if ($property->id == 27) {
                            //     dd($finalCompareDate);
                            // }
                            if (!$requestEndDate->between($rate_start_date, $rate_end_date)) {
                                $finalCompareDate = $rate_end_date;
                                // $finalCompareDate->addDays(1);
                            }

                            $requestWeeks = $requestDate->diffInWeeks($finalCompareDate);
                            $requestDaysWeeks = $requestDate->diffInDays($finalCompareDate);

                            if ($requestWeeks <= $rateAvailableWeeks) {
                                $weeks = $requestWeeks;
                            } else {
                                $weeks = $rateAvailableWeeks;
                            }

                            // $rateAppliedWeeks = $weeks > 0;
                            $rateApplied = $weeks > 0;

                            //$rateAppliedWeeks
                            if ($rateApplied) {
                                $nightlyWeeklyTotal = $rate->nightly * $requestDaysWeeks;

                                $data['ratesPrices'][$rate->id]['weeks'] = $weeks;
                                $data['ratesPrices'][$rate->id]['weeksRateOneDayBefore'] = $rate_one_day_before->format('Y-m-d');
                                $data['ratesPrices'][$rate->id]['weeksRequestDate'] = $requestDate->format('Y-m-d');
                                $data['ratesPrices'][$rate->id]['weeksCompareDate'] = $finalCompareDate->format('Y-m-d');
                                $data['ratesPrices'][$rate->id]['weeklyRate'] = $rate->weekly;
                                $data['ratesPrices'][$rate->id]['weeklyTotal'] = $rate->weekly * $weeks;
                                $data['ratesPrices'][$rate->id]['weeklyDiscount'] = $nightlyWeeklyTotal;
                            }

                            // get next initial request date
                            $requestDate->addWeeks($weeks);
                        }
                    }
                    // if has nightly rate
                    if ($rate->nightly && $rate->nightly > 0) {
                        $rateAvailableDays = $requestDate->diffInDays($rate_end_date);

                        if ($rateAvailableDays || $requestDate->eq($rate_end_date)) {
                            // verify if requested end date is between rate
                            $finalCompareDate = $requestEndDate;
                            if (!$requestEndDate->between($rate_start_date, $rate_end_date)) {
                                $finalCompareDate = $rate_end_date;
                            }

                            $requestDays = $requestDate->diffInDays($finalCompareDate);

                            if ($requestDays <= $rateAvailableDays) {
                                $nights = $requestDays;
                            } else {
                                $nights = $rateAvailableDays;
                            }

                            if ($nights == 0 && $finalCompareDate->eq($requestEndDate)) {
                                $nights += 1;
                            }

                            $rateApplied = $nights > 0;

                            //$rateAppliedNights
                            if ($rateApplied) {
                                $nightlyDayTotal = $rate->nightly * $nights;

                                $data['ratesPrices'][$rate->id]['nights'] = $nights;
                                $data['ratesPrices'][$rate->id]['nightsRateOneDayBefore'] = $rate_one_day_before->format('Y-m-d');
                                $data['ratesPrices'][$rate->id]['nightsRequestDate'] = $requestDate->format('Y-m-d');
                                $data['ratesPrices'][$rate->id]['nightsCompareDate'] = $finalCompareDate->format('Y-m-d');
                                $data['ratesPrices'][$rate->id]['nightlyRate'] = $rate->nightly;
                                $data['ratesPrices'][$rate->id]['nightlyTotal'] = $rate->nightly * $nights;
                                $data['ratesPrices'][$rate->id]['nightlyDiscount'] = $nightlyDayTotal;
                            }
                            // get next initial request date
                            $requestDate->addDays($nights);
                        }
                    }
                    $requestDate->addDays(1);
                }
            }
        }

        // sum totals
        $subtotal = 0;

        // ESTO LO USABA PARA QUITAR LOS SETEADOS EN 0 PERO YA NO SE NECESITA PUSE LOS INDEX DENTRO DEL FOREACH ENTONCES LOS 0 NO SE CONSTRUYEN
        // dd($data['ratesPrices']);
        foreach ($data['ratesPrices'] as $index => $ratePrice) {
            if ($ratePrice['monthsRequestDate'] >= $to_date->format('Y-m-d')) {
                unset($data['ratesPrices'][$index]);
            }
            if ($ratePrice['weeksRequestDate'] >= $to_date->format('Y-m-d')) {
                unset($data['ratesPrices'][$index]);
            }
            // if ($ratePrice['nightsRequestDate'] >= $to_date->format('Y-m-d')) {
            //     unset($data['ratesPrices'][$index]);
            // }
        }

        foreach ($data['ratesPrices'] as $ratePrice) {
            if (isset($ratePrice['months'])) {
                $subtotal += $ratePrice['monthlyTotal'];
                $nightlyAmount += $ratePrice['monthlyDiscount'];
            }

            if (isset($ratePrice['weeks'])) {
                $subtotal += $ratePrice['weeklyTotal'];
                $nightlyAmount += $ratePrice['weeklyDiscount'];
            }

            if (isset($ratePrice['nights'])) {
                $subtotal += $ratePrice['nightlyTotal'];
                $nightlyAmount += $ratePrice['nightlyDiscount'];
            }
        }

        $data['total'] = round($subtotal, 2);
        $data['nightlyAmount'] = round($nightlyAmount, 2);
        $data['nightlyAppliedRate'] = $data['totalDays'] > 0 ? round($subtotal / $data['totalDays'], 2) : 0;
        // sets the current nightly current rate
        $data['nightlyAvgRate'] = round($nightlyAmount /  $data['totalDays'], 2);

        // if ($property->id == 149) {
        //     dd($data);
        // }
        return $data;
    }
}
