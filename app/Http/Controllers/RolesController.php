<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\RoleHelper;
use App\Repositories\RolesRepositoryInterface;

class RolesController extends Controller
{
    private $repository;

    public function __construct(RolesRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function index()
    {
        $roles = $this->repository->all();
        return view('roles.index')->with('roles', $roles);
    }

    public function setActive($id) 
    { 
        RoleHelper::setActive($id);
        return redirect(route('dashboard'));
    }
}