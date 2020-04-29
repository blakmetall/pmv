<?php

namespace App\Http\Controllers;

use App\Repositories\{ PropertyNotesRepositoryInterface };
use Illuminate\Http\Request;
use App\Models\{ Property, PropertyNote };

class PropertyNotesController extends Controller
{
    private $repository;

    public function __construct(PropertyNotesRepositoryInterface $repository)
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
        $notes = $this->repository->all($search);

        return view('property-notes.index')
            ->with('notes', $notes)
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
        $note = $this->repository->blueprint();
        return view('property-notes.create')
            ->with('note', $note)
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
        $note = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('property-notes.edit', [$property->id, $note->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property, PropertyNote $note)
    {
        $note = $this->repository->find($note);

        return view('property-notes.show')
            ->with('note', $note)
            ->with('property', $property);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property, PropertyNote $note)
    {
        $note = $this->repository->find($note);

        return view('property-notes.edit')
            ->with('note', $note)
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
        return redirect( route('property-notes.edit', [$property->id, $id]) );
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
            return redirect(route('property-notes', [$property->id]));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}
