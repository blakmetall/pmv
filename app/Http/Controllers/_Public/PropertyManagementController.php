<?php

namespace App\Http\Controllers\_Public;

use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Repositories\PagesRepositoryInterface;

class PropertyManagementController extends Controller
{

    private $repository;

    public function __construct(
        PagesRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $id = getPage('property-management');
        $page = $this->repository->find($id);
        
        return view('public.pages.property-management.index')->with('page', $page);
    }

}