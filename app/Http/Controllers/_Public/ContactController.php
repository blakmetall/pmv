<?php

namespace App\Http\Controllers\_Public;

use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Repositories\PagesRepositoryInterface;

class ContactController extends Controller
{

    private $repository;

    public function __construct(
        PagesRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $id = getPage('contact');
        $page = $this->repository->find($id);
        $offices = getOffices();
        return view('public.pages.contact.index')
            ->with('page', $page)
            ->with('offices', $offices);
        
    }
}
