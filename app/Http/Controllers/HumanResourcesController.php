<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\{
    HumanResourcesRepositoryInterface,
    CitiesRepositoryInterface
};
use App\Models\HumanResource;
// use App\Exports\HumanResourcesExport;

class HumanResourcesController extends Controller
{
    private $repository;
    private $citiesRepository;

    public function __construct(
        HumanResourcesRepositoryInterface $repository,
        CitiesRepositoryInterface $citiesRepository
    ) {
        $this->repository       = $repository;
        $this->citiesRepository = $citiesRepository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);

        $config = ['filterByWorkgroup' => true];
        $human_resources = $this->repository->all($search, $config);        

        return view('human-resources.index')
            ->with('human_resources', $human_resources)
            ->with('search', $search);
    }

    public function create()
    {
        $human_resource = $this->repository->blueprint();

        $citiesConfig = [
            'paginate' => false,
            'filterByWorkgroup' => true,
        ];
        $cities = $this->citiesRepository->all('', $citiesConfig);

        return view('human-resources.create')
            ->with('cities', $cities)
            ->with('human_resource', $human_resource);
    }

    public function store(Request $request)
    {
        $human_resource = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('human-resources.edit', [$human_resource->id]));
    }

    public function show(HumanResource $human_resource)
    {
        $human_resource = $this->repository->find($human_resource);

        $citiesConfig = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $citiesConfig);

        return view('human-resources.show')
            ->with('cities', $cities)
            ->with('human_resource', $human_resource);
    }

    public function edit(HumanResource $human_resource)
    {
        $human_resource = $this->repository->find($human_resource);

        $citiesConfig = [
            'paginate' => false,
            'filterByWorkgroup' => true,
        ];
        $cities = $this->citiesRepository->all('', $citiesConfig);

        return view('human-resources.edit')
            ->with('cities', $cities)
            ->with('human_resource', $human_resource);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect( route('human-resources.edit', [$id]) );
    }

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

    public function directory(Request $request) {
        $search = trim($request->s);

        $human_resources = $this->repository->all($search, []);        

        return view('human-resources.directory')
            ->with('human_resources', $human_resources)
            ->with('search', $search);
    }
}
