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

        $rates_property = [
            'nightly' => 0,
            'weekly'  => 0,
            'monthly' => 0
        ];

        $average_cost = 0;

        foreach ($rates as $rate) {
            $rate_start_date = Carbon::createFromFormat('Y-m-d', $rate->start_date);
            $rate_end_date = Carbon::createFromFormat('Y-m-d', $rate->end_date);

            $search_arrival_date = $arrival_date->between($rate_start_date, $rate_end_date);
            $search_departure_date = $departure_date->between($rate_start_date, $rate_end_date);

            if ($search_arrival_date) {
                $rates_property['nightly'] += $rate->nightly;
                $rates_property['weekly'] += $rate->weekly;
                $rates_property['monthly'] += $rate->monthly;
            };

            if ($search_departure_date) {
                $rates_property['nightly'] += $rate->nightly;
                $rates_property['weekly'] += $rate->weekly;
                $rates_property['monthly'] += $rate->monthly;
            };
        }

        return $rates_property['nightly'];
    }

}
