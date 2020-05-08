<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\{
    StaffGroupsRepositoryInterface,
    UsersRepositoryInterface,
    CitiesRepositoryInterface
};
use App\Models\StaffGroup;

class StaffGroupsController extends Controller
{
    private $repository;
    private $usersRepository;
    private $citiesRepository;

    public function __construct(
        StaffGroupsRepositoryInterface $repository,
        UsersRepositoryInterface $usersRepository,
        CitiesRepositoryInterface $citiesRepository
    )
    {
        $this->repository       = $repository;
        $this->usersRepository  = $usersRepository;
        $this->citiesRepository = $citiesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->s);
        $staff_groups = $this->repository->all($search);

        return view('staff-groups.index')
            ->with('staff_groups', $staff_groups)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staff_group = $this->repository->blueprint();

        $configUsers = ['paginate' => false, 'ownersOnly' => false];
        $users = $this->usersRepository->all('', $configUsers);

        $citiesConfig = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $citiesConfig);

        return view('staff-groups.create')
            ->with('users', $users)
            ->with('cities', $cities)
            ->with('staff_group', $staff_group);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $staff_group = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('staff-groups.edit', [$staff_group->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(StaffGroup $staff_group)
    {
        $staff_group = $this->repository->find($staff_group);

        $configUsers = ['paginate' => false, 'ownersOnly' => false];
        $users = $this->usersRepository->all('', $configUsers);

        $citiesConfig = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $citiesConfig);

        return view('staff-groups.show')
            ->with('users', $users)
            ->with('cities', $cities)
            ->with('staff_group', $staff_group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffGroup $staff_group)
    {
        $staff_group = $this->repository->find($staff_group);

        $configUsers = ['paginate' => false, 'ownersOnly' => false];
        $users = $this->usersRepository->all('', $configUsers);

        $citiesConfig = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $citiesConfig);

        return view('staff-groups.edit')
            ->with('users', $users)
            ->with('cities', $cities)
            ->with('staff_group', $staff_group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect( route('staff-groups.edit', [$id]) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ( $this->repository->canDelete($id) ) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('staff-groups'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}
