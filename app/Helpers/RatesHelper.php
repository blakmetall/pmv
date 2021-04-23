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

        // 1.- con el día a comparar:

        // 2.- obtener la tarifa aplicable de acuerdo al día a comparar (utilizando las fechas de la tarifa y la fecha del día)

        // 3.- obtener los días totales utilizables en la tarifa

        // 3.1.- de acuerdo al día primero y último de la reservación saber cuantos de estos días
        //       entran en el rango de fechas de esa  tarifa

        // 4.- de acuerdo a los días totales utilizables en la tarifa
        // obtener el costo por noche, semana (7), mes;
        // (para aplicar la tarifa de mes se requiere la utilización de un mes completo dentro de las fechas de la tarifa)

        // 5.- regresar:

        // 5.1.- costo por noche de acuerdo al costo por noche individual
        // 5.2.- costo por noche de acuerdo al costo por semana / 7 (divido entre 7)
        // 5.3.- costó por noche de acuerdo al costo por mes/(los días promedio que hay en un mes) = 30.4167
        // 5.4.- si las tarifas están vacías o se regresa un costo por noche de cero significará que no se puede reservar por alguna razón lo que deberá invalidar el registro del booking

        return $rates_property['nightly']; // price 200 per night -- dummy
    }

}
