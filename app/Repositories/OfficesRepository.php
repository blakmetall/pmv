<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\{
    Office,
    State
};
use App\Repositories\OfficesRepositoryInterface;
use App\Validations\OfficesValidations;
use App\Helpers\WorkgroupHelper;

class OfficesRepository implements OfficesRepositoryInterface
{
    private $model;
    private $validation;

    public function __construct(Office $office)
    {
        $this->model = $office;
        $this->validation = new OfficesValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        if ($search) {
            $query =
                Office::where('name', 'like', "%" . $search . "%")
                ->orWhere('id', $search);
        } else {
            $query = Office::query();
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

        foreach ($cities as $office) {
            $states_ids[] = $office->state_id;
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
            $office = $this->blueprint();
        } else {
            $office = $this->find($id);
        }

        $office->fill($request->all());
        $office->save();

        return $office;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $office = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$office) {
            throw new ModelNotFoundException("Office not found");
        }

        return $office;
    }

    public function delete($id)
    {
        $office = $this->model->find($id);

        if ($office && $this->canDelete($id)) {
            $office->delete();
        }

        return $office;
    }

    public function canDelete($id)
    {
        $isNotDefaultItem = $id > 2;
        return $isNotDefaultItem;
    }

    public function blueprint()
    {
        return new Office;
    }
}
