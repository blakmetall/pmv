<?php

namespace App\Http\Controllers;

use App\Models\PropertyType;
use App\Models\PropertyTypeTranslation;
use Illuminate\Http\Request;

class PropertyTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $property_types = PropertyTypeTranslation::paginate(5)->onEachSide(5);
        return view('property-types.index')->with('property_types', $property_types);
    }
}
