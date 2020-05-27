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

// Helper for agents
if (!function_exists('prepareCheckboxValuesFromRowsAgents')) {
    function prepareCheckboxValuesFromRowsAgents($items, $config = [])
    {
        $values = [];
        $valueRef       = isset($config['valueRef']) ? $config['valueRef'] : 'id'; // default id
        $labelRef       = isset($config['labelRef']) ? $config['labelRef'] : 'name'; // default name
        $secondLabelRef = isset($config['secondLabelRef']) ? $config['secondLabelRef'] : ''; // default empty

        // Id agents
        $agentsOnly = isset($config['agentsOnly']) ? $config['agentsOnly'] : ''; // default empty

        if ($items->count()) {
            foreach($items as $item) {
                if($item->{$valueRef} == 5){

                    $values[] = [
                        'label' => $item->{$labelRef}.' '.$item->{$secondLabelRef},
                        'value' => $item->{$valueRef},
                    ];  

                }
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

if (!function_exists('cleanString')) {
    function cleanString($string, $character)
    {
        $cleanString   = trim($string);
        $cleanString   = str_replace(' ',$character, $cleanString);
        $cleanString   = str_replace('%','', $cleanString);
        $accentsArray = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
        $cleanString   = strtr( $cleanString, $accentsArray );
        $cleanString   = strtolower($cleanString);
        return $cleanString;
    }
}

if (!function_exists('saveFile')) {
    function saveFile($file)
    {
        $data['original_name'] = $file->getClientOriginalName();
        $data['slug']          = cleanString(preg_replace('/\\.[^.\\s]{3,4}$/', '', $data['original_name']), '-');
        $data['extension']     = $file->getClientOriginalExtension();
        $date                  = new DateTime();
        $stamp                 = $date->getTimestamp();
        $data['file_name']     = $stamp.'.'.$data['extension'];
        $string_file_path      = "properties/".$data['file_name'];

        Storage::disk('public')->put($string_file_path, \File::get( $file ));

        $data['path_file'] = Storage::url($string_file_path);
        $data['url_file']  = public_path().Storage::url($string_file_path);

        return $data;
    }
}

if (!function_exists('deleteFile')) {
    function deleteFile($file)
    {
        Storage::disk('public')->delete('properties/'.$file);
    }
}
