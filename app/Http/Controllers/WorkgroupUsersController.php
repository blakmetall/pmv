<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\{ WorkgroupsRepositoryInterface, WorkgroupUsersRepositoryInterface };
use App\Models\Workgroup;

class WorkgroupUsersController extends Controller
{  
    private $workgroupsRepository; 
    private $repository; 
    
    public function __construct(
        WorkgroupsRepositoryInterface $workgroupsRepository,
        WorkgroupUsersRepositoryInterface $repository
) {
        $this->workgroupsRepository = $workgroupsRepository;
        $this->repository = $repository;
    }

    public function index(Request $request, Workgroup $workgroup)
    {
        $search = trim($request->s);
        $workgroup = $this->workgroupsRepository->find($workgroup);
        $workgroupUsers = $this->repository->all($search, ['workgroup' => $workgroup]);
        
        return view('workgroup-users.index')
            ->with('workgroupUsers', $workgroupUsers)
            ->with('workgroup', $workgroup)
            ->with('search', $search);
    }
}