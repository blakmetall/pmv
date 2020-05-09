<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\StaffGroupsRepositoryInterface;
use App\Models\StaffGroup;
use App\Validations\StaffGroupsValidations;

class StaffGroupsRepository implements StaffGroupsRepositoryInterface
{
    protected $model;

    public function __construct(StaffGroup $staff_group)
    {
        $this->model = $staff_group;
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        if ($search) {
            $query = StaffGroup::
                where('location', 'like', "%".$search."%");
        } else {
            $query = StaffGroup::query();
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
        StaffGroupsValidations::validateOnCreate($request);
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        StaffGroupsValidations::validateOnEdit($request, $id);
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $is_new = ! $id;

        if($is_new){
            $staff_group = $this->blueprint();
        }else{
            $staff_group = $this->find($id);
        }

        $checkboxesConfig = ['is_finished' => 0];
        $requestData = array_merge($checkboxesConfig, $request->all());

        $staff_group->fill($requestData);

        $staff_group->save();

        return $staff_group;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $staff_group = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$staff_group) {
            throw new ModelNotFoundException("Cleaning Staff not found");
        }

        return $staff_group;
    }

    public function delete($id)
    {
        $staff_group = $this->model->find($id);
        
        if ($staff_group && $this->canDelete($id)) {
            $staff_group->delete();
        }

        return $staff_group;
    }

    public function canDelete($id) 
    {
        return true;
    }

    public function blueprint()
    {
        $staff_group = new StaffGroup;
        return $staff_group;
    }
}
