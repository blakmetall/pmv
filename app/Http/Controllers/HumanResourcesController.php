<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\{
    HumanResourcesRepositoryInterface,
    CitiesRepositoryInterface
};
use App\Models\HumanResource;

class HumanResourcesController extends Controller
{
    private $repository;
    private $citiesRepository;

    public function __construct(
        HumanResourcesRepositoryInterface $repository,
        CitiesRepositoryInterface $citiesRepository
    )
    {
        $this->repository       = $repository;
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
        $human_resources = $this->repository->all($search);

        return view('human-resources.index')
            ->with('human_resources', $human_resources)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $human_resource = $this->repository->blueprint();

        $citiesConfig = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $citiesConfig);

        return view('human-resources.create')
            ->with('cities', $cities)
            ->with('human_resource', $human_resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $human_resource = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('human-resources.edit', [$human_resource->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(HumanResource $human_resource)
    {
        $human_resource = $this->repository->find($human_resource);

        $citiesConfig = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $citiesConfig);

        return view('human-resources.show')
            ->with('cities', $cities)
            ->with('human_resource', $human_resource);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(HumanResource $human_resource)
    {
        $human_resource = $this->repository->find($human_resource);

        $citiesConfig = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $citiesConfig);

        return view('human-resources.edit')
            ->with('cities', $cities)
            ->with('human_resource', $human_resource);
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
        return redirect( route('human-resources.edit', [$id]) );
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
            return redirect(route('human-resources'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}
