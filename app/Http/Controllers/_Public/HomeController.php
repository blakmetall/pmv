<?php

namespace App\Http\Controllers\_Public;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PropertiesRepositoryInterface;
use App\Repositories\TestimonialsRepositoryInterface;
use App\Repositories\PagesRepositoryInterface;

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

    public function index(Request $request)
    {
        $config = ['filterByFeatured' => true];
        $config2 = ['filterByNews' => true];

        $propertiesFeatured = $this->propertiesRepository->all('', $config);
        $propertiesNews = $this->propertiesRepository->all('', $config2);
        $testimonials = $this->testimoniaslRepository->all('', '');

        $vsPage = $this->pagesPepository->find(getPage('vacation-services'));
        $pmPage = $this->pagesPepository->find(getPage('property-management'));
        $csPage = $this->pagesPepository->find(getPage('concierge-services'));

        return view('public.pages.home.index')
            ->with('propertiesFeatured', $propertiesFeatured)
            ->with('propertiesNews', $propertiesNews)
            ->with('testimonials', $testimonials)
            ->with('vsPage', $vsPage)
            ->with('pmPage', $pmPage)
            ->with('csPage', $csPage);
    }
}
