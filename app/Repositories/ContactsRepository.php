<?php

namespace App\Repositories;

use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\ContactsRepositoryInterface;
use App\Models\Contact;
use App\Validations\ContactsValidations;

class ContactsRepository implements ContactsRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(Contact $contact)
    {
        $this->model = $contact;
        $this->validation = new ContactsValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $shouldFilterByActive = isset($config['activeOnly']) ? $config['activeOnly'] : true;

        if ($search) {
            $query = Contact::
                where(function($q) use($search) {
                    $q->where('firstname', 'like', "%".$search."%")
                    ->orWhere('lastname', 'like', "%".$search."%")
                    ->orWhere('email', 'like', "%".$search."%")
                    ->orWhere('phone', 'like', "%".$search."%")
                    ->orWhere('mobile', 'like', "%".$search."%")
                    ->orWhere('address', 'like', "%".$search."%");
                })
                ->orWhere('id', $search);
        } else {
            $query = Contact::query();
        }

        if ($shouldFilterByActive) {
            $query->where('is_active', 1);
        }

        $query
            ->orderBy('is_active', 'asc')
            ->orderBy('firstname', 'asc')
            ->orderBy('lastname', 'asc');

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
            $contact = $this->blueprint();
        }else{
            $contact = $this->find($id);
        }

        $checkboxesConfig = ['is_active' => 0];
        $requestData = array_merge($checkboxesConfig, $request->all());

        $contact->fill($requestData);
        $contact->save();

        return $contact;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $contact = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$contact) {
            throw new ModelNotFoundException("Contact not found");
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
        return new Contact;
    }
}
