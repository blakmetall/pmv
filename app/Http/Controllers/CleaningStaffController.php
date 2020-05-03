<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\{
    CleaningStaffRepositoryInterface
};
use App\Models\CleaningStaff;

class CleaningStaffController extends Controller
{
    private $repository;

    public function __construct(
        CleaningStaffRepositoryInterface $repository
    )
    {
        $this->repository      = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->s);
        $cleaning_staff = $this->repository->all($search);

        return view('cleaning-staff.index')
            ->with('cleaning_staff', $cleaning_staff)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cleaning_staff = $this->repository->blueprint();

        return view('cleaning-staff.create')
            ->with('cleaning_staff', $cleaning_staff);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cleaning_staff = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('cleaning-staff.edit', [$cleaning_staff->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CleaningStaff $cleaning_staff)
    {
        $cleaning_staff = $this->repository->find($cleaning_staff);

        return view('cleaning-staff.show')
            ->with('cleaning_staff', $cleaning_staff);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CleaningStaff $cleaning_staff)
    {
        $cleaning_staff = $this->repository->find($cleaning_staff);

        return view('cleaning-staff.edit')
            ->with('cleaning_staff', $cleaning_staff);
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
        return redirect( route('cleaning-staff.edit', [$id]) );
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
            return redirect(route('cleaning-staff'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}
