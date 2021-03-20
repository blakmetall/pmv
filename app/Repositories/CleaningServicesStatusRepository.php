<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\CleaningServicesStatusRepositoryInterface;
use App\Models\CleaningServiceStatus;

class CleaningServicesStatusRepository implements CleaningServicesStatusRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(CleaningServiceStatus $cleaning_service_status)
    {
        $this->model = $cleaning_service_status;
    }

    public function all($search = '', $config = [])
    {
        $result = CleaningServiceStatus::get();
        return $result;
    }

    public function create(Request $request)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function save(Request $request, $id = '')
    {
    }

    public function find($id_or_obj)
    {
    }

    public function delete($id)
    {
    }

    public function canDelete($id)
    {
        return true;
    }

    public function blueprint()
    {
        return new CleaningServiceStatus;
    }
}
