<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Repositories\{ 
    CitiesRepositoryInterface,
    WorkgroupsRepositoryInterface 
};
use App\Models\Workgroup;

class WorkgroupsController extends Controller
{  
    private $repository; 
    
    public function __construct(
        CitiesRepositoryInterface $citiesRepository,
        WorkgroupsRepositoryInterface $repository
    ) {
        $this->citiesRepository = $citiesRepository;
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);
        $workgroups = $this->repository->all($search);
        
        return view('workgroups.index')
            ->with('workgroups', $workgroups)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $workgroup = $this->repository->blueprint();

        $config = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $config);

        return view('workgroups.create')
            ->with('workgroup', $workgroup)
            ->with('cities', $cities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $workgroup = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('workgroups.edit', [$workgroup->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Workgroup $workgroup)
    {
        $workgroup = $this->repository->find($workgroup);        
        
        $config = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $config);

        return view('workgroups.show')
            ->with('workgroup', $workgroup)
            ->with('cities', $cities);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Workgroup $workgroup)
    {
        $workgroup = $this->repository->find($workgroup);        
        
        $config = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $config);

        return view('workgroups.edit')
            ->with('workgroup', $workgroup)
            ->with('cities', $cities);
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
        return redirect(route('workgroups.edit', [$id]));
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
            return redirect(route('workgroups'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}