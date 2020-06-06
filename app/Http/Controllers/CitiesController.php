<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CitiesRepositoryInterface;
use App\Models\{ City, State };

class CitiesController extends Controller
{  
    private $repository; 
    
    public function __construct(CitiesRepositoryInterface $repository) 
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);
        $cities = $this->repository->all($search);
        
        return view('cities.index')
            ->with('cities', $cities)
            ->with('search', $search);
    }

    public function create()
    {
        $city = $this->repository->blueprint();
        $states = State::orderBy('name', 'asc')->get();

        return view('cities.create')
            ->with('city', $city)
            ->with('states', $states);
    }

    public function store(Request $request)
    {
        $city = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('cities.edit', [$city->id]));
    }

    public function show(City $city)
    {
        $city = $this->repository->find($city);        
        $states = State::orderBy('name', 'asc')->get();

        return view('cities.show')
            ->with('city', $city)
            ->with('states', $states);
    }

    public function edit(City $city)
    {
        $city = $this->repository->find($city);
        $states = State::orderBy('name', 'asc')->get();

        return view('cities.edit')
            ->with('city', $city)
            ->with('states', $states);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect(route('cities.edit', [$id]));
    }

    public function destroy(Request $request, $id)
    {
        if ( $this->repository->canDelete($id) ) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('cities'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}