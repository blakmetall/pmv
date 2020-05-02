<?php

namespace App\Http\Controllers;

use App\Repositories\{ PropertyRatesRepositoryInterface };
use Illuminate\Http\Request;
use App\Models\{ Property, PropertyRate };

class PropertyRatesController extends Controller
{
    private $repository;

    public function __construct(PropertyRatesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Property $property)
    {
        $search = trim($request->s);
        $rates = $this->repository->all($search);

        return view('property-rates.index')
            ->with('rates', $rates)
            ->with('property', $property)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Property $property)
    {
        $rate = $this->repository->blueprint();
        return view('property-rates.create')
            ->with('rate', $rate)
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
        $rate = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('property-rates.edit', [$property->id, $rate->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property, PropertyRate $rate)
    {
        $rate = $this->repository->find($rate);

        return view('property-rates.show')
            ->with('rate', $rate)
            ->with('property', $property);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property, PropertyRate $rate)
    {
        $rate = $this->repository->find($rate);

        return view('property-rates.edit')
            ->with('rate', $rate)
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
        return redirect( route('property-rates.edit', [$property->id, $id]) );
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
            return redirect(route('property-rates', [$property->id]));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}
