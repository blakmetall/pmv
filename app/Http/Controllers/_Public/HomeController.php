<?php

namespace App\Http\Controllers\_Public;

use App\Http\Controllers\Controller;
use App\Repositories\PagesRepositoryInterface;
use App\Repositories\PropertiesRepositoryInterface;
use App\Repositories\TestimonialsRepositoryInterface;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class HomeController extends Controller
{
    private $propertiesRepository;
    private $testimoniaslRepository;
    private $pagesPepository;

    public function __construct(
        PropertiesRepositoryInterface $propertiesRepository,
        TestimonialsRepositoryInterface $testimoniaslRepository,
        PagesRepositoryInterface $pagesPepository
    ) {
        $this->propertiesRepository = $propertiesRepository;
        $this->testimoniaslRepository = $testimoniaslRepository;
        $this->pagesPepository = $pagesPepository;
    }

    public function init(Request $request)
    {
        return redirect('/' . \App::getLocale());
    }

    public function default(Request $request)
    {
        $config = ['filterByFeatured' => true, 'paginate' => false, 'filterOnline' => true, 'filterByEnabled' => true];
        $config2 = ['filterByNews' => true, 'filterOnline' => true, 'filterByEnabled' => true];
        $config3 = ['randomize' => true];

        $propertiesFeatured = $this->propertiesRepository->all('', $config);
        $propertiesNews = $this->propertiesRepository->all('', $config2);
        $testimonials = $this->testimoniaslRepository->all('', $config3);

        $vsPage = $this->pagesPepository->find(getPage('vacation-services'));
        $pmPage = $this->pagesPepository->find(getPage('property-management'));
        $csPage = $this->pagesPepository->find(getPage('concierge-services'));

        SEOTools::setTitle(__('Welcome to Palmera Vacations'));
        SEOTools::setDescription(getSubstring(removeP($vsPage->translate()->description), 120));
        SEOTools::opengraph()->setUrl(url()->full());

        return view('public.pages.home.default')
            ->with('propertiesFeatured', $propertiesFeatured)
            ->with('propertiesNews', $propertiesNews)
            ->with('testimonials', $testimonials)
            ->with('vsPage', $vsPage)
            ->with('pmPage', $pmPage)
            ->with('csPage', $csPage);
    }
}
