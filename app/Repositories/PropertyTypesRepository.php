<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Repositories\PropertyTypesRepositoryInterface;
use App\Models\{ PropertyType, PropertyTypeTranslation };

class PropertyTypesRepository implements PropertyTypesRepositoryInterface
{
    protected $model;

    public function __construct(PropertyType $property_type)
    {
        $this->model = $property_type;
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        
        $lang = LanguageHelper::current();

        if ($search) {
            $query = PropertyTypeTranslation::where('name', 'like', "%".$search."%");
        } else {
            $query = PropertyTypeTranslation::query();
        }
        
        $query
            ->where('language_id', $lang->id)
            ->with('propertyType')
            ->orderBy('name', 'asc');

        if($shouldPaginate) {
            $result = $query->paginate( config('constants.pagination.per-page') );
        }else{
            $result = $query->get();
        }
        
        return $result;
    }

    public function create(Request $request) {}
    public function update(Request $request, $id) {}
    public function save(Request $request, $id = '') {}
    public function find($id_or_obj) {}
    public function delete($id) {}
    public function canDelete($id) {}
    public function blueprint() {}
}