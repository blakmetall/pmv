<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\{
    City,
    State
};
use App\Repositories\CitiesRepositoryInterface;
use App\Validations\CitiesValidations;
use App\Helpers\WorkgroupHelper;

class CitiesRepository implements CitiesRepositoryInterface
{
    private $model;
    private $validation;

    public function __construct(City $city)
    {
        $this->model = $city;
        $this->validation = new CitiesValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $shouldFilterByWorkgroup = isset($config['filterByWorkgroup']) ? $config['filterByWorkgroup'] : false;

        if ($search) {
            $query =
                City::where('name', 'like', "%" . $search . "%")
                ->orWhere('id', $search);
        } else {
            $query = City::query();
        }

        if ($shouldFilterByWorkgroup && WorkgroupHelper::shouldFilterByCity()) {
            $query->whereIn('id', WorkgroupHelper::getAllowedCities());
        }

        $query->orderBy('name', 'asc');

        if ($shouldPaginate) {
            $result = $query->paginate(config('constants.pagination.per-page'));
        } else {
            $result = $query->get();
        }

        return $result;
    }

    public function states($cities)
    {
        $states_ids = [];

        foreach ($cities as $city) {
            $states_ids[] = $city->state_id;
        }

        return State::whereIn('id', $states_ids)->orderBy('name', 'asc')->get();
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
            $city = $this->blueprint();
        } else {
            $city = $this->find($id);
        }

        $city->fill($request->all());
        $city->save();

        return $city;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $city = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$city) {
            throw new ModelNotFoundException("City not found");
        }

        return $city;
    }

    public function delete($id)
    {
        $city = $this->model->find($id);

        if ($city && $this->canDelete($id)) {
            $city->delete();
        }

        return $city;
    }

    public function canDelete($id)
    {
        $isNotDefaultItem = $id > 2;
        return $isNotDefaultItem;
    }

    public function blueprint()
    {
        return new City;
    }
}
