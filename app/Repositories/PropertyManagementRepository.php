<?php

namespace App\Repositories;

use App\Helpers\LanguageHelper;
use App\Models\PropertyManagement;
use App\Validations\PropertyManagementValidations;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PropertyManagementRepository implements PropertyManagementRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(PropertyManagement $pm)
    {
        $this->model = $pm;
        $this->validation = new PropertyManagementValidations();
    }

    public function all($search = '', $config = [])
    {
        $lang = LanguageHelper::current();

        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $unfinishedOnly = isset($config['unfinishedOnly']) ? $config['unfinishedOnly'] : false;
        $finishedOnly = isset($config['finishedOnly']) ? $config['finishedOnly'] : false;
        $hasPropertyID = isset($config['propertyID']) ? $config['propertyID'] : '';
        $filterByCity = isset($config['filterByCity']) ? $config['filterByCity'] : '';
        $filterByOwner = isset($config['filterByOwner']) ? $config['filterByOwner'] : '';
        // $filterByEnabled = isset($config['filterByEnabled']) ? $config['filterByEnabled'] : '';
        $shouldFilterByYear = isset($config['filterByYear']) ? $config['filterByYear'] : '';
        $shouldFilterByMonth = isset($config['filterByMonth']) ? $config['filterByMonth'] : '';

        if ($search || $filterByCity) {
            $query = PropertyManagement::query();
            $query->where(function ($query) use ($search) {
                $query->where('start_date', 'like', '%' . $search . '%');
                $query->orWhere('end_date', 'like', '%' . $search . '%');
            });
        } else {
            $query = PropertyManagement::query();
            $query->with('property');
        }

        if ($filterByCity) {
            $query->whereHas('property', function ($q) use ($filterByCity) {
                $q->where('city_id', 'like', '%' . $filterByCity . '%');
            });
        }

        if ($filterByOwner) {
            $query->whereHas('property', function ($q) {
                $q->whereHas('users', function ($q2) {
                    $q2->where('user_id', \Auth::id());
                });
            })->where('language_id', $lang->id);
        }

        if ($hasPropertyID) {
            $query->where('property_id', $config['propertyID']);
            $query->orderBy('is_finished', 'asc');
            $query->orderBy('start_date', 'desc');
        } else {
            $query->select('property_management.*');
            $query->join('properties', 'property_management.property_id', '=', 'properties.id');
            $query->join('properties_translations', 'properties.id', '=', 'properties_translations.property_id');
            $query->where('language_id', $lang->id);
            $query->orderBy('name', 'asc');

            if ($search) {
                $query->orWhere('properties_translations.name', 'like', '%' . $search . '%');
            }
        }

        if ($unfinishedOnly) {
            $query->where('is_finished', '!=', 1);
        }

        if ($finishedOnly) {
            $query->where('is_finished', 1);
        }

        // if($filterByEnabled) {
        //     $query->where('is_enabled', 1);
        // }

        if ($shouldPaginate) {
            $result = $query->paginate(9999);
        } else {
            $result = $query->get();
        }

        if ($shouldFilterByYear && $shouldFilterByMonth) {
            $dateString = $config['filterByYear'].'-'.$config['filterByMonth'];
            foreach ($result as $index => $pm_item) {
                $dates = getDatesFromRange($pm_item->start_date, $pm_item->end_date, 'Y-m');
                if(!in_array($dateString, $dates)){
                    unset($result[$index]);
                }
            }
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
            $pm = $this->blueprint();
        } else {
            $pm = $this->find($id);
        }

        $checkboxesConfig = ['is_finished' => 0];
        $requestData = array_merge($checkboxesConfig, $request->all());

        $pm->fill($requestData);

        $pm->save();

        return $pm;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $pm = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$pm) {
            throw new ModelNotFoundException('PropertyManagement not found');
        }

        return $pm;
    }

    public function delete($id)
    {
        $pm = $this->model->find($id);

        if ($pm && $this->canDelete($id)) {
            $pm->delete();
        }

        return $pm;
    }

    public function canDelete($id)
    {
        $pm = $this->model->find($id);

        if ($pm) {
            // validate empty usage in transactions
            if ($pm->transactions()->count()) {
                return false;
            }
        }

        return true;
    }

    public function blueprint()
    {
        return new PropertyManagement();
    }
}
