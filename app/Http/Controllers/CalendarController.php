<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $search = trim($request->s);
        return view('calendar.index')->with('search', $search);
    }
}
