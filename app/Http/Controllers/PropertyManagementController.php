<?php

namespace App\Http\Controllers;

use App\Repositories\{ PropertyManagementRepositoryInterface };
use Illuminate\Http\Request;
use App\Models\{ Property, PropertyManagement };

class PropertyManagementController extends Controller
{
    private $repository;

    public function __construct(PropertyManagementRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request, Property $property)
    {
        $search = trim($request->s);

        $config = ['propertyID' => $property->id, 'unfinishedOnly' => true];
        $pm_items = $this->repository->all($search, $config);

        return view('property-management.index')
            ->with('pm_items', $pm_items)
            ->with('property', $property)
            ->with('search', $search);
    }

    public function general(Request $request)
    {
        $search = trim($request->s);

        $config = ['unfinishedOnly' => true];
        $pm_items = $this->repository->all($search, $config);

        return view('property-management.general')
            ->with('pm_items', $pm_items)
            ->with('search', $search);
    }

    public function create(Property $property)
    {
        $pm = $this->repository->blueprint();
        return view('property-management.create')
            ->with('pm', $pm)
            ->with('property', $property);
    }

    public function store(Request $request, Property $property)
    {
        if($this->canCreatePM($request, $property)) {
            $pm = $this->repository->create($request);
            $request->session()->flash('success', __('Record created successfully'));
            return redirect(route('property-management.edit', [$property->id, $pm->id]));
        } else {
            $request->session()->flash('error', __('You can only have one unfinished property management.'));
            return redirect()->back()->withInput();
        }
    }

    public function show(Property $property, PropertyManagement $pm)
    {
        $pm = $this->repository->find($pm);
        return view('property-management.show')
            ->with('pm', $pm)
            ->with('property', $property);
    }

    public function edit(Property $property, PropertyManagement $pm)
    {
        $pm = $this->repository->find($pm);

        return view('property-management.edit')
            ->with('pm', $pm)
            ->with('property', $property);
    }

    public function update(Request $request, Property $property, $id)
    {
        if($this->canCreatePM($request, $property, $id)){
            $this->repository->update($request, $id);
            $request->session()->flash('success', __('Record updated successfully'));
            return redirect( route('property-management.edit', [$property->id, $id]) );
        }else{
            $request->session()->flash('error', __('You can only have one unfinished property management.'));
            return redirect()->back()->withInput();
        }
    }

    public function destroy(Request $request, Property $property, $id)
    {
        if ( $this->repository->canDelete($id) ) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('property-management', [$property->id]));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }

    // ensures not creating new property management if an active one is enabled
    private function canCreatePM($request, $property, $id = false) {

        if( ! $request->is_finished ) {
            $pmQuery = PropertyManagement::where('property_id', $property->id)->where('is_finished', 0);
            if($id) {
                $pmQuery->where('id', '!=', $id);
            }
    
            $unfinishedPM = $pmQuery->first();
            if($unfinishedPM) {
                return false;
            }
        }

        return true;
    }

}
