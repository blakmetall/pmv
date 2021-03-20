<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\PropertyRatesRepositoryInterface;
use App\Models\{ Property, PropertyRate };
use App\Validations\PropertyRatesValidations;

class PropertyRatesRepository implements PropertyRatesRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(PropertyRate $rate)
    {
        $this->model = $rate;
        $this->validation = new PropertyRatesValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $hasPropertyID = isset($config['property_id']) ? $config['property_id'] : '';

        if ($search) {
            $query = 
                PropertyRate::
                    where('start_date', $search)
                    ->orWhere('end_date', $search);
        } else {
            $query = PropertyRate::query();
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
        $this->validation->validate('create', $request);
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        $this->validation->validate('edit', $request, $id);
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $is_new = ! $id;

        if($is_new){
            $rate = $this->blueprint();
        }else{
            $rate = $this->find($id);
        }

        $rate->fill($request->all());
        $rate->save();

        return $rate;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $rate = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$rate) {
            throw new ModelNotFoundException("PropertyRate not found");
        }

        return $rate;
    }

    public function delete($id)
    {
        $rate = $this->model->find($id);
        
        if ($rate && $this->canDelete($id)) {
            $rate->delete();
        }

        return $rate;
    }

    public function canDelete($id) 
    {
        return true;
    }

    public function blueprint()
    {
        return new PropertyRate;
    }
}
