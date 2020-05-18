<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\WorkgroupUsersRepositoryInterface;
use App\Models\{ Workgroup, WorkgroupUser };
use App\Validations\WorkgroupUsersValidations;

class WorkgroupUsersRepository implements WorkgroupUsersRepositoryInterface
{
    protected $model;

    public function __construct(WorkgroupUser $workgroupUser)
    {
        $this->model = $workgroupUser;
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $hasWorkgroup = isset($config['workgroup']) && is_object($config['workgroup']);

        if ($search) {
            $query = WorkgroupUser::query();
        } else {
            $query = WorkgroupUser::query();
        }

        if($hasWorkgroup) {
            $query->where('workgroup_id', $config['workgroup']->id);
        }

        $query->with('user');

        if($shouldPaginate) {
            $result = $query->paginate( config('constants.pagination.per-page') );
        }else{
            $result = $query->get();
        }
        
        return $result;
    }

    public function create(Request $request)
    {
        WorkgroupUsersValidations::validateOnCreate($request);
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        WorkgroupUsersValidations::validateOnEdit($request, $id);
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $is_new = ! $id;

        if($is_new){
            $workgroupUser = $this->blueprint();
        }else{
            $workgroupUser = $this->find($id);
        }

        $workgroupUser->fill($request->all());
        $workgroupUser->save();

        return $workgroupUser;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $workgroupUser = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$workgroupUser) {
            throw new ModelNotFoundException("WorkgroupUser not found");
        }

        return $workgroupUser;
    }

    public function delete($id)
    {
        $workgroupUser = $this->model->find($id);
        
        if ($workgroupUser && $this->canDelete($id)) {
            $workgroupUser->delete();
        }

        return $workgroupUser;
    }

    public function canDelete($id) 
    {
        return true;
    }

    public function blueprint()
    {
        $workgroupUser = new WorkgroupUser;
        return $workgroupUser;
    }
}
