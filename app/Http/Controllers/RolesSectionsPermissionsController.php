<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\RoleHelper;
use App\Repositories\RolesSectionsPermissionsRepositoryInterface;
use App\Repositories\RolesRepositoryInterface;

class RolesSectionsPermissionsController extends Controller
{
    private $repository;
    private $rolesRepository;

    public function __construct(
        RolesSectionsPermissionsRepositoryInterface $repository,
        RolesRepositoryInterface $rolesRepository
    ) {
        $this->repository = $repository;
        $this->rolesRepository = $rolesRepository;
    }

    public function index()
    {
        $roles = $this->rolesRepository->all();
        $sectionsPermissions = $this->repository->all();

        return view('roles.sections-permissions.index')
            ->with('roles', $roles)
            ->with('sectionsPermissions', $sectionsPermissions);
    }

    public function setActive($id) 
    { 
        RoleHelper::setActive($id);
        return redirect(route('dashboard'));
    }
}