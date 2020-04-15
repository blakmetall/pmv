<?php

// namespace App\Helpers;
 
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
                $requestName = "{$lang}.{$parentNane}.{$name}";
            } else {
                $requestName = "{$lang}.{$name}";
            }
        } else if ($parentName) {
            $requestName = "{$parentName}.{$name}";
        }
        
        return $requestName;
    }
}
 
if (!function_exists('prepareCheckboxValuesFromRows')) {
    function prepareCheckboxValuesFromRows($items, $config = [])
    {
        $values = [];

        $valueRef = isset($config['valueRef']) ? $config['valueRef'] : 'id'; // default id
        $labelRef = isset($config['labelRef']) ? $config['labelRef'] : 'name'; // default name

        if ($items->count()) {
            foreach($items as $item) {
                $values[] = [
                    'label' => $item->{$labelRef},
                    'value' => $item->{$valueRef},
                ];
            }
        }
        
        return $values;
    }
}

if (!function_exists('prepareCheckboxDefaultValues')) {
    function prepareCheckboxDefaultValues($items, $config = [])
    {
        $defaultValues = [];

        $valueRef = isset($config['valueRef']) ? $config['valueRef'] : 'id'; // default id

        if ($items->count()) {
            foreach($items as $item) {
                $defaultValues[] = $item->{$valueRef};
            }
        }
        
        return $defaultValues;
    }
}

