<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\CleaningStaff;
use App\Repositories\CleaningStaffRepositoryInterface;
use App\Validations\CleaningStaffValidations;

class CleaningStaffRepository implements CleaningStaffRepositoryInterface
{
    protected $model;

    public function __construct(CleaningStaff $cleaning_staff)
    {
        $this->model = $cleaning_staff;
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        if ($search) {
            $query = CleaningStaff::
                where('firstname', 'like', "%".$search."%")
                ->orWhere('lastname', 'like', "%".$search."%");
        } else {
            $query = CleaningStaff::query();
        }

        $query->orderBy('firstname', 'asc')->orderBy('lastname', 'asc');

        if($shouldPaginate) {
            $result = $query->paginate( config('constants.pagination.per-page') );
        }else{
            $result = $query->get();
        }
        
        return $result;
    }

    public function create(Request $request)
    {
        CleaningStaffValidations::validateOnCreate($request);
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        CleaningStaffValidations::validateOnEdit($request, $id);
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $is_new = ! $id;

        if($is_new){
            $cleaning_staff = $this->blueprint();
        }else{
            $cleaning_staff = $this->find($id);
        }

        $checkboxesConfig = ['is_finished' => 0];
        $requestData = array_merge($checkboxesConfig, $request->all());

        $cleaning_staff->fill($requestData);
        $cleaning_staff->staff_group_id = 1; // temporal staff group id assignation
        $cleaning_staff->save();

        return $cleaning_staff;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $cleaning_staff = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$cleaning_staff) {
            throw new ModelNotFoundException("CleaningStaff not found");
        }

        return $cleaning_staff;
    }

    public function delete($id)
    {
        $cleaning_staff = $this->model->find($id);
        
        if ($cleaning_staff && $this->canDelete($id)) {
            $cleaning_staff->delete();
        }

        return $cleaning_staff;
    }

    public function canDelete($id) 
    {
        return true;
    }

    public function blueprint()
    {
        $cleaning_staff = new CleaningStaff;
        return $cleaning_staff;
    }
}
