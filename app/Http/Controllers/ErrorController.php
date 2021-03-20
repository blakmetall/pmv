<?php

namespace App\Http\Controllers;

class ErrorController extends Controller
{
    /**
     * Show forbidden page for permission denied
     */
    public function forbidden() 
    {
        return view('error.403-forbidden');
    }

    /**
     * Show not found page
     */
    public function notFound() 
    {
        return view('error.404-not-found');
    }
}
