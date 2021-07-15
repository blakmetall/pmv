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

    public static function getPropertyRate($property, $rates, $from_date = '', $to_date = '') {
        // prepare return data
        $data = [
            'totalDays' => 0,
            'total' => 0,
            'nightlyCurrentRate' => 0,
            'nightlyAppliedRate' => 0,
            'ratesPrices' => [],
        ];

        // prepare requested dates
        if(!$from_date || !$to_date) {
            $from_date = date('Y-m-d', strtotime('now'));
            $to_date = date('Y-m-d', strtotime('+7 days'));
        }

        // carbonize dates
        $from_date = Carbon::createFromFormat('Y-m-d', $from_date);
        $to_date = Carbon::createFromFormat('Y-m-d', $to_date);
        $requestDate = $from_date;
        $requestEndDate = $to_date;

        // set totalDays
        $data['totalDays'] = $from_date->diffInDays($to_date);

        // get property rates
        if($property->rates) {
            $rates = $property->rates()->orderBy('start_date', 'asc')->get();
            
            $rateApplied = false;

            foreach($rates as $k => $rate) {
                $nights = 0;
                $weeks = 0;
                $months = 0;

                // prepare rate carbonized dates
                $rate_start_date = Carbon::createFromFormat('Y-m-d', $rate->start_date);
                $rate_end_date = Carbon::createFromFormat('Y-m-d', $rate->end_date);

                if($rateApplied) { 
                    $rate_start_date->subDays(1);
                }

                if(
                    $requestDate->eq($rate_start_date) ||
                    $requestDate->eq($rate_end_date) || 
                    $requestDate->between($rate_start_date, $rate_end_date)) {
                    $rateApplied = false;

                    // if has monthly rate
                    if($rate->monthly && $rate->monthly > 0) {
                        // verify if current rate has more than one month ahead
                        $rateAvailableMonths = $requestDate->diffInMonths($rate_end_date);
                        if ($rateAvailableMonths) {
                            // verify if requested end date is between rate
                            $finalCompareDate = $requestEndDate;
                            if(!$requestEndDate->between($rate_start_date, $rate_end_date)) {
                                $finalCompareDate = $rate_end_date;
                            }

                            $requestMonths = $requestDate->diffInMonths($finalCompareDate);

                            if($requestMonths <= $rateAvailableMonths) {
                                $months = $requestMonths;
                            }else{
                                $months = $rateAvailableMonths;
                            }

                            $data['ratesPrices'][$rate->id]['months'] = $months;
                            $data['ratesPrices'][$rate->id]['monthlyRate'] = $rate->monthly;
                            $rateApplied = $months > 0;

                            // get next initial request date
                            $requestDate = $requestDate->addMonths($months);
                        }
                    }

                    // if has weekly rate
                    if($rate->weekly && $rate->weekly > 0) {
                        $rateAvailableWeeks = $requestDate->diffInWeeks($rate_end_date);
                        if($rateAvailableWeeks) {
                            // verify if requested end date is between rate
                            $finalCompareDate = $requestEndDate;
                            if(!$requestEndDate->between($rate_start_date, $rate_end_date)) {
                                $finalCompareDate = $rate_end_date;
                            }

                            $requestWeeks = $requestDate->diffInWeeks($finalCompareDate);

                            if($requestWeeks <= $rateAvailableWeeks) {
                                $weeks = $requestWeeks;
                            }else{
                                $weeks = $rateAvailableWeeks;
                            }

                            $data['ratesPrices'][$rate->id]['weeks'] = $weeks;
                            $data['ratesPrices'][$rate->id]['weeklyRate'] = $rate->weekly;
                            $rateApplied = $weeks > 0;

                            // get next initial request date
                            $requestDate->addWeeks($weeks);
                        }
                    }

                    // if has nightly rate
                    if($rate->nightly && $rate->nightly > 0) {
                        $rateAvailableDays = $requestDate->diffInDays($rate_end_date);
                        
                        if($rateAvailableDays) {
                            // verify if requested end date is between rate
                            $finalCompareDate = $requestEndDate;
                            if(!$requestEndDate->between($rate_start_date, $rate_end_date)) {
                                $finalCompareDate = $rate_end_date;
                            }

                            $requestDays = $requestDate->diffInDays($finalCompareDate);

                            if($requestDays <= $rateAvailableDays) {
                                $nights = $requestDays;
                            }else{
                                $nights = $rateAvailableDays;
                            }

                            $data['ratesPrices'][$rate->id]['nights'] = $nights;
                            $data['ratesPrices'][$rate->id]['nightlyRate'] = $rate->nightly;
                            $rateApplied = $nights > 0;
    
                            // get next initial request date
                            $requestDate->addDays($nights);
                        }


                        // sets the current nightly current rate
                        if(!$data['nightlyCurrentRate']) {
                            $data['nightlyCurrentRate'] = $rate->nightly;
                        }
                    }

                    // if($rateApplied) {
                    //     //$requestDate->addDays(1);
                    // }
                }
            }
        }

        // sum totals
        $subtotal = 0;
        
        foreach($data['ratesPrices'] as $ratePrice) {
            if(isset($ratePrice['months'])) {
                $subtotal += $ratePrice['months'] * $ratePrice['monthlyRate'];
            }

            if(isset($ratePrice['weeks'])) {
                $subtotal += $ratePrice['weeks'] * $ratePrice['weeklyRate'];
            }

            if(isset($ratePrice['nights'])) {
                $subtotal += $ratePrice['nights'] * $ratePrice['nightlyRate'];
            }
        }

        $data['total'] = round($subtotal, 2);
        $data['nightlyAppliedRate'] = round($subtotal / $data['totalDays'], 2);

        return $data;
    }

}
