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

        $rates = $property->rates;
        $nightly = 0;

        foreach($rates as $k => $rate) {

            $start_date = Carbon::createFromFormat('Y-m-d', $rate->start_date);
            $end_date = Carbon::createFromFormat('Y-m-d', $rate->end_date);

            if($arrival_date->between($start_date, $end_date)){
                $nightly = $rate->nightly;
            }
        }


        return $nightly;
    }

    public static function getPropertyRate($property, $rates, $from_date, $to_date) {
        $data = [
            'totalDays' => 100,
            'total' => 10000,
            'nightlyCurrentRate' => 130,
            'nightlyAppliedRate' => 100,
        ];

        return $data;
    }

}
