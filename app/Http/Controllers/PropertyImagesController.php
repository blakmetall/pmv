<?php

namespace App\Http\Controllers;

use App\Repositories\{ PropertyImagesRepositoryInterface };
use Illuminate\Http\Request;
use App\Models\{ Property, PropertyImage };

class PropertyImagesController extends Controller
{
    private $repository;

    public function __construct(PropertyImagesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request, Property $property)
    {
        $images = $this->repository->all();

        return view('property-images.index')
            ->with('images', $images)
            ->with('property', $property);
    }

    public function create(Property $property)
    {
        $image = $this->repository->blueprint();
        return view('property-images.create')
            ->with('image', $image)
            ->with('property', $property);
    }

    public function store(Request $request, Property $property)
    {
        $image = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('property-images', [$property->id]));
    }

    public function show(Property $property, PropertyImage $image)
    {
        $image = $this->repository->find($image);

        return view('property-images.show')
            ->with('image', $image)
            ->with('property', $property);
    }

    public function edit(Property $property, PropertyImage $image)
    {
        $image = $this->repository->find($image);

        return view('property-images.edit')
            ->with('image', $image)
            ->with('property', $property);
    }

    public function update(Request $request, Property $property, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect( route('property-images.edit', [$property->id, $id]) );
    }

    public function destroy(Request $request, Property $property, $id)
    {
        if ( $this->repository->canDelete($id) ) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('property-images', [$property->id]));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}
