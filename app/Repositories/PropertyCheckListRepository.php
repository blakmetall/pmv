<?php

namespace App\Repositories;

use App\Helpers\LanguageHelper;
use App\Models\PropertyCheckList;
use App\Validations\PropertyCheckListValidations;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PropertyBookingsRepository implements PropertyBookingsRepositoryInterface
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
        $lang = LanguageHelper::current();

        $shouldPaginate  = isset($config['paginate']) ? $config['paginate'] : true;
        $hasPropertyID   = isset($config['propertyID']) ? $config['propertyID'] : '';
        $currentYear     = isset($config['currentYear']) ? $config['currentYear'] : '';

        if (isset($search['from_date']) && $search['from_date'] != '' || isset($search['to_date']) && $search['to_date'] != '' || isset($search['location']) && $search['location'] != '' || isset($search['register_by']) && $search['register_by']) {
            $query = PropertyCheckList::query();
        } else {
            $query = PropertyCheckList::query();
            $query->with('property');

            if ($search && is_string($search)) {
                $query->where('property_check_list.id', $search);
            }
        }

        $query->where('property_id', $hasPropertyID);

        if ($currentYear) {
            $query->whereYear('arrival_date', $currentYear);
        }

        $query->orderBy('created_at', 'desc');

        if ($shouldPaginate) {
            // $result = $query->paginate(9999);
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
        } else {
            $chekList = $this->find($id);
        }

        $data = [
            'user_id' => $user->id,
            'is_confirmed' => 0,
            'is_paid' => 0,
            'is_refundable' => 0,
            'is_cancelled' => 0,
            'is_finished' => 0,
            'arrival_transportation' => 0,
            'departure_transportation' => 0,
        ];

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
