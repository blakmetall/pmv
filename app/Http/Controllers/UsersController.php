<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\{ UsersRepositoryInterface, RolesRepositoryInterface };
use App\Models\{Profile, User};

class UsersController extends Controller
{
    private $repository;
    private $rolesRepository;

    public function __construct(UsersRepositoryInterface $repository, RolesRepositoryInterface $rolesRepository)
    {
        $this->repository = $repository;
        $this->rolesRepository = $rolesRepository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);
        $users = $this->repository->all($search);

        return view('users.index')
            ->with('users', $users)
            ->with('search', $search);
    }

    public function create()
    {
        $user = $this->repository->blueprint();
        $user->profile = new Profile;

        $rolesConfig = ['skipSuperAdmin' => true];
        $roles = $this->rolesRepository->all('', $rolesConfig);

        return view('users.create')
            ->with('user', $user)
            ->with('roles', $roles);
    }

    public function store(Request $request)
    {
        $user = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('users.edit', [$user->id]));
    }

    public function show(User $user)
    {
        $user = $this->repository->find($user);

        $rolesConfig = ['skipSuperAdmin' => true];
        $roles = $this->rolesRepository->all('', $rolesConfig);

        return view('users.show')
            ->with('user', $user)
            ->with('roles', $roles);
    }

    public function edit(Request $request, User $user)
    {
        if ($user->id == 1 && !auth()->user()->isSuper()) {
            $request->session()->flash('error', __("We're sorry, you don't have permissions to this section."));
            return redirect()->back();
        }

        $user = $this->repository->find($user);
        $rolesConfig = ['skipSuperAdmin' => true];
        $roles = $this->rolesRepository->all('', $rolesConfig);

        return view('users.edit')
            ->with('user', $user)
            ->with('roles', $roles);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect( route('users.edit', [$id]) );
    }

    public function destroy(Request $request, $id)
    {
        if ( $this->repository->canDelete($id) ) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('users'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}
