<?php

namespace App\Helpers;

use Carbon\Carbon;

class RatesHelper
{
    public static function getTotalBookingDays($arriva_date, $departure_date)
    {
        // compare the available days between those two dates

        return 10; // 10 days (dummy)
    }

    public static function getNightsSubtotalCost($property, $arrival_date, $departure_date)
    {
        // for each day get the nightly rate using

        // --- self::getNightlyRate($property, $day, $arrival_date, $departure_date)

        // sum all nightly prices and return

        return 2000; // $2000 for then days (dummy)
    }

    public static function getNightlyRate($property, $day, $start_date, $end_date)
    {
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

        return 200; // price 200 per night -- dummy
    }
}
