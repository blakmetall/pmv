<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Repositories\AmenitiesRepositoryInterface;
use App\Models\{ Amenity, AmenityTranslation };

class AmenitiesController extends Controller
{
    private $repository;

    public function __construct(AmenitiesRepositoryInterface $repository) 
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $search = trim($request->s);
        $amenities = $this->repository->all($search);
        
        return view('amenities.index')
            ->with('amenities', $amenities)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $amenity = $this->repository->blueprint();
        return view('amenities.create')->with('amenity', $amenity);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $amenity = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('amenities.edit', [$amenity->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Amenity $amenity)
    {   
        $amenity = $this->repository->find($amenity);        
        return view('amenities.show')->with('amenity', $amenity);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Amenity $amenity)
    {
        $amenity = $this->repository->find($amenity);
        return view('amenities.edit')->with('amenity', $amenity);
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
        return redirect(route('amenities.edit', [$id]));
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
            $request->session()->flash('success', __('Record deleted'));
            return redirect(route('amenities'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}