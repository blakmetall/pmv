<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\PropertyNotesRepositoryInterface;
use App\Models\{ Property, PropertyNote };
use App\Validations\PropertyNotesValidations;
use App\Helpers\UserHelper;

class PropertyNotesRepository implements PropertyNotesRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(PropertyNote $note)
    {
        $this->model = $note;
        $this->validation = new PropertyNotesValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $hasPropertyID = isset($config['property_id']) ? $config['property_id'] : '';
        $shouldFilterAuditedOnly = isset($config['auditedOnly']) ? $config['auditedOnly'] : '';

        if ($search) {
            $query = PropertyNote::where('description', 'like', "%".$search."%");
        } else {
            $query = PropertyNote::query();
        }

        if($hasPropertyID) {
            $query->where('property_id', $config['property_id']);
        }

        if($shouldFilterAuditedOnly) {
            $query->where('audit_user_id', '!=', 1);
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
        $is_new = ! $id;

        if($is_new){
            $note = $this->blueprint();
        }else{
            $note = $this->find($id);
        }

        $checkboxesConfig = ['is_finished' => 0];
        $requestData = array_merge($checkboxesConfig, $request->all());
        
        $note->fill($requestData);
        
        $hasBeenAudited = $note->audit_user_id;
        $shouldRemovePreviousAuditedUser = !$request->is_finished && $hasBeenAudited;
        $shouldNotRemovePreviousAuditedUser = $request->is_finished && !$hasBeenAudited;

        if($shouldRemovePreviousAuditedUser) {
            $note->audit_user_id = null;
            $note->audit_datetime = null;
        }   

        if ($shouldNotRemovePreviousAuditedUser) {           
            $note->audit_user_id = UserHelper::getCurrentUserID();
            $note->audit_datetime = getCurrentDateTime();
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
        return new PropertyNote;
    }
}
