<?php

namespace App\Repositories;

use App\Helpers\LanguageHelper;
use App\Models\User;
use App\Models\PropertyCheckList;
use App\Validations\PropertyCheckListValidations;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PropertyCheckListRepository implements PropertyCheckListRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(PropertyCheckList $checkList)
    {
        $this->model = $checkList;
        $this->validation = new PropertyCheckListValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate  = isset($config['paginate']) ? $config['paginate'] : true;
        $hasPropertyID   = isset($config['propertyID']) ? $config['propertyID'] : '';
        $filterById      = isset($search['property_id']) ? $search['property_id'] : '';

        $query = PropertyCheckList::query();

        if (isset($search['register_by']) && $search['register_by'] != '') {
            $query->whereHas('user', function ($query) use ($search) {
                $query->whereHas('profile', function ($query) use ($search) {
                    $query
                        ->where('profiles.firstname', 'like', '%' . $search['register_by'] . '%')
                        ->orWhere('profiles.lastname', 'like', '%' . $search['register_by'] . '%');
                });
            });
        }

        if (isset($search['from_date']) && $search['from_date'] != '') {
            $query->where(function ($query) use ($search) {
                if ($search['from_date'] != '') {
                    $query->whereDate('created_at', $search['from_date']);
                }
            });
        }

        if ($filterById) {
            $query->where('id', $filterById);
        }

        $query->where('property_id', $hasPropertyID);

        $query->orderBy('created_at', 'desc');

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
        $user = auth()->user();

        if ($is_new) {
            $randomId = rand(1, 99999999);
            $chekListTmp = $this->model->find($randomId);

            // avoid id duplicates
            while ($chekListTmp) {
                $randomId = rand(1, 99999999);
                $chekListTmp = $this->model->find($randomId);
            }

            $chekList = $this->blueprint();
            $chekList->id = $randomId;
            $data = [
                'user_id' => $user->id
            ];
        } else {
            $chekList = $this->find($id);
            $data = [];
        }



        $requestData = array_merge($data, $request->all());

        $chekList->fill($requestData);
        $chekList->save();

        return $chekList;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $chekList = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$chekList) {
            throw new ModelNotFoundException('Check List not found');
        }

        return $chekList;
    }

    public function delete($id)
    {
        $chekList = $this->model->find($id);

        if ($chekList && $this->canDelete($id)) {
            $chekList->delete();
        }

        return $chekList;
    }

    public function canDelete($id)
    {
        $chekList = $this->model->find($id);

        if ($chekList) {
        }

        return true;
    }

    public function blueprint()
    {
        return new PropertyCheckList();
    }
}
