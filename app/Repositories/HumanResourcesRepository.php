<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\HumanResourcesRepositoryInterface;
use App\Models\{ HumanResource, Property };
use App\Validations\HumanResourcesValidations;
use App\Helpers\WorkgroupHelper;

class HumanResourcesRepository implements HumanResourcesRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(HumanResource $human_resource)
    {
        $this->model = $human_resource;
        $this->validation = new HumanResourcesValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $shouldFilterByWorkgroup = isset($config['filterByWorkgroup']) ? $config['filterByWorkgroup'] : false;

        if ($search) {
            $query = HumanResource::
                where('id', $search)
                ->orWhere(function($q) use ($search) {
                    $q->where('address', 'like', "%".$search."%")
                    ->orWhere('lastname', 'like', "%".$search."%")
                    ->orWhere('firstname', 'like', "%".$search."%")
                    ->orWhere('department', 'like', "%".$search."%");
                });
        } else {
            $query = HumanResource::query();
        }

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
            $human_resource = $this->blueprint();
        }else{
            $human_resource = $this->find($id);
        }

        $checkboxesConfig = ['is_active' => 0];
        $requestData = array_merge($checkboxesConfig, $request->all());

        $human_resource->fill($requestData);

        $human_resource->save();

        return $human_resource;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $human_resource = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$human_resource) {
            throw new ModelNotFoundException("Human Resource not found");
        }

        return $human_resource;
    }

    public function delete($id)
    {
        $human_resource = $this->model->find($id);
        
        if ($human_resource && $this->canDelete($id)) {
            $human_resource->delete();
        }

        return $human_resource;
    }

    public function canDelete($id) 
    {
        return true;
    }

    public function blueprint()
    {
        return new HumanResource;
    }
}
