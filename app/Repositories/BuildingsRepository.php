<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\BuildingsRepositoryInterface;
use App\Models\Building;
use App\Models\Property;
use App\Validations\BuildingsValidations;

class BuildingsRepository implements BuildingsRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(Building $building)
    {
        $this->model = $building;
        $this->validation = new BuildingsValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        if ($search) {
            $query = Building::where(function ($q) use ($search) {
                $q->where('name', 'like', "%" . $search . "%")
                    ->orWhere('description', 'like', "%" . $search . "%");
            })
                ->orWhere('id', $search);
        } else {
            $query = Building::query();
        }

        $query
            ->orderBy('name', 'asc');

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
            $building = $this->blueprint();
        } else {
            $building = $this->find($id);
        }

        $requestData = $request->all();

        $building->fill($requestData);
        $building->save();

        return $building;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $building = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$building) {
            throw new ModelNotFoundException("Building not found");
        }

        return $building;
    }

    public function delete($id)
    {
        $building = $this->model->find($id);

        if ($building && $this->canDelete($id)) {
            foreach ($building->properties() as $property) {
                $propertyDelete = Property::find($property->id);
                $propertyDelete->building_id = null;
                $propertyDelete->save();
            };
            $building->delete();
        }

        return $building;
    }

    public function canDelete($id)
    {
        return true;
    }

    public function blueprint()
    {
        return new Building;
    }
}
