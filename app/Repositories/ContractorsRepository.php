<?php

namespace App\Repositories;

use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\ContractorsRepositoryInterface;
use App\Models\{ Contractor };

class ContractorsRepository implements ContractorsRepositoryInterface
{
    protected $model;

    public function __construct(Contractor $contractor)
    {
        $this->model = $contractor;
    }

    public function all($search = '')
    {
        if ($search) {
            $query = Contractor::
                where('company', 'like', "%".$search."%")
                ->orWhere('contact_name', 'like', "%".$search."%")
                ->orWhere('phone', 'like', "%".$search."%")
                ->orWhere('mobile', 'like', "%".$search."%")
                ->orWhere('email', 'like', "%".$search."%")
                ->orWhere('address', 'like', "%".$search."%")
                ->orWhereHas('city', function($query) use ($search) {
                    $query->where('cities.name', 'like', $search);
                });
        } else {
            $query = Contractor::query();;
        }

        return $query
            ->orderBy('company', 'asc')
            ->paginate(30);
    }

    public function create(Request $request)
    {
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $is_new = ! $id;

        // en esta zona obtenemos los datos o preparamos las variables para asignarle lo que se envió en los formularios
        if($is_new){
            $contractor = $this->blueprint();
            $request->validate(Contractor::$saveValidation);
        }else{
            $contractor = $this->find($id);
            $request->validate(Contractor::$updateValidation);
        }
        // despues el guardado de los datos
        $contractor->fill($request->all());
        $contractor->save();

        return $contractor;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $contractor = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if ($contractor) {
            $contractor->first();
        }

        if (!$contractor) {
            throw new ModelNotFoundException("Contractor not found");
        }

        return $contractor;
    }

    public function delete($id)
    {
        $contractor =
            $this->model
                ->where('id', '>', '0') // to avoid deleting seed items
                ->find($id);

        if ($contractor) {
            $contractor->delete();
        }

        // return recently deleted object to be used if needed after operation
        // the object may or may not exists
        return $contractor;
    }

    /**
     * Return the blueprint of the model including translation elements
     */
    public function blueprint()
    {
        $contractor = new Contractor;
        return $contractor;
    }
}
