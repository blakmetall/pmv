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

        PropertyManagement::setFinishedStatusHandler();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Property $property)
    {
        $search = trim($request->s);

        $config = ['propertyID' => $property->id];
        $pm_items = $this->repository->all($search, $config);

        return view('property-management.index')
            ->with('pm_items', $pm_items)
            ->with('property', $property)
            ->with('search', $search);
    }

    public function general(Request $request)
    {
        $search = trim($request->s);
        $pm_items = $this->repository->all($search);

        return view('property-management.general')
            ->with('pm_items', $pm_items)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Property $property)
    {
        $pm = $this->repository->blueprint();
        return view('property-management.create')
            ->with('pm', $pm)
            ->with('property', $property);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Property $property)
    {
        $pm = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('property-management.edit', [$property->id, $pm->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property, PropertyManagement $pm)
    {
        $pm = $this->repository->find($pm);
        return view('property-management.show')
            ->with('pm', $pm)
            ->with('property', $property);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property, PropertyManagement $pm)
    {
        $pm = $this->repository->find($pm);

        return view('property-management.edit')
            ->with('pm', $pm)
            ->with('property', $property);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect( route('property-management.edit', [$property->id, $id]) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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


    private function checkStatus($request, $property, $id = false){

        $pm = false;

        if($request->end_date > getCurrentDate()){
            $pm = PropertyManagement::where('property_id', $property->id)->where('is_finished', 0)->where('id', '!=', $id)->first();
        }

        return $pm;
    }
}
