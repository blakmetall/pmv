<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\PropertyManagementRepositoryInterface;
use App\Models\{ Property, PropertyManagement };
use App\Validations\PropertyManagementValidations;

class PropertyManagementRepository implements PropertyManagementRepositoryInterface
{
    protected $model;

    public function __construct(PropertyManagement $pm)
    {
        $this->model = $pm;
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $hasPropertyID = isset($config['property_id']) ? $config['property_id'] : '';

        if ($search) {
            $query = 
                PropertyManagement::
                    where('start_date', $search)
                    ->orWhere('end_date', $search);
        } else {
            $query = PropertyManagement::query();
        }

        if($hasPropertyID) {
            $query->where('property_id', $config['property_id']);
        }

        $query->with('property');
        $query->orderBy('start_date', 'asc');

        if($shouldPaginate) {
            $result = $query->paginate( config('constants.pagination.per-page') );
        }else{
            $result = $query->get();
        }
        
        return $result;
    }

    public function create(Request $request)
    {
        PropertyManagementValidations::validateOnCreate($request);
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        PropertyManagementValidations::validateOnEdit($request, $id);
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $is_new = ! $id;

        if($is_new){
            $pm = $this->blueprint();
        }else{
            $pm = $this->find($id);
        }

        $pm->fill($request->all());
        $pm->save();

        return $pm;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $pm = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$pm) {
            throw new ModelNotFoundException("PropertyManagement not found");
        }

        return $pm;
    }

    public function delete($id)
    {
        $pm = $this->model->find($id);
        
        if ($pm && $this->canDelete($id)) {
            $pm->delete();
        }

        return $pm;
    }

    public function canDelete($id) 
    {
        return true;
    }

    public function blueprint()
    {
        $pm = new PropertyManagement;
        return $pm;
    }
}