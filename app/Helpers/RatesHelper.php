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
            'nightlyAvgRate' => 0,
            'nightlyAppliedRate' => 0,
            'ratesPrices' => [],
            'prices' => [],
            'hasValidRate' => true,
        ];

        // prepare requested dates
        if(!$from_date || !$to_date) {
            $from_date = date('Y-m-d', strtotime('now'));
            $to_date = date('Y-m-d', strtotime('+7 days'));
        }

        // carbonize dates
        $compare_date = Carbon::createFromFormat('Y-m-d', $from_date);
        $from_date = Carbon::createFromFormat('Y-m-d', $from_date);
        $to_date = Carbon::createFromFormat('Y-m-d', $to_date);

        // set totalDays
        $data['totalDays'] = $from_date->diffInDays($to_date);
        
        // set the remaining days
        $remainingDays = $data['totalDays'] - 1;
        $appliedDays = 0;

        if($property->rates) {
            // get property rates
            $rates = $property->rates()->orderBy('start_date', 'asc')->get();


            while($remainingDays >= 0) {
                $remainingDays--;
                
                // get nightly price
                $nightlyRate = self::getNightlyRate($compare_date, $property, $rates, $to_date, $appliedDays);
                $data['prices'][$compare_date->toDateString()] = $nightlyRate;

                $appliedDays++;
                
                $compare_date->addDays(1);
            }
        }

        // sum totals
        $subtotal = 0;
        $savings = 0;
        
        foreach($data['prices'] as $date => $nightlyRate) {
            $subtotal += $nightlyRate['nightly'];
            $savings += $nightlyRate['savings'];

            if($nightlyRate['nightly'] == 0) {
                $data['hasValidRate'] = false;
            }
        }

        $data['total'] = round($subtotal, 2);
        $data['nightlyAppliedRate'] = $subtotal / $data['totalDays'];
        $data['nightlyAvgRate'] = ($subtotal + $savings) / $data['totalDays'];

        return $data;
    }

    private static function getNightlyRate($compare_date, $property, $rates, $to_date, $appliedDays) {
        $nightly = 0;
        $savings = 0;

        // days in month average
        $daysInMonth = 30.42;
        
        if($rates){
            foreach($rates as $rate) {
                $rate_start_date = Carbon::createFromFormat('Y-m-d', $rate->start_date);
                $rate_end_date = Carbon::createFromFormat('Y-m-d', $rate->end_date);

                if($compare_date->eq($rate_start_date) ||
                    $compare_date->eq($rate_end_date) ||  
                    $compare_date->between($rate_start_date, $rate_end_date)) {
                    
                        $rateAvailableNights = $compare_date->diffInDays($rate_end_date);
                        $rateAvailableNights += $appliedDays;

                        // calculate via months available
                        if($rate->monthly && $rate->monthly > 0 && $rateAvailableNights >= $daysInMonth) {
                            $nightly = $rate->monthly / $daysInMonth;
                            $savings = $rate->nightly - $nightly;
                        }else{
                            // calculate via weeks
                            if($rateAvailableNights >= 7) {
                                if($rate->weekly && $rate->weekly > 0) {
                                    $nightly = $rate->weekly / 7;
                                    $savings = $rate->nightly - $nightly;
                                }       
                            }else {
                                if($rate->nightly && $rate->nightly > 0) {
                                    $nightly = $rate->nightly;
                                    $savings = $rate->nightly - $nightly;
                                }
                            }
                        }
                }
            }
        }

        return [
            'nightly' => $nightly,
            'savings' => $savings
        ];
    }

    private static function isMonthlyRate() {

    }

}
