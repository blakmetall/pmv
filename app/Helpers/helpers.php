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
        return implode(' <b>/</b> ', $phones);
    }
}

if (!function_exists('saveFile')) {
    function saveFile($file)
    {
        $extension             = $file->getClientOriginalExtension();
        $originalName    = $file->getClientOriginalName();
        $originalNameRaw = substr($originalName, 0, strrpos($originalName, "."));
        
        $folder          = 'properties';
        $slug            = \Illuminate\Support\Str::slug($originalNameRaw, '-');
        $fileName        = $slug . '-' . strtotime('now') . '.' . $extension;
        $filePath        = $folder . '/' . $fileName;

        Storage::disk('public')->put($filePath, \File::get( $file ));

        return [
            'slug' => $slug,
            'extension' => $extension,
            'file_original_name' => $originalName,
            'file_name' => $fileName,
            'file_path' => Storage::url($filePath),
            'file_url' => public_path() . Storage::url($filePath),
        ];
    }
}

if (!function_exists('deleteFile')) {
    function deleteFile($file)
    {
        Storage::disk('public')->delete('properties/'.$file);
    }
}

if (!function_exists('getOperationTypeById')) {
    function getOperationTypeById($operationTypeId)
    {
        return App\Helpers\PMTransactionHelper::getTypeById($operationTypeId);
    }
}

