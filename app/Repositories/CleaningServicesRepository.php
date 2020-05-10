<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\CleaningServicesRepositoryInterface;
use App\Models\CleaningService;
use App\Validations\CleaningServicesValidations;

class CleaningServicesRepository implements CleaningServicesRepositoryInterface
{
    protected $model;

    public function __construct(CleaningService $cleaning_service)
    {
        $this->model = $cleaning_service;
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        if ($search) {
            $query = CleaningService::
                where('description', 'like', "%".$search."%");
        } else {
            $query = CleaningService::query();
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
        CleaningServicesValidations::validateOnCreate($request);
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        CleaningServicesValidations::validateOnEdit($request, $id);
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $is_new = ! $id;

        if($is_new){
            $cleaning_service = $this->blueprint();
        }else{
            $cleaning_service = $this->find($id);
        }

        $checkboxesConfig = ['is_finished' => 0];
        $requestData = array_merge($checkboxesConfig, $request->all());

        $cleaning_service->fill($requestData);

        $cleaning_service->save();

        // cleaning_staff assignation
        if ($request->cleaning_staff_ids && is_array($request->cleaning_staff_ids) && count($request->cleaning_staff_ids)) {
            $cleaning_service->cleaningStaff()->sync($request->cleaning_staff_ids);
        }

        return $cleaning_service;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $cleaning_service = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$cleaning_service) {
            throw new ModelNotFoundException("Cleaning Service not found");
        }

        return $cleaning_service;
    }

    public function delete($id)
    {
        $cleaning_service = $this->model->find($id);
        
        if ($cleaning_service && $this->canDelete($id)) {
            $cleaning_service->delete();
        }

        return $cleaning_service;
    }

    public function canDelete($id) 
    {
        return true;
    }

    public function blueprint()
    {
        $cleaning_service = new CleaningService;
        return $cleaning_service;
    }
}