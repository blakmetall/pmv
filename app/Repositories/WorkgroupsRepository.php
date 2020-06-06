<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Workgroup;
use App\Repositories\WorkgroupsRepositoryInterface;
use App\Validations\WorkgroupsValidations;

class WorkgroupsRepository implements WorkgroupsRepositoryInterface
{
    private $model;
    private $validation;

    public function __construct(Workgroup $workgroup)
    {
        $this->model = $workgroup;
        $this->validation = new WorkgroupsValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        if ($search) {
            $query = Workgroup::where('id', $search);
        } else {
            $query = Workgroup::query();
        }
        
        $query->orderBy('city_id', 'asc');
        
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

        if ($is_new) {
            $workgroup = $this->blueprint();
        }else{
            $workgroup = $this->find($id);
        }

        $workgroup->fill($request->all());
        $workgroup->save();

        return $workgroup;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $workgroup = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$workgroup) { 
            throw new ModelNotFoundException("Workgroup not found");
        }

        return $workgroup;
    }
    
    public function delete($id)
    {
        $workgroup = $this->model->find($id);
        
        if ($workgroup && $this->canDelete($id)) {
            $workgroup->delete();
        }

        return $workgroup; 
    }

    public function canDelete($id)
    {
        return true;
    }

    public function blueprint()
    {
        return new Workgroup;
    }
}