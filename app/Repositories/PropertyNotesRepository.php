<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\PropertyNotesRepositoryInterface;
use App\Models\{ Property, PropertyNote };
use App\Validations\PropertyNotesValidations;

class PropertyNotesRepository implements PropertyNotesRepositoryInterface
{
    protected $model;

    public function __construct(PropertyNote $note)
    {
        $this->model = $note;
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $hasPropertyID = isset($config['property_id']) ? $config['property_id'] : '';

        if ($search) {
            $query = PropertyNote::where('description', 'like', "%".$search."%");
        } else {
            $query = PropertyNote::query();
        }

        if($hasPropertyID) {
            $query->where('property_id', $config['property_id']);
        }

        $query->with('property');
        $query->orderBy('description', 'asc');

        if($shouldPaginate) {
            $result = $query->paginate( config('constants.pagination.per-page') );
        }else{
            $result = $query->get();
        }
        
        return $result;
    }

    public function create(Request $request)
    {
        PropertyNotesValidations::validateOnCreate($request);
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        PropertyNotesValidations::validateOnEdit($request, $id);
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $is_new = ! $id;

        if($is_new){
            $note = $this->blueprint();
        }else{
            $note = $this->find($id);
        }

        $checkboxesConfig = ['is_finished' => 0];
        $requestData = array_merge($checkboxesConfig, $request->all());

        $note->fill($requestData);

        // audit
        if ($request->is_finished) {           
            $user = auth()->user();
            $note->audit_user_id = $user->id;
            $note->audit_datetime = getCurrentDateTime();
        } else {
            $note->audit_user_id = null;
            $note->audit_datetime = null;
        }

        $note->save();

        return $note;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $note = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$note) {
            throw new ModelNotFoundException("PropertyNote not found");
        }

        return $note;
    }

    public function delete($id)
    {
        $note = $this->model->find($id);
        
        if ($note && $this->canDelete($id)) {
            $note->delete();
        }

        return $note;
    }

    public function canDelete($id) 
    {
        return true;
    }

    public function blueprint()
    {
        $note = new PropertyNote;
        return $note;
    }
}
