<?php

namespace App\Http\Controllers\_Public;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function __construct()
    {
    }

    public function home(Request $request)
    {
        return view('public.pages.home');
    }
}
