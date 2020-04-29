<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\PropertyContactsRepositoryInterface;
use App\Models\{ Property, PropertyContact };
use App\Validations\PropertyContactsValidations;

class PropertyContactsRepository implements PropertyContactsRepositoryInterface
{
    protected $model;

    public function __construct(PropertyContact $contact)
    {
        $this->model = $contact;
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $hasPropertyID = isset($config['property_id']) ? $config['property_id'] : '';

        if ($search) {
            $query = 
                PropertyContact::
                    where('name', 'like', "%".$search."%")
                    ->orWhere('email', 'like', "%".$search."%");
        } else {
            $query = PropertyContact::query();
        }

        if($hasPropertyID) {
            $query->where('property_id', $config['property_id']);
        }

        $query->with('property');
        $query->orderBy('name', 'asc');

        if($shouldPaginate) {
            $result = $query->paginate( config('constants.pagination.per-page') );
        }else{
            $result = $query->get();
        }
        
        return $result;
    }

    public function create(Request $request)
    {
        PropertyContactsValidations::validateOnCreate($request);
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        PropertyContactsValidations::validateOnEdit($request, $id);
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $is_new = ! $id;

        if($is_new){
            $contact = $this->blueprint();
        }else{
            $contact = $this->find($id);
        }

        $contact->fill($request->all());
        $contact->save();

        return $contact;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $contact = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$contact) {
            throw new ModelNotFoundException("PropertyContact not found");
        }

        return $contact;
    }

    public function delete($id)
    {
        $contact = $this->model->find($id);
        
        if ($contact && $this->canDelete($id)) {
            $contact->delete();
        }

        return $contact;
    }

    public function canDelete($id) 
    {
        return true;
    }

    public function blueprint()
    {
        $contact = new PropertyContact;
        return $contact;
    }
}
