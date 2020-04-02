<?php

namespace App\Repositories;

use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\UsersRepositoryInterface;
use App\Models\{ Profile, User };
use App\Helpers\LanguageHelper;

class UsersRepository implements UsersRepositoryInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function all($search = '')
    {
        if ($search) {
            $query = User::
                where('email', 'like', "%".$search."%")
                    ->orWhereHas('profile', function($query) use ($search) {
                        $query
                            ->where('profiles.firstname', 'like', $search)
                            ->orWhere('profiles.lastname', 'like', $search)
                            ->orWhere('profiles.country', 'like', $search)
                            ->orWhere('profiles.state', 'like', $search)
                            ->orWhere('profiles.city', 'like', $search)
                            ->orWhere('profiles.street', 'like', $search);
                });
        } else {
            $query = new User;
        }

        return $query
            ->orderBy('email', 'asc')
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
            $user = $this->blueprint();
            $request->validate(User::$saveValidation);
        }else{
            $user = $this->find($id);
            $request->validate(User::$updateValidation);
        }
        
        // despues el guardado de los datos
        $user->fill($request->all());
        $user->is_enabled = $request->is_enabled ? 1 : 0;
        if ( !empty($request->password) ) {
            $user->password = Hash::make($request->password);
        }

        if($user->save()){
            //se obtiene el formulario del perfil y se guardan los datos
            $user->profile->fill($request->profile);
            $user->profile->save();
        }

        return $user;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $user = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$user) {
            throw new ModelNotFoundException("User not found");
        }

        return $user;
    }
    
    public function delete($id)
    {
        $user =
            $this->model
                ->where('id', '>', '4') // to avoid deleting seed items
                ->find($id);
        
        if ($user) {
            $user->delete();
        }

        // return recently deleted object to be used if needed after operation
        // the object may or may not exists
        return $user;
    }

    /**
     * Return the blueprint of the model including translation elements
     */
    public function blueprint()
    {
        $user = new User;
        $user->profile = new Profile;
        return $user;
    }
}
