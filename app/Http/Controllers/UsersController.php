<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Models\Role;
use App\Helpers\LanguageHelper;
use App\Repositories\RolesRepositoryInterface;
use App\Repositories\UsersRepositoryInterface;
use App\Repositories\WorkgroupsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class UsersController extends Controller
{
    private $repository;
    private $rolesRepository;
    private $workgroupsRepository;

    public function __construct(
        UsersRepositoryInterface $repository,
        RolesRepositoryInterface $rolesRepository,
        WorkgroupsRepositoryInterface $workgroupsRepository
    ) {
        $this->repository = $repository;
        $this->rolesRepository = $rolesRepository;
        $this->workgroupsRepository = $workgroupsRepository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);
        $config = ['role' => $request->role];
        $users = $this->repository->all($search, $config);
        $allRoles = Role::all();
        $lang = LanguageHelper::current();
        $roles = [];
        foreach ($allRoles as $index => $role) {
            $roles[$index]['id'] = $role->translations()->where('language_id', $lang->id)->first()->role_id;
            $roles[$index]['name'] = $role->translations()->where('language_id', $lang->id)->first()->name;
        }

        return view('users.index')
            ->with('users', $users)
            ->with('roles', $roles)
            ->with('search', $search);
    }

    public function create()
    {
        $user = $this->repository->blueprint();
        $user->profile = new Profile();

        $rolesConfig = ['skipSuperAdmin' => true, 'skipRegularRole' => true];
        $roles = $this->rolesRepository->all('', $rolesConfig);

        $workgroups = $this->workgroupsRepository->all('', ['paginate' => false]);
        foreach ($workgroups as $index => $workgroup) {
            $workgroups[$index]->name = $workgroup->city->name;
        }

        return view('users.create')
            ->with('user', $user)
            ->with('roles', $roles)
            ->with('workgroups', $workgroups);
    }

    public function createAjax()
    {
        $user = $this->repository->blueprint();
        $user->profile = new Profile();

        $rolesConfig = ['skipSuperAdmin' => true, 'skipRegularRole' => true];
        $roles = $this->rolesRepository->all('', $rolesConfig);

        $workgroups = $this->workgroupsRepository->all('', ['paginate' => false]);
        foreach ($workgroups as $index => $workgroup) {
            $workgroups[$index]->name = $workgroup->city->name;
        }

        return view('users.create-ajax')
            ->with('user', $user)
            ->with('roles', $roles)
            ->with('workgroups', $workgroups);
    }

    public function store(Request $request)
    {
        $user = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));

        if ($request->request_password_reset) {
            $resetToken = Password::broker()->createToken($user);
            $user->sendPasswordResetNotification($resetToken);
        }

        return redirect(route('users.edit', [$user->id]));
    }

    public function storeAjax(Request $request)
    {
        $users = $this->repository->all('');
        $user = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));

        if ($request->request_password_reset) {
            $resetToken = Password::broker()->createToken($user);
            $user->sendPasswordResetNotification($resetToken);
        }

        $app = app();
        $data = $app->make('stdClass');
        $data->users = $users;
        $data->user = $user->profile;

        return response()->json($data);
    }

    public function show(User $user)
    {
        $user = $this->repository->find($user);

        $rolesConfig = ['skipSuperAdmin' => true, 'skipRegularRole' => true];
        $roles = $this->rolesRepository->all('', $rolesConfig);

        $workgroups = $this->workgroupsRepository->all('', ['paginate' => false]);
        foreach ($workgroups as $index => $workgroup) {
            $workgroups[$index]->name = $workgroup->city->name;
        }

        return view('users.show')
            ->with('user', $user)
            ->with('roles', $roles)
            ->with('workgroups', $workgroups);
    }

    public function edit(Request $request, User $user)
    {
        if ($user->id == 1 && !auth()->user()->isSuper()) {
            $request->session()->flash('error', __("We're sorry, you don't have permissions to this section."));

            return redirect()->back();
        }

        $user = $this->repository->find($user);
        $rolesConfig = ['skipSuperAdmin' => true, 'skipRegularRole' => true];
        $roles = $this->rolesRepository->all('', $rolesConfig);

        $workgroups = $this->workgroupsRepository->all('', ['paginate' => false]);
        foreach ($workgroups as $index => $workgroup) {
            $workgroups[$index]->name = $workgroup->city->name;
        }

        return view('users.edit')
            ->with('user', $user)
            ->with('roles', $roles)
            ->with('workgroups', $workgroups);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));

        return redirect(route('users.edit', [$id]));
    }

    public function destroy(Request $request, $id)
    {
        if ($this->repository->canDelete($id)) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));

            return redirect(route('users'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));

        return redirect()->back();
    }

    public function email(Request $request, User $user)
    {
        $user = $this->repository->find($user);

        $resetToken = Password::broker()->createToken($user);
        $user->sendPasswordResetNotification($resetToken);

        $request->session()->flash('success', __('Email sent successfully'));

        return redirect()->back();
    }
}
