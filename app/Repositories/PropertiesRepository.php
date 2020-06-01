<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Models\{ Property, PropertyTranslation };
use App\Repositories\PropertiesRepositoryInterface;
use App\Validations\PropertiesValidations;
use App\Helpers\WorkgroupHelper;

class PropertiesRepository implements PropertiesRepositoryInterface
{
    protected $model;

    public function __construct(Property $property)
    {
        $this->model = $property;
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $shouldFilterByWorkgroup = isset($config['filterByWorkgroup']) ? $config['filterByWorkgroup'] : false;

        $lang = LanguageHelper::current();
        
        if ($search) {
            $query = PropertyTranslation::where('description', 'like', "%".$search."%");
        } else {
            $query = PropertyTranslation::query();
        }

        $query
            ->where('language_id', $lang->id)
            ->with('property')
            ->orderBy('id', 'desc');

        if ($shouldFilterByWorkgroup && WorkgroupHelper::shouldFilterByCity()) {
            $query->whereHas('property', function($q) {
                $table = (new Property)->_getTable();
                $q->whereIn($table.'.city_id', WorkgroupHelper::getAllowedCities());
            });
        }

        if ($shouldPaginate) {
            $result = $query->paginate( config('constants.pagination.per-page') );
        } else {
            $result = $query->get();
        }
        
        return $result;
    }

    public function create(Request $request)
    {
        PropertiesValidations::validateOnCreate($request);
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        PropertiesValidations::validateOnEdit($request, $id);
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $is_new = ! $id;

        $checkboxesConfig = [
            'is_featured' => 0,
            'is_enabled' => 0,
            'is_online' => 0,
            'has_parking' => 0,
        ];
        $requestData = array_merge($checkboxesConfig, $request->all());

        
        if ($is_new) {
            $property = $this->blueprint();
            $property->fill($requestData);
            $property->save();

            $property->en->language_id = LanguageHelper::getId('en');
            $property->en->property_id = $property->id;
            
            $property->es->language_id = LanguageHelper::getId('es');
            $property->es->property_id = $property->id;
        }else{
            $property = $this->find($id);
            $property->fill($requestData);
            $property->save();
        }  

        $property->en->fill($request->en);
        $property->en->save();
        
        $property->es->fill($request->es);
        $property->es->save();

        // amenities assignation
        if ($request->amenities_ids && is_array($request->amenities_ids) && count($request->amenities_ids)) {
            $property->amenities()->sync($request->amenities_ids);
        }
        
        return $property;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $property = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);
        
        if ($property) { 

            $property->en = 
                $property
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('en'))
                    ->first();
    
            $property->es =
                 $property
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('es'))
                    ->first();
                          
        }

        if (!$property) { 
            throw new ModelNotFoundException("Property not found");
        }

        return $property;
    }
    
    public function delete($id)
    {
        $property = $this->model->find($id);
        
        if ($property && $this->canDelete($id)) {
            $property->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
            $property->translations()->where('language_id', LanguageHelper::getId('es'))->delete();

            $property->delete();
        }

        return $property; 
    }

    public function canDelete($id)
    {
        return true;
    }

    public function blueprint()
    {
        $property = new Property;
        $property->en = new PropertyTranslation;
        $property->es = new PropertyTranslation;

        return $property;
    }
}
