<?php

namespace App\Repositories;

use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\ContractorsRepositoryInterface;
use App\Models\{ City, Contractor, Property };
use App\Validations\ContractorsValidations;
use App\Helpers\WorkgroupHelper;

class ContractorsRepository implements ContractorsRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(Contractor $contractor)
    {
        $this->model = $contractor;
        $this->validation = new ContractorsValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $shouldFilterByWorkgroup = isset($config['filterByWorkgroup']) ? $config['filterByWorkgroup'] : false;

        if ($search) {
            $query = Contractor::
                where('company', 'like', "%".$search."%")
                ->orWhere('contact_name', 'like', "%".$search."%")
                ->orWhere('email', 'like', "%".$search."%")
                ->orWhere('address', 'like', "%".$search."%")
                ->orWhereHas('city', function($q) use ($search) {
                    $table = (new City)->_getTable();
                    $q->where($table . '.name', 'like', "%".$search."%");
                });
        } else {
            $query = Contractor::query();
        }

        $query->orderBy('company', 'asc');

        if ($shouldFilterByWorkgroup && WorkgroupHelper::shouldFilterByCity()) {
            $query->whereIn('city_id', WorkgroupHelper::getAllowedCities());
        }

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
            $contractor = $this->blueprint();
        }else{
            $contractor = $this->find($id);
        }

        $contractor->fill($request->all());
        $contractor->save();

        return $contractor;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $contractor = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$contractor) {
            throw new ModelNotFoundException("Contractor not found");
        }

        return $contractor;
    }

    public function delete($id)
    {
        $contractor = $this->model->find($id);
        
        if ($contractor && $this->canDelete($id)) {
            $contractor->delete();
        }

        return $contractor;
    }

    public function canDelete($id) 
    {
        return true;
    }

    public function blueprint()
    {
        return new Contractor;
    }
}
