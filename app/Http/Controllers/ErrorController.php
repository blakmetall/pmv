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
     * Show forbidden page for permission denied
     */
    public function notFound() 
    {
        return view('error.404-not-found');
    }
}
