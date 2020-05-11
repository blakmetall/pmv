<?php

namespace App\Http\Controllers;

use App\Repositories\{ PropertyContactsRepositoryInterface };
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyContactsController extends Controller
{
    private $repository;

    public function __construct(PropertyContactsRepositoryInterface $repository)
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
        $contacts = $this->repository->all($search, [], $property);

        return view('property-contacts.index')
            ->with('contacts', $contacts)
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
        $contacts = $this->repository->blueprint();
        return view('property-contacts.create')
            ->with('contacts', $contacts)
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
        $this->repository->create($request, $property);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('property-contacts', $property->id));
    }
}
