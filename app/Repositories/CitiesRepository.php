<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\City;
use App\Repositories\CitiesRepositoryInterface;
use App\Validations\CitiesValidations;

class CitiesRepository implements CitiesRepositoryInterface
{
    private $model;

    public function __construct(City $city)
    {
        $this->model = $city;
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        if ($search) {
            $query = 
                City::where('name', 'like', "%".$search."%")
                    ->orWhere('id', $search);
        } else {
            $query = City::query();
        }
        
        $query->orderBy('name', 'asc');
        
        if($shouldPaginate) {
            $result = $query->paginate(30);
        }else{
            $result = $query->get();
        }
        
        return $result;
    }

    public function create(Request $request)
    {
        CitiesValidations::validateOnCreate($request);
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        CitiesValidations::validateOnEdit($request, $id);
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $is_new = ! $id;

        if ($is_new) {
            $city = $this->blueprint();
        }else{
            $city = $this->find($id);
        }

        $city->fill($request->all());
        $city->save();

        return $city;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $city = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$city) { 
            throw new ModelNotFoundException("City not found");
        }

        return $city;
    }
    
    public function delete($id)
    {
        $city = $this->model->find($id);
        
        if ($city && $this->canDelete($id)) {
            $city->delete();
        }

        return $city; 
    }

    public function canDelete($id)
    {
        return ($id > 2); // to not delete seed items
    }

    public function blueprint()
    {
        $city = new City;
        return $city;
    }
}