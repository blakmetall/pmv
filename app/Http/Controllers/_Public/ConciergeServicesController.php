<?php

namespace App\Http\Controllers\_Public;

use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Repositories\PagesRepositoryInterface;
use Artesaos\SEOTools\Facades\SEOTools;

class ConciergeServicesController extends Controller
{

    private $repository;

    public function __construct(
        PagesRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $id = getPage('concierge-services');
        $page = $this->repository->find($id);

        SEOTools::setTitle($page->translate()->title);
        SEOTools::setDescription(getSubstring(removeP($page->translate()->description), 120));
        SEOTools::opengraph()->setUrl(url()->full());

        return view('public.pages.concierge-services.index')->with('page', $page);
    }

    public function helpfulInformation()
    {
        $id = getPage('helpful-information');
        $page = $this->repository->find($id);

        SEOTools::setTitle($page->translate()->title);
        SEOTools::setDescription(getSubstring(removeP($page->translate()->description), 120));
        SEOTools::opengraph()->setUrl(url()->full());
        
        return view('public.pages.concierge-services.helpful-information')->with('page', $page);
    }
}
