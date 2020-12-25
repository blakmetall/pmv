<?php

namespace App\Http\Controllers;

use App\Repositories\{OfficesRepositoryInterface, CitiesRepositoryInterface};
use Illuminate\Http\Request;
use App\Models\Office;

class OfficesController extends Controller
{
    private $repository;

    public function __construct(
        OfficesRepositoryInterface $repository,
        CitiesRepositoryInterface $citiesRepository
    ) {
        $this->repository = $repository;
        $this->citiesRepository = $citiesRepository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);
        $offices = $this->repository->all($search);

        return view('offices.index')
            ->with('offices', $offices)
            ->with('search', $search);
    }

    public function create()
    {
        $office = $this->repository->blueprint();

        $citiesConfig = [
            'paginate' => false,
            'filterByWorkgroup' => true,
        ];
        $cities = $this->citiesRepository->all('', $citiesConfig);
        $states = $this->citiesRepository->states($cities);

        return view('offices.create')
            ->with('office', $office)
            ->with('states', $states);
    }

    public function store(Request $request)
    {
        $office = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('offices.edit', [$office->id]));
    }

    public function show(Office $office)
    {
        $office = $this->repository->find($office);

        $citiesConfig = [
            'paginate' => false,
            'filterByWorkgroup' => true,
        ];
        $cities = $this->citiesRepository->all('', $citiesConfig);
        $states = $this->citiesRepository->states($cities);

        return view('offices.show')
            ->with('office', $office)
            ->with('states', $states);
    }

    public function edit(Office $office)
    {
        $office = $this->repository->find($office);

        $citiesConfig = [
            'paginate' => false,
            'filterByWorkgroup' => true,
        ];
        $cities = $this->citiesRepository->all('', $citiesConfig);
        $states = $this->citiesRepository->states($cities);

        return view('offices.edit')
            ->with('office', $office)
            ->with('states', $states);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect(route('offices.edit', [$id]));
    }

    public function destroy(Request $request, $id)
    {
        if ($this->repository->canDelete($id)) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('offices'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}
