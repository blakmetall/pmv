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

    public static function getNightsSubtotalCost($property, $arrival_date_str, $departure_date_str)
    {
        if(!$arrival_date_str || !$departure_date_str) {
            $arrival_date_str = date('Y-m-d', strtotime('now'));
            $departure_date_str = date('Y-m-d', strtotime('+7 days'));
        }

        $arrival_date = Carbon::createFromFormat('Y-m-d', $arrival_date_str);
        $departure_date = Carbon::createFromFormat('Y-m-d', $departure_date_str);

        $cost = 0;
        $totalNights = self::getTotalBookingDays($arrival_date_str, $departure_date_str);

        if ($totalNights > 0) {
            for ($i = 0; $i < $totalNights; ++$i) {
                $compare_day_date = $arrival_date->addDays($i);

                $nightlyCost = self::getNightlyRate($property, $compare_day_date, $arrival_date_str, $departure_date_str);

                $cost += $nightlyCost;
            }
        }

        return $cost;
    }

    public static function getNightlyRate($property, $day_date, $arrival_date_str, $departure_date_str)
    {
        if(!$arrival_date_str || !$departure_date_str) {
            $arrival_date_str = date('Y-m-d', strtotime('now'));
            $departure_date_str = date('Y-m-d', strtotime('+7 days'));
        }

        $arrival_date = Carbon::createFromFormat('Y-m-d', $arrival_date_str);
        $departure_date = Carbon::createFromFormat('Y-m-d', $departure_date_str);
        $new_arrival_date = $arrival_date;

        $requestedDays = self::getTotalBookingDays($arrival_date_str, $departure_date_str);
        $remainingDays = $requestedDays;

        $rates = $property->rates;

        $nightlyPrice = 0;

        $rates_property = [
            'nightly' => 0,
            'weekly'  => 0,
            'monthly' => 0
        ];

        // echo '<pre>', print_r($rates), '</pre>';

        
        foreach($rates as $k => $rate) {

            $start_date = Carbon::createFromFormat('Y-m-d', $rate->start_date);
            $end_date = Carbon::createFromFormat('Y-m-d', $rate->end_date);

            if($k !== 0) {
                $new_arrival_date = $new_arrival_date->addDays($remainingDays);
            }
            
            // max allowed rate days
            $maxRateDays = $new_arrival_date->diffInDays($end_date);

            // check if there is more remaining days
            if($remainingDays > 0) {
                // checks if the remaining days are lesser than the  max rate days
                if($remainingDays <= $maxRateDays) {
                    // add next month to calculate montly payment
                    $nextMonth = $start_date->addMonth();
                    $nextMonthDays = $start_date->diffInDays($nextMonth);
    
                    // check if remaining days is greater than the next month
                    if($remainingDays <= $nextMonthDays && ($new_arrival_date->between($start_date, $end_date))) {
                        // if remaining days greater than weekly date
                        if($remainingDays >= 7 && ($departure_date->between($start_date, $end_date))) {
                            // do weekly calculations
                        }
                    }else {
                        if($remainingDays >= 7) {
                            // do remaining weekly calculation
                            $rateWeeks = floor($remainingDays / 7);    
                            $rates_property['weekly'] = $rates_property['weekly'] + ($rateWeeks * $rate->weekly);
                            $remainingDays = $remainingDays - ($rateWeeks * 7);
                        }else {
                            // do remaining nightly calculation
                            $nightlyRemainingDays = $remainingDays;
                            $rates_property['nightly'] = $rates_property['nightly'] + ($remainingDays * $rate->nightly);
                            $remainingDays = $remainingDays - $nightlyRemainingDays;
                        }
    
                    }
                    
                }else {
                    if($maxRateDays >= 7) { 
                        // do remaining weekly calculation
                        $rateWeeks = floor($remainingDays / 7);    
                        $rates_property['weekly'] = $rates_property['weekly'] + ($rateWeeks * $rate->weekly);
                        $remainingDays = $remainingDays - ($rateWeeks * 7);
                    }else {
                        // do remaining nightly calculation
                        $rates_property['nightly'] = $rates_property['nightly'] + (($maxRateDays) * $rate->nightly);
                        $remainingDays = $remainingDays - $maxRateDays;
                    }
                }
            }
        }

        $totalCost = $rates_property['nightly'] + $rates_property['weekly'] + $rates_property['monthly'];

        return $totalCost / $requestedDays;
    }

}
