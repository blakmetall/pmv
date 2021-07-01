<?php

namespace App\Repositories;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use App\Validations\UsersValidations;
use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UsersRepository implements UsersRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(User $user)
    {
        $this->model = $user;
        $this->validation = new UsersValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $ownersOnly = isset($config['ownersOnly']) ? $config['ownersOnly'] : false;
        $agentsOnly = isset($config['agentsOnly']) ? $config['agentsOnly'] : false;
        $role = isset($config['role']) ? $config['role'] : false;

        if ($search) {
            $query = User::where('email', 'like', '%' . $search . '%')
                ->orWhereHas('profile', function ($query) use ($search) {
                    $query
                        ->where('profiles.firstname', 'like', $search)
                        ->orWhere('profiles.lastname', 'like', $search)
                        ->orWhere('profiles.country', 'like', $search)
                        ->orWhere('profiles.state', 'like', $search)
                        ->orWhere('profiles.city', 'like', $search)
                        ->orWhere('profiles.street', 'like', $search);
                })
                ->orWhere('id', $search);
        } else {
            $query = User::query();
        }

        if ($ownersOnly) {
            $query->whereHas('roles', function ($q) {
                $table = (new Role())->_getTable();
                $q->whereIn($table . '.id', [config('constants.roles.owner')]);
            });
        }

        if ($role) {
            $query->whereHas('roles', function ($q) use ($role) {
                $table = (new Role())->_getTable();
                $q->whereIn($table . '.id', [$role]);
            });
        }

        $query->with('profile')->orderBy('email', 'asc');

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
            $user = $this->blueprint();
        } else {
            $user = $this->find($id);
        }

        $checkboxesConfig = ['is_enabled' => 0];
        $requestData = array_merge($checkboxesConfig, $request->all());

        $user->fill($requestData);

        // passsword
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // workgroups assignation
        $user->workgroups()->sync($request->workgroups_ids);

        // roles assignation
        $prev_roles_ids = [];
        if ($request->attach_prev_roles) {
            if ($user->roles && count($user->roles)) {
                foreach ($user->roles as $r) {
                    $prev_roles_ids[] = $r->id;
                }
            }
        }

        if ($request->roles_ids && is_array($request->roles_ids) && count($request->roles_ids)) {
            $validRolesIds = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14];
            $roles_to_assign = [];

            foreach ($request->roles_ids as $role_id) {
                $hasValidRole = in_array($role_id, $validRolesIds);
                if ($hasValidRole) {
                    $roles_to_assign[] = $role_id;
                }
            }

            // attach super admin role when super admin edits himself
            if ($user->id == 1) {
                $roles_to_assign[] = 1;
            }

            if ($request->attach_prev_roles) {
                $roles_to_assign = array_unique(array_merge($roles_to_assign, $prev_roles_ids));
            }

            $user->roles()->sync($roles_to_assign);
        }

        // profile data
        if ($user->id) {
            if (!$user->profile) {
                $user->profile = new Profile();
                $user->profile->user_id = $user->id;
                $user->profile->config_role_id = $roles_to_assign[0]; // default active role on create
                $user->profile->config_language = 'es'; // default language on create
                
                $checkboxesConfig = [
                    'config_agent_is_enabled' => 0,
                    'config_role_id' => $roles_to_assign[0],
                ];
    
                $profileData = array_merge($checkboxesConfig, $request->profile);
    
                $user->profile->fill($profileData);
                $user->profile->save();
            }else{
                $user->profile->fill($request->profile);
                $user->profile->save();
            }

        }

        return $user;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $user = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$user) {
            throw new ModelNotFoundException('User not found');
        }

        return $user;
    }

    public function delete($id)
    {
        $user = $this->model->find($id);

        if ($user && $user->profile) {
            $user->profile->delete();
        }

        $user->roles()->sync([]);
        $user->workgroups()->sync([]);
        $user->delete();

        return $user;
    }

    public function canDelete($id)
    {
        $user = $this->find($id);

        if ($user) {
            if ($user->properties()->count()) {
                return false;
            }

            if ($user->bookings()->count()) {
                return false;
            }

            if ($user->agentBookings()->count()) {
                return false;
            }

            if ($user->reservationRequests()->count()) {
                return false;
            }
        }

        return $id > 1; // to not delete super admin
    }

    public function blueprint()
    {
        return new User();
    }
}
