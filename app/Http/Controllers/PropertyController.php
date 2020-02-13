<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    public function index(){
        $properties = DB::table('properties')->get();

        return view('property.index',[
            'properties' => $properties
        ]);
    }
    //
}
