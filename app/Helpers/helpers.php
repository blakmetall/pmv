<?php

use Carbon\Carbon;
use App\Helpers\RatesHelper;
use App\Helpers\LanguageHelper;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DetailsBooking;
use App\Models\City;
use App\Models\Office;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyTypeTranslation;

if (!function_exists('prepareFormInputName')) {
    function prepareFormInputName($name, $parentName, $lang)
    {
        $inputName = $name;
        if ($lang) {
            if ($parentName) {
                $inputName = "{$lang}[{$parentName}][$name]";
            } else {
                $inputName = "{$lang}[{$name}]";
            }
        } elseif ($parentName) {
            $inputName = "{$parentName}[{$name}]";
        }

        return $inputName;
    }
}

if (!function_exists('prepareFormRequestName')) {
    function prepareFormRequestName($name, $parentName, $lang)
    {
        $requestName = $name;
        if ($lang) {
            if ($parentName) {
                $requestName = "{$lang}.{$parentName}.{$name}";
            } else {
                $requestName = "{$lang}.{$name}";
            }
        } elseif ($parentName) {
            $requestName = "{$parentName}.{$name}";
        }

        return $requestName;
    }
}

if (!function_exists('isORMObj')) {
    function isORMObj($obj)
    {
        return method_exists($obj, 'count');
    }
}

if (!function_exists('prepareCheckboxValuesFromRows')) {
    function prepareCheckboxValuesFromRows($items, $config = [])
    {
        $shouldLoopForValues = (isORMObj($items) && $items->count()) || (!isORMObj($items) && is_array($items));
        $values = [];

        if ($shouldLoopForValues) {
            $valueRef = isset($config['valueRef']) ? $config['valueRef'] : 'id'; // default id
            $labelRef = isset($config['labelRef']) ? $config['labelRef'] : 'name'; // default name
            $secondLabelRef = isset($config['secondLabelRef']) ? $config['secondLabelRef'] : ''; // default empty

            foreach ($items as $item) {
                $labelRefValue = isset($item->{$labelRef}) ? $item->{$labelRef} : '';
                $secondLabelRefValue = isset($item->{$secondLabelRef}) ? $item->{$secondLabelRef} : '';

                $values[] = [
                    'label' => trim($labelRefValue . ' ' . $secondLabelRefValue),
                    'value' => isset($item->{$valueRef}) ? $item->{$valueRef} : '',
                ];
            }
        }

        return $values;
    }
}

if (!function_exists('prepareCheckboxDefaultValues')) {
    function prepareCheckboxDefaultValues($items, $config = [])
    {
        $shouldLoopForValues = (isORMObj($items) && $items->count()) || (!isORMObj($items) && is_array($items));
        $defaultValues = [];

        if ($shouldLoopForValues) {
            $valueRef = isset($config['valueRef']) ? $config['valueRef'] : 'id'; // default id

            foreach ($items as $item) {
                $defaultValues[] = isset($item->{$valueRef}) ? $item->{$valueRef} : '';
            }
        }

        return $defaultValues;
    }
}

if (!function_exists('prepareSelectValuesFromRows')) {
    function prepareSelectValuesFromRows($items, $config = [])
    {
        $shouldLoopForValues = (isORMObj($items) && $items->count()) || (!isORMObj($items) && is_array($items));
        $values = [];

        if ($shouldLoopForValues) {
            $valueRef = isset($config['valueRef']) ? $config['valueRef'] : 'id'; // default id
            $labelRef = isset($config['labelRef']) ? $config['labelRef'] : 'name'; // default name
            $depthRef = isset($config['depthRef']) ? $config['depthRef'] : false; // default name

            if ($depthRef) {
                $optionLabelDepth = explode(',', $labelRef);
            }

            foreach ($items as $item) {
                if ($depthRef) {
                    $label = $item->{$optionLabelDepth[0]}->{$optionLabelDepth[1]};
                } else {
                    $label = $item->{$labelRef};
                }
                $values[] = [
                    'label' => isset($label) ? $label : '',
                    'value' => isset($item->{$valueRef}) ? $item->{$valueRef} : '',
                ];
            }
        }

        return $values;
    }
}

if (!function_exists('prepareSelectDefaultValues')) {
    function prepareSelectDefaultValues($items, $config = [])
    {
        $shouldLoopForValues = (isORMObj($items) && $items->count()) || (!isORMObj($items) && is_array($items));
        $defaultValues = [];

        if ($shouldLoopForValues) {
            $valueRef = isset($config['valueRef']) ? $config['valueRef'] : 'id'; // default id

            foreach ($items as $item) {
                $defaultValues[] = isset($item->{$valueRef}) ? $item->{$valueRef} : '';
            }
        }

        return $defaultValues;
    }
}

if (!function_exists('priceFormat')) {
    function priceFormat($price, $decimals = 2)
    {
        $price = (float) $price;

        if ($price < 0) {
            return '-$' . number_format(abs($price), $decimals);
        }

        return '$' . number_format($price, $decimals);
    }
}

if (!function_exists('getStatusIcon')) {
    function getStatusIcon($isEnabled = false)
    {
        if ($isEnabled) {
            return '<i class="nav-icon i-Yes font-weight-bold text-success"></i>';
        }

        return '<i class="nav-icon i-Close font-weight-bold text-danger"></i>';
    }
}

if (!function_exists('getCurrentDate')) {
    function getCurrentDate()
    {
        return date('Y-m-d', strtotime('now'));
    }
}

if (!function_exists('getCurrentDateTime')) {
    function getCurrentDateTime()
    {
        return date('Y-m-d H:i:s', strtotime('now'));
    }
}


if (!function_exists('sendEmail')) {
    function sendEmail($booking, $email)
    {
        Notification::route('mail', $email)
            ->notify(new DetailsBooking($booking));
    }
}

if (!function_exists('preparePhoneContacts')) {
    function preparePhoneContacts($phones)
    {
        $phonesMap = [];

        if (is_array($phones)) {
            foreach ($phones as $phone) {
                if ($phone != '') {
                    $phonesMap[] = $phone;
                }
            }
        }

        if (count($phonesMap)) {
            return implode('/', $phonesMap);
        }

        return '';
    }
}

if (!function_exists('getOperationTypeById')) {
    function getOperationTypeById($operationTypeId)
    {
        return \App\Helpers\PMTransactionHelper::getTypeById($operationTypeId);
    }
}

if (!function_exists('getUrlPath')) {
    function getUrlPath($filePath, $thumbnailType = '')
    {
        return \App\Helpers\ImagesHelper::getUrlPath($filePath, $thumbnailType);
    }
}

if (!function_exists('isRole')) {
    function isRole($roleSlug = '')
    {
        return \App\Helpers\RoleHelper::is($roleSlug);
    }
}

if (!function_exists('isProduction')) {
    function isProduction()
    {
        return 'production' == config('app.env');
    }
}

if (!function_exists('isStaging')) {
    function isStaging()
    {
        return 'staging' == config('app.env');
    }
}

if (!function_exists('isDevelopment')) {
    function isDevelopment()
    {
        return 'development' == config('app.env');
    }
}

if (!function_exists('hasSSL')) {
    function hasSSL()
    {
        return env('APP_SSL') == true ? true : false;
    }
}

if (!function_exists('getContactTypeBySlug')) {
    function getContactTypeBySlug($typeSlug = '')
    {
        return \App\Helpers\ContactsHelper::getLabelBySlug($typeSlug);
    }
}

if (!function_exists('isImage')) {
    function isImage($extension = '')
    {
        return in_array($extension, \Config::get('constants.valid_image_types'));
    }
}

if (!function_exists('monthHasPmTransactions')) {
    function monthHasPmTransactions($pmID, $month, $year)
    {
        return \App\Helpers\PMTransactionHelper::monthHasTransactions($pmID, $month, $year);
    }
}

if (!function_exists('getDatesFromRange')) {
    function getDatesFromRange($start, $end, $format = 'Y-m-d')
    {

        // Declare an empty array 
        $array = array();

        // Variable that store the date interval 
        // of period 1 day 
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($end);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

        // Use loop to store date into array 
        foreach ($period as $date) {
            $array[] = $date->format($format);
        }

        // Return the array elements 
        return $array;
    }
}

if (!function_exists('arrayFlatten')) {
    function arrayFlatten($array)
    {
        if (!is_array($array)) {
            return false;
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, arrayFlatten($value));
            } else {
                $result = array_merge($result, array($key => $value));
            }
        }
        return $result;
    }
}

if (!function_exists('getLowerRate')) {
    function getLowerRate($id)
    {
        $property = Property::find($id);
        $rates = [];

        $nightly = 0;

        foreach ($property->rates as $rate) {
            $now = new Carbon(date('Y-m-d', strtotime('now')));
            $start_date = new Carbon($rate->start_date);

            if ($start_date->gte($now)) {
                $nightly = $rate->nightly;
                break;
            } else {
                continue;
            }
        }

        return $nightly;

        // return $result;
    }
}

if (!function_exists('getCity')) {
    function getCity($id)
    {
        $city = City::find($id);
        if ($city) {
            $result = $city->name;
        } else {
            $result = '';
        }

        return $result;
    }
}

if (!function_exists('getZone')) {
    function getZone($id, $slug = true)
    {
        $property = Property::find($id);
        $result = $property->zone->translate()->name;
        if ($slug) {
            $result = generateSlug($result);
        }

        return $result;
    }
}

if (!function_exists('removeAccents')) {
    function removeAccents($string)
    {
        if (!preg_match('/[\x80-\xff]/', $string))
            return $string;

        $chars = array(
            // Decompositions for Latin-1 Supplement
            chr(195) . chr(128) => 'A', chr(195) . chr(129) => 'A',
            chr(195) . chr(130) => 'A', chr(195) . chr(131) => 'A',
            chr(195) . chr(132) => 'A', chr(195) . chr(133) => 'A',
            chr(195) . chr(135) => 'C', chr(195) . chr(136) => 'E',
            chr(195) . chr(137) => 'E', chr(195) . chr(138) => 'E',
            chr(195) . chr(139) => 'E', chr(195) . chr(140) => 'I',
            chr(195) . chr(141) => 'I', chr(195) . chr(142) => 'I',
            chr(195) . chr(143) => 'I', chr(195) . chr(145) => 'N',
            chr(195) . chr(146) => 'O', chr(195) . chr(147) => 'O',
            chr(195) . chr(148) => 'O', chr(195) . chr(149) => 'O',
            chr(195) . chr(150) => 'O', chr(195) . chr(153) => 'U',
            chr(195) . chr(154) => 'U', chr(195) . chr(155) => 'U',
            chr(195) . chr(156) => 'U', chr(195) . chr(157) => 'Y',
            chr(195) . chr(159) => 's', chr(195) . chr(160) => 'a',
            chr(195) . chr(161) => 'a', chr(195) . chr(162) => 'a',
            chr(195) . chr(163) => 'a', chr(195) . chr(164) => 'a',
            chr(195) . chr(165) => 'a', chr(195) . chr(167) => 'c',
            chr(195) . chr(168) => 'e', chr(195) . chr(169) => 'e',
            chr(195) . chr(170) => 'e', chr(195) . chr(171) => 'e',
            chr(195) . chr(172) => 'i', chr(195) . chr(173) => 'i',
            chr(195) . chr(174) => 'i', chr(195) . chr(175) => 'i',
            chr(195) . chr(177) => 'n', chr(195) . chr(178) => 'o',
            chr(195) . chr(179) => 'o', chr(195) . chr(180) => 'o',
            chr(195) . chr(181) => 'o', chr(195) . chr(182) => 'o',
            chr(195) . chr(182) => 'o', chr(195) . chr(185) => 'u',
            chr(195) . chr(186) => 'u', chr(195) . chr(187) => 'u',
            chr(195) . chr(188) => 'u', chr(195) . chr(189) => 'y',
            chr(195) . chr(191) => 'y',
            // Decompositions for Latin Extended-A
            chr(196) . chr(128) => 'A', chr(196) . chr(129) => 'a',
            chr(196) . chr(130) => 'A', chr(196) . chr(131) => 'a',
            chr(196) . chr(132) => 'A', chr(196) . chr(133) => 'a',
            chr(196) . chr(134) => 'C', chr(196) . chr(135) => 'c',
            chr(196) . chr(136) => 'C', chr(196) . chr(137) => 'c',
            chr(196) . chr(138) => 'C', chr(196) . chr(139) => 'c',
            chr(196) . chr(140) => 'C', chr(196) . chr(141) => 'c',
            chr(196) . chr(142) => 'D', chr(196) . chr(143) => 'd',
            chr(196) . chr(144) => 'D', chr(196) . chr(145) => 'd',
            chr(196) . chr(146) => 'E', chr(196) . chr(147) => 'e',
            chr(196) . chr(148) => 'E', chr(196) . chr(149) => 'e',
            chr(196) . chr(150) => 'E', chr(196) . chr(151) => 'e',
            chr(196) . chr(152) => 'E', chr(196) . chr(153) => 'e',
            chr(196) . chr(154) => 'E', chr(196) . chr(155) => 'e',
            chr(196) . chr(156) => 'G', chr(196) . chr(157) => 'g',
            chr(196) . chr(158) => 'G', chr(196) . chr(159) => 'g',
            chr(196) . chr(160) => 'G', chr(196) . chr(161) => 'g',
            chr(196) . chr(162) => 'G', chr(196) . chr(163) => 'g',
            chr(196) . chr(164) => 'H', chr(196) . chr(165) => 'h',
            chr(196) . chr(166) => 'H', chr(196) . chr(167) => 'h',
            chr(196) . chr(168) => 'I', chr(196) . chr(169) => 'i',
            chr(196) . chr(170) => 'I', chr(196) . chr(171) => 'i',
            chr(196) . chr(172) => 'I', chr(196) . chr(173) => 'i',
            chr(196) . chr(174) => 'I', chr(196) . chr(175) => 'i',
            chr(196) . chr(176) => 'I', chr(196) . chr(177) => 'i',
            chr(196) . chr(178) => 'IJ', chr(196) . chr(179) => 'ij',
            chr(196) . chr(180) => 'J', chr(196) . chr(181) => 'j',
            chr(196) . chr(182) => 'K', chr(196) . chr(183) => 'k',
            chr(196) . chr(184) => 'k', chr(196) . chr(185) => 'L',
            chr(196) . chr(186) => 'l', chr(196) . chr(187) => 'L',
            chr(196) . chr(188) => 'l', chr(196) . chr(189) => 'L',
            chr(196) . chr(190) => 'l', chr(196) . chr(191) => 'L',
            chr(197) . chr(128) => 'l', chr(197) . chr(129) => 'L',
            chr(197) . chr(130) => 'l', chr(197) . chr(131) => 'N',
            chr(197) . chr(132) => 'n', chr(197) . chr(133) => 'N',
            chr(197) . chr(134) => 'n', chr(197) . chr(135) => 'N',
            chr(197) . chr(136) => 'n', chr(197) . chr(137) => 'N',
            chr(197) . chr(138) => 'n', chr(197) . chr(139) => 'N',
            chr(197) . chr(140) => 'O', chr(197) . chr(141) => 'o',
            chr(197) . chr(142) => 'O', chr(197) . chr(143) => 'o',
            chr(197) . chr(144) => 'O', chr(197) . chr(145) => 'o',
            chr(197) . chr(146) => 'OE', chr(197) . chr(147) => 'oe',
            chr(197) . chr(148) => 'R', chr(197) . chr(149) => 'r',
            chr(197) . chr(150) => 'R', chr(197) . chr(151) => 'r',
            chr(197) . chr(152) => 'R', chr(197) . chr(153) => 'r',
            chr(197) . chr(154) => 'S', chr(197) . chr(155) => 's',
            chr(197) . chr(156) => 'S', chr(197) . chr(157) => 's',
            chr(197) . chr(158) => 'S', chr(197) . chr(159) => 's',
            chr(197) . chr(160) => 'S', chr(197) . chr(161) => 's',
            chr(197) . chr(162) => 'T', chr(197) . chr(163) => 't',
            chr(197) . chr(164) => 'T', chr(197) . chr(165) => 't',
            chr(197) . chr(166) => 'T', chr(197) . chr(167) => 't',
            chr(197) . chr(168) => 'U', chr(197) . chr(169) => 'u',
            chr(197) . chr(170) => 'U', chr(197) . chr(171) => 'u',
            chr(197) . chr(172) => 'U', chr(197) . chr(173) => 'u',
            chr(197) . chr(174) => 'U', chr(197) . chr(175) => 'u',
            chr(197) . chr(176) => 'U', chr(197) . chr(177) => 'u',
            chr(197) . chr(178) => 'U', chr(197) . chr(179) => 'u',
            chr(197) . chr(180) => 'W', chr(197) . chr(181) => 'w',
            chr(197) . chr(182) => 'Y', chr(197) . chr(183) => 'y',
            chr(197) . chr(184) => 'Y', chr(197) . chr(185) => 'Z',
            chr(197) . chr(186) => 'z', chr(197) . chr(187) => 'Z',
            chr(197) . chr(188) => 'z', chr(197) . chr(189) => 'Z',
            chr(197) . chr(190) => 'z', chr(197) . chr(191) => 's'
        );

        $string = strtr($string, $chars);

        return $string;
    }
}

if (!function_exists('generateSlug')) {
    function generateSlug($string)
    {
        $result = removeAccents($string);
        $result = strtolower($result);
        $result = str_replace(' ', '-', $result);

        return $result;
    }
}

if (!function_exists('getPage')) {
    function getPage($page)
    {
        switch ($page) {
            case 'vacation-services':
                $id = 2;
                break;
            case 'payment-methods':
                $id = 13;
                break;
            case 'rental-agreement':
                $id = 14;
                break;
            case 'accidental-rental-damage-insurance':
                $id = 15;
                break;
            case 'concierge-services':
                $id = 16;
                break;
            case 'helpful-information':
                $id = 17;
            case 'property-management':
                $id = 18;
                break;
            case 'about':
                $id = 19;
                break;
            case 'puerto-vallarta-history':
                $id = 20;
                break;
            case 'nuevo-vallarta-history':
                $id = 21;
                break;
            case 'mazatlan-history':
                $id = 22;
                break;
            case 'testimonials':
                $id = 23;
                break;
            case 'privacy-policy':
                $id = 25;
                break;
            case 'terms-of-use':
                $id = 27;
                break;
            case 'real-estate-business-directory':
                $id = 28;
                break;
            case 'lgbt-business-directory':
                $id = 29;
                break;
            case 'contact':
                $id = 30;
                break;
            default:
                $id = 1;
                break;
        }

        return $id;
    }
}

if (!function_exists('getSubString')) {
    function getSubString($text, $length = 50)
    {
        $text = trim($text);
        if (strlen($text) > $length) {
            $text = substr($text, 0, $length);
            $text = substr($text, 0, strrpos($text, ' '));
            $text .= '...';
        }
        return $text;
    }
}

if (!function_exists('removeP')) {
    function removeP($string)
    {
        $result = str_replace('<p>', '', $string);
        $result = str_replace('</p>', '', $result);
        return $result;
    }
}

if (!function_exists('removeImage')) {
    function removeImage($string)
    {
        $result = preg_replace('/<img[^>]+\>/i', '', $string);
        return $result;
    }
}

if (!function_exists('getFeaturedImage')) {
    function getFeaturedImage($id, $thumbnailType = '')
    {
        $property = Property::find($id);
        $imageFeatured = PropertyImage::where('property_id', $id)->orderBy('order', 'asc')->first();

        if (count($property->images) > 0) {
            if ($thumbnailType) {
                $result = getUrlPath($imageFeatured->file_url, $thumbnailType);
            } else {
                $result = getUrlPath($imageFeatured->file_url, 'small-ls');
            }
        } else {
            $result = null;
        }

        return $result;
    }
}

if (!function_exists('getOffices')) {
    function getOffices()
    {
        return [
            [
                'name' => 'Puerto Vallarta',
                'address' => 'Libertad 349, Centro <br>Puerto Vallarta, Jalisco, México 48300',
                'phone' => '+52 (322) 223-0101',
                'email' => 'vallarta@palmeravacations.com',
                'phone_us_can' => '(323) 250-7721',
                'phone_free' => '1-800-881-8176',
                'gmaps_id' => 'puerto-vallarta',
                'gmaps_lat' => '20.606625',
                'gmaps_lon' => '-105.234766',
            ],
            [
                'name' => 'Mazatlán',
                'address' => 'Ave. Playa Gaviotas 409 Local 27 <br>Mazatlán, Sinaloa, México 82110',
                'phone' => '+52 (669) 913-5188',
                'email' => 'mazatlan@palmeravacations.com',
                'phone_us_can' => '(714) 988-7903',
                'phone_free' => '1-888-688-1577',
                'gmaps_id' => 'mazatlan',
                'gmaps_lat' => '23.242779',
                'gmaps_lon' => '-106.45258',
            ],
        ];
    }
}

// Functions for form check availability public
if (!function_exists('getPropertyTypes')) {
    function getPropertyTypes()
    {
        $lang = LanguageHelper::current();
        $result = PropertyTypeTranslation::query()
            ->where('language_id', $lang->id)
            ->with('propertyType')
            ->orderBy('name', 'asc')->get();
        return $result;
    }
}

if (!function_exists('getCities')) {
    function getCities()
    {
        $result = City::all();

        return $result;
    }
}

if (!function_exists('getSearchDate')) {
    function getSearchDate($format, $arrival, $depature)
    {
        $arrivalDate = ($arrival) ? $arrival : 'now';
        $departureDate = ($depature) ? $depature : 'now + 7 days';
        $result = [];
        $result['currentDate'] = ($format) ? date('Y-m-d', strtotime($arrivalDate)) : date('l d/F/y', strtotime($arrivalDate));
        $result['nextDate'] = ($format) ? date('Y-m-d', strtotime($departureDate)) : date('l d/F/y', strtotime($departureDate));

        return $result;
    }
}

if (!function_exists('getAvailabilityProperty')) {
    function getAvailabilityProperty($id, $fromDate, $toDate)
    {
        if (!$fromDate || !$toDate) {
            $fromDate = date('Y-m-d', strtotime('now'));
            $toDate = date('Y-m-d', strtotime('+7 days'));
        }

        $property = Property::find($id);

        $bookings       = $property->bookings;
        $bookingDaysArr = [];
        foreach ($bookings as $booking) {
            $bookingDaysArr[] = getDatesFromRange($booking->arrival_date, $booking->departure_date, 'd-M-y');
        }
        $bookingDays = array_values(array_unique(arrayFlatten($bookingDaysArr)));
        $days = getDatesFromRange($fromDate, $toDate, 'd-M-y');
        $daysOccupied = 0;
        foreach ($days as $day) {
            if (in_array($day, $bookingDays)) {
                $daysOccupied++;
            }
        }

        if ($daysOccupied > 0 && $daysOccupied < count($days)) {
            $result = 'some';
        } else if ($daysOccupied == count($days)) {
            $result = 'none';
        } else {
            $result = 'all';
        }

        return $result;
    }
}

if (!function_exists('getMinStay')) {
    function getMinStay($id)
    {
        $property = Property::find($id);
        $rates = $property->rates;

        if (!$rates->isEmpty()) {

            $minStayArray = [];
            foreach ($rates as $rate) {
                $minStayArray[] = $rate->min_stay;
            }
            $minStay = min(array_values(array_unique(arrayFlatten($minStayArray))));

            $result = $minStay;
        } else {
            $result = 1;
        }

        return $result;
    }
}

if (!function_exists('getPropertyRate')) {
    function getPropertyRate($property, $rates, $from_date = '', $to_date = '')
    {
        return RatesHelper::getPropertyRate($property, $rates, $from_date, $to_date);
    }
}

if (!function_exists('generateColumns')) {
    function generateColumns($array, $number)
    {
        $count = 1;
        $html = "";
        foreach ($array as $item) {
            if ($count % $number == 1) {
                $html .= "<div class='col-xs-3' style='width: 25%'><ul class='list'>";
            }
            $html .= "<li>" . $item->getLabel() . "</li>";
            if ($count % $number == 0) {
                $html .= "</div></ul>";
            }
            $count++;
        }
        if ($count % $number != 1) {
            $html .= "</div></ul>";
        }

        return $html;
    }
}

if (!function_exists('generateCalendar')) {
    function generateCalendar($year, $cols = 12, $bookings)
    {
        $currYear = isset($year) ? $year : Carbon::now()->year;
        $count_cols = 0;
        $cols_needed = 3;

        $bookingDaysArr = [];
        $firstDays      = [];
        $endDays        = [];
        foreach ($bookings as $booking) {
            $bookingDaysArr[] = getDatesFromRange($booking->arrival_date, $booking->departure_date, 'd-M-y');
            $bookingDaysSE    = getDatesFromRange($booking->arrival_date, $booking->departure_date, 'd-M-y');
            $firstDays[]      = reset($bookingDaysSE);
            $endDays[]        = end($bookingDaysSE);
        }
        $bookingDays = arrayFlatten($bookingDaysArr);

        $calendar  = '<table align="center" border="0" cellpadding="0" cellspacing="5">';
        $calendar .= '<tr>';
        $calendar .= '<td align="left" valign="top">';
        $calendar .= '<table border="0" cellpadding="0" cellspacing="2">';

        for ($i = 0; $i < $cols; $i++) {
            $count_cols++;
            $cm = mktime(0, 0, 0, 1 + $i, 1, $currYear); //get curr month time string
            $days_month = date("t", $cm); //calculate number of days in month
            $first_weekday_unix = mktime(0, 0, 0, date('n', $cm), 1, date('Y', $cm));
            $first_weekday = date('w', $first_weekday_unix);
            $last_weekday_unix = mktime(0, 0, 0, date('n', $cm), $days_month, date('Y', $cm));
            $last_weekday = date('w', $last_weekday_unix);
            $monthLabel = Carbon::parse($cm);
            if (LanguageHelper::getLocale() == 'en') {
                setlocale(LC_ALL, 'en_EN');
                $month = $monthLabel->format('F');
            } else {
                setlocale(LC_ALL, 'es_MX', 'es', 'ES', 'es_MX.utf8');
                $month = $monthLabel->formatLocalized('%B');
            }

            $calendar .= '<tr>';
            $calendar .= '<th colspan="7" align="center" valign="top">' . ucfirst($month) . ' ' . $currYear . '</th>';
            $calendar .= '</tr>';
            $calendar .= '<tr>
                <th>Su</th>
                <th>Mo</th>
                <th>Tu</th>
                <th>We</th>
                <th>Th</th>
                <th>Fr</th>
                <th>Sa</th>
            </tr>';
            $calendar .= '<tr>';
            if ($first_weekday != 0) {
                $calendar .= '<td colspan="' . $first_weekday . '">&nbsp;</td>';
            }
            $count_fields = $first_weekday;
            for ($d = 1; $d <= $days_month; $d++) {
                $addzero = ($d < 10) ? '0' . $d : $d;
                $formatYear = isset($year) ? $year : Carbon::now()->year;
                $formatYear = substr($formatYear, 2);
                $day = $addzero . '-' . date('M', $cm) . '-' . $formatYear;
                if (in_array($day, $bookingDays)) {
                    $occupied = true;
                } else {
                    $occupied = false;
                }
                if (in_array($day, $firstDays)) {
                    $classDay = 'arrival-only';
                } elseif (in_array($day, $endDays)) {
                    $classDay = 'departure-only';
                } else {
                    $classDay = '';
                }

                $colorClass = ($occupied) ? '#D99694' : '#C3D69B';

                $calendar .= '<td class="' . $classDay . '" style="background-color:' . $colorClass . '">';
                $calendar .= '<span class="current-day">' . $d . '</span>';
                $calendar .= '</td>';

                $count_fields++;

                if ($d != $days_month) {
                    if (($count_fields % 7) == 0) {
                        $calendar .= '</tr><tr>';
                    }
                } else {
                    if ($last_weekday != 6) {
                        $calendar .= '<td colspan="' . (6 - $last_weekday) . '">&nbsp;</td>';
                    }

                    $calendar .= '</tr>';
                }
            }
            $calendar .= '</table>';
            $calendar .= '</td>';
            if ($count_cols != $cols) {
                if (($count_cols % $cols_needed) == 0) {
                    $calendar .= '</tr><tr>';
                }

                $calendar .= '<td align="left" valign="top">';
                $calendar .= '<table border="0" cellpadding="0" cellspacing="2">';
            } else {
                $calendar .= '</tr>';
            }
        }
        $calendar .= '</table>';

        return $calendar;
    }
}

// if (!function_exists('getNightsDate')) {
//     function getNightsDate($fromDate, $toDate)
//     {
//         $arrival = new DateTime($fromDate);
//         $departure = new DateTime($toDate);
//         $interval = $arrival->diff($departure);
//         $result = $interval->format('%a');

//         return $result;
//     }
// }