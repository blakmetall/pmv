<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\PropertyContactsRepositoryInterface;
use App\Models\{ Property, Contact };

class PropertyContactsRepository implements PropertyContactsRepositoryInterface
{
    protected $model;

    public function __construct(Property $property)
    {
        $this->model = $property;
    }

    public function all($search = '', $config = [], $property = '')
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        if ($search) {
            $query =
                Property::
                    WhereHas('contacts', function($query) use ($search) {
                        $query
                            ->where('firstname', 'like', $search)
                            ->orWhere('lastname', 'like', $search)
                            ->orWhere('email', 'like', $search)
                            ->orWhere('phone', 'like', $search)
                            ->orWhere('mobile', 'like', $search)
                            ->orWhere('address', 'like', $search);
                    });
        } else {
            $query = $property->contacts();
        }

        $query->orderBy('created_at', 'asc');

        if($shouldPaginate) {
            $result = $query->paginate( config('constants.pagination.per-page') );
        }else{
            $result = $query->get();
        }

        return $result;
    }

    public function create(Request $request)
    {
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
    }

    public function save(Request $request, $id = '')
    {
        $property = $this->find($request->property_id);

        // contacts assignation
        $property->contacts()->sync($request->contacts_ids);

        return $property;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $property = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$property) {
            throw new ModelNotFoundException("Property not found");
        }

        return $property;
    }

    public function delete($id)
    {
    }

    public function canDelete($id)
    {
    }

    public function blueprint()
    {
        $contacts = Contact::where('is_active', 1)->get();
        return $contacts;
    }
}
