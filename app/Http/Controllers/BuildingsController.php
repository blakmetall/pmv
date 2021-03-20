<?php

namespace App\Http\Controllers;

use App\Repositories\{BuildingsRepositoryInterface};
use Illuminate\Http\Request;
use App\Models\Building;

class BuildingsController extends Controller
{
    private $repository;

    public function __construct(BuildingsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);
        $buildings = $this->repository->all($search);

        return view('buildings.index')
            ->with('buildings', $buildings)
            ->with('search', $search);
    }

    public function create()
    {
        $building = $this->repository->blueprint();

        return view('buildings.create')
            ->with('building', $building);
    }

    public function store(Request $request)
    {
        $building = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('buildings.edit', [$building->id]));
    }

    public function show(Building $building)
    {
        $building = $this->repository->find($building);

        return view('buildings.show')
            ->with('building', $building);
    }

    public function edit(Building $building)
    {
        $building = $this->repository->find($building);

        return view('buildings.edit')
            ->with('building', $building);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect(route('buildings.edit', [$id]));
    }

    public function destroy(Request $request, $id)
    {
        if ($this->repository->canDelete($id)) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('buildings'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}
