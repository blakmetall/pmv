<?php

namespace App\Http\Controllers;

use App\Repositories\{PropertyCalendarRepositoryInterface};
use Illuminate\Http\Request;
use App\Models\{Property, PropertyNote};

class PropertyCalendarController extends Controller
{
    private $repository;

    public function __construct(PropertyCalendarRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request, Property $property)
    {
        $search = trim($request->s);

        $config = [];

        if (isRole('owner') || isRole('contact')) {
            $config = ['auditedOnly' => true];
        }

        $notes = $this->repository->all($search, $config);

        return view('property-notes.index')
            ->with('notes', $notes)
            ->with('property', $property)
            ->with('search', $search);
    }
}
