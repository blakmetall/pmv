<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AmenitiesRepositoryInterface;
use App\Models\Amenity;

class AmenitiesController extends Controller
{
    private $repository;

    public function __construct(AmenitiesRepositoryInterface $repository) 
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {   
        $search = trim($request->s);
        $amenities = $this->repository->all($search);
        
        return view('amenities.index')
            ->with('amenities', $amenities)
            ->with('search', $search);
    }

    public function create()
    {
        $amenity = $this->repository->blueprint();
        return view('amenities.create')->with('amenity', $amenity);
    }

    public function store(Request $request)
    {
        $amenity = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('amenities.edit', [$amenity->id]));
    }

    public function show(Amenity $amenity)
    {   
        $amenity = $this->repository->find($amenity);        
        return view('amenities.show')->with('amenity', $amenity);
    }

    public function edit(Amenity $amenity)
    {
        $amenity = $this->repository->find($amenity);
        return view('amenities.edit')->with('amenity', $amenity);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect(route('amenities.edit', [$id]));
    }

    public function destroy(Request $request, $id)
    {
        if ( $this->repository->canDelete($id) ) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('amenities'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}