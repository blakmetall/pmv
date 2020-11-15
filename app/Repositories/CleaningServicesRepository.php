<?php

namespace App\Repositories;

use App\Helpers\LanguageHelper;
use App\Helpers\UserHelper;
use App\Helpers\WorkgroupHelper;
use App\Models\CleaningService;
use App\Models\HumanResource;
use App\Models\Property;
use App\Validations\CleaningServicesValidations;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CleaningServicesRepository implements CleaningServicesRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(CleaningService $cleaning_service)
    {
        $this->model = $cleaning_service;
        $this->validation = new CleaningServicesValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $shouldFilterByWorkgroup = isset($config['filterByWorkgroup']) ? $config['filterByWorkgroup'] : false;
        $shouldFilterByOwner = isset($config['filterByOwner']) ? $config['filterByOwner'] : false;
        
        if ($search) {
            $query = CleaningService::where('description', 'like', '%' . $search . '%');
        } else {
            $query = CleaningService::query();
        }

        $query
            ->with('cleaningStaff')
            ->orderBy('is_finished', 'asc')
            ->orderBy('created_at', 'desc');

        if ($shouldFilterByWorkgroup && WorkgroupHelper::shouldFilterByCity()) {
            $query->whereHas('property', function ($q) {
                $q->whereIn('properties.city_id', WorkgroupHelper::getAllowedCities());
            });
        }

        if ($shouldFilterByOwner && isRole('owner')) {
            $query->whereHas('property', function ($query) {
                $query->where('properties.user_id', UserHelper::getCurrentUserID());
            });
        }

        if ($shouldPaginate) {
            $result = $query->paginate(config('constants.pagination.per-page'));
        } else {
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
        $is_new = !$id;

        if ($is_new) {
            $cleaning_service = $this->blueprint();
        } else {
            $cleaning_service = $this->find($id);
        }

        $checkboxesConfig = ['is_finished' => 0];
        $requestData = array_merge($checkboxesConfig, $request->all());

        $cleaning_service->fill($requestData);

        // audit
        $hasPreviousAudit = $cleaning_service->audit_user_id;

        if ($request->is_finished) {
            if (!$hasPreviousAudit) {
                $user = auth()->user();
                $cleaning_service->audit_user_id = $user->id;
                $cleaning_service->audit_datetime = getCurrentDateTime();
            }
        } else {
            $cleaning_service->audit_user_id = null;
            $cleaning_service->audit_datetime = null;
        }

        $cleaning_service->save();

        // status assignation
        $cleaning_service->cleaningServicesStatus()->sync($request->status_ids);

        // $property = Property::find($request->property_id)->first();
        $property = $cleaning_service->property;
        if ($property) {
            $cleaning_staff_ids = [];
            if ($property->cleaning_staff_ids) {
                foreach ($property->cleaning_staff_ids as $staff_id) {
                    if (HumanResource::where('id', $staff_id)->count()) {
                        $cleaning_staff_ids[] = $staff_id;
                    }
                }
            }

            // cleaning_staff assignation
            if ($cleaning_staff_ids && is_array($cleaning_staff_ids) && count($cleaning_staff_ids)) {
                $cleaning_service->cleaningStaff()->sync($cleaning_staff_ids);
            }
        }

        return $cleaning_service;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $cleaning_service = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$cleaning_service) {
            throw new ModelNotFoundException('Cleaning Service not found');
        }

        return $cleaning_service;
    }

    public function delete($id)
    {
        $cleaning_service = $this->model->find($id);

        if ($cleaning_service && $this->canDelete($id)) {
            $cleaning_service->cleaningStaff()->sync([]);
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
        return new CleaningService();
    }
}
