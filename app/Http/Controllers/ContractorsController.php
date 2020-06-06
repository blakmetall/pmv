<?php

namespace App\Http\Controllers;

use App\Repositories\{ ContractorsRepositoryInterface, CitiesRepositoryInterface };
use Illuminate\Http\Request;
use App\Models\Contractor;

class ContractorsController extends Controller
{
    private $repository;
    private $citiesRepository;

    public function __construct(
        ContractorsRepositoryInterface $repository, 
        CitiesRepositoryInterface $citiesRepository
    ) {
        $this->repository = $repository;
        $this->citiesRepository = $citiesRepository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);

        $config = ['filterByWorkgroup' => true];
        $contractors = $this->repository->all($search, $config);

        return view('contractors.index')
            ->with('contractors', $contractors)
            ->with('search', $search);
    }

    public function create()
    {
        $contractor = $this->repository->blueprint();

        $citiesConfig = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $citiesConfig);

        return view('contractors.create')
            ->with('cities', $cities)
            ->with('contractor', $contractor);
    }

    public function store(Request $request)
    {
        $contractor = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('contractors.edit', [$contractor->id]));
    }

    public function show(Contractor $contractor)
    {
        $contractor = $this->repository->find($contractor);

        $citiesConfig = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $citiesConfig);

        return view('contractors.show')
            ->with('cities', $cities)
            ->with('contractor', $contractor);
    }

    public function edit(Contractor $contractor)
    {
        $contractor = $this->repository->find($contractor);
        
        $citiesConfig = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $citiesConfig);

        return view('contractors.edit')
            ->with('cities', $cities)
            ->with('contractor', $contractor);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect( route('contractors.edit', [$id]) );
    }

    public function destroy(Request $request, $id)
    {
        if ( $this->repository->canDelete($id) ) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('contractors'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}
