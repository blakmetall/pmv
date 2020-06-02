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
 
if (!function_exists('prepareCheckboxValuesFromRows')) {
    function prepareCheckboxValuesFromRows($items, $config = [])
    {
        $values = [];

        $valueRef       = isset($config['valueRef']) ? $config['valueRef'] : 'id'; // default id
        $labelRef       = isset($config['labelRef']) ? $config['labelRef'] : 'name'; // default name
        $secondLabelRef = isset($config['secondLabelRef']) ? $config['secondLabelRef'] : ''; // default empty

        if ($items->count()) {
            foreach($items as $item) {
                $values[] = [
                    'label' => $item->{$labelRef}.' '.$item->{$secondLabelRef},
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

if (!function_exists('prepareSelectValuesFromRows')) {
    function prepareSelectValuesFromRows($items, $config = [])
    {
        $values = [];

        $valueRef       = isset($config['valueRef']) ? $config['valueRef'] : 'id'; // default id
        $labelRef       = isset($config['labelRef']) ? $config['labelRef'] : 'name'; // default name
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

if (!function_exists('prepareSelectDefaultValues')) {
    function prepareSelectDefaultValues($items, $config = [])
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

