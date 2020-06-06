<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ZonesRepositoryInterface;
use App\Models\{ City, Zone };

class ZonesController extends Controller
{
    private $repository;

    public function __construct(ZonesRepositoryInterface $repository) 
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);
        $zones = $this->repository->all($search);

        return view('zones.index')
            ->with('zones', $zones)
            ->with('search', $search);
    }

    public function create()
    {
        $zone = $this->repository->blueprint();
        $cities = City::orderBy('name', 'asc')->get();

        return view('zones.create')
            ->with('zone', $zone)
            ->with('cities', $cities);
    }

    public function store(Request $request)
    { 
        $zone = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('zones.edit', [$zone->id]));
    }

    public function show(Zone $zone)
    {
        $zone = $this->repository->find($zone);
        $cities = City::orderBy('name', 'asc')->get();

        return view('zones.show')
            ->with('zone', $zone)
            ->with('cities', $cities);
    }

    public function edit(Zone $zone)
    {
        $zone = $this->repository->find($zone);
        $cities = City::orderBy('name', 'asc')->get();

        return view('zones.edit')
            ->with('zone', $zone)
            ->with('cities', $cities);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect(route('zones.edit', [$id]));
    }

    public function destroy(Request $request, $id)
    {
        if ( $this->repository->canDelete($id) ) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('zones'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}