<?php

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
        } else if ($parentName) {
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
        } else if ($parentName) {
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
            $valueRef       = isset($config['valueRef']) ? $config['valueRef'] : 'id'; // default id
            $labelRef       = isset($config['labelRef']) ? $config['labelRef'] : 'name'; // default name
            $secondLabelRef = isset($config['secondLabelRef']) ? $config['secondLabelRef'] : ''; // default empty
        
            foreach($items as $item) {
                $labelRefValue = isset($item->{$labelRef}) ? $item->{$labelRef} : '';
                $secondLabelRefValue = isset($item->{$secondLabelRef}) ? $item->{$secondLabelRef} : '';
                
                $values[] = [
                    'label' => trim($labelRefValue . ' ' . $item->{$secondLabelRefValue}),
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

            foreach($items as $item) {
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
            $valueRef       = isset($config['valueRef']) ? $config['valueRef'] : 'id'; // default id
            $labelRef       = isset($config['labelRef']) ? $config['labelRef'] : 'name'; // default name

            foreach($items as $item) {
                $values[] = [
                    'label' => isset($item->{$labelRef}) ? $item->{$labelRef} : '',
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

            foreach($items as $item) {
                $defaultValues[] = isset($item->{$valueRef}) ? $item->{$valueRef} : '';
            }
        }

        return $defaultValues;
    }
}

if (!function_exists('priceFormat')) {
    function priceFormat($price, $decimals = 2)
    {
        if($price < 0) {
            return '-$' . number_format(abs($price), $decimals);    
        }

        return '$' . number_format($price, $decimals);
    }
}

if (!function_exists('getStatusIcon')) {
    function getStatusIcon($isEnabled = false)
    {
        if($isEnabled) {
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

if (!function_exists('preparePhoneContacts')) {
    function preparePhoneContacts($phones)
    {
        $phonesMap = [];

        if(is_array($phones)) {
            foreach($phones as $phone) {
                if($phone != '') {
                    $phonesMap[] = $phone;
                }
            }
        }

        if(count($phonesMap)) {
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
        return env('APP_SSL') == true ? true : false;;
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
        return (in_array($extension, \Config::get('constants.valid_image_types')));
    }
}