<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\{ 
    UsersRepositoryInterface,
    WorkgroupsRepositoryInterface,
    WorkgroupUsersRepositoryInterface
};
use App\Models\{ Workgroup, WorkgroupUser };

class WorkgroupUsersController extends Controller
{  
    private $usersRepository; 
    private $workgroupsRepository; 
    private $repository; 
    
    public function __construct(
        UsersRepositoryInterface $usersRepository,
        WorkgroupsRepositoryInterface $workgroupsRepository,
        WorkgroupUsersRepositoryInterface $repository
    ) {
        $this->usersRepository = $usersRepository;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Workgroup $workgroup)
    {
        $workgroup = $this->workgroupsRepository->find($workgroup);
        $workgroupUser = $this->repository->blueprint();

        // TO-DO: se necesita filtrar por usuarios que no sean owner ni regular ni super-admin (el resto son empleados de algún tipo)
        $users = $this->usersRepository->all('', []); 

        return view('workgroup-users.create')
            ->with('workgroupUser', $workgroupUser)
            ->with('workgroup', $workgroup)
            ->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Workgroup $workgroup)
    {
        $workgroupUser = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('workgroup-users.edit', [$workgroup->id, $workgroupUser->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Workgroup $workgroup, WorkgroupUser $workgroupUser)
    {
        $workgroup = $this->workgroupsRepository->find($workgroup);
        $workgroupUser = $this->repository->find($workgroupUser);

        // TO-DO: se necesita filtrar por usuarios que no sean owner ni regular ni super-admin (el resto son empleados de algún tipo)
        $users = $this->usersRepository->all('', []);

        return view('workgroup-users.show')
            ->with('workgroupUser', $workgroupUser)
            ->with('workgroup', $workgroup)
            ->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Workgroup $workgroup, WorkgroupUser $workgroupUser)
    {
        $workgroupUser = $this->repository->find($workgroupUser);
        $workgroup = $this->workgroupsRepository->find($workgroup);

        // TO-DO: se necesita filtrar por usuarios que no sean owner ni regular ni super-admin (el resto son empleados de algún tipo)
        $users = $this->usersRepository->all('', []);

        return view('workgroup-users.edit')
            ->with('workgroupUser', $workgroupUser)
            ->with('workgroup', $workgroup)
            ->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workgroup $workgroup, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect(route('workgroup-users.edit', [$workgroup->id, $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Workgroup $workgroup, $id)
    {
        if ( $this->repository->canDelete($id) ) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('workgroup-users', [$workgroup->id]));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}