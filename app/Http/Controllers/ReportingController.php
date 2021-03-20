<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportingController extends Controller
{

    public function __construct() {}

    public function index(Request $request)
    {
        $search = trim($request->s);
        return view('reporting.index')->with('search', $search);
    }

}
