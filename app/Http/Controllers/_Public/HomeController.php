<?php

namespace App\Http\Controllers\_Public;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PropertiesRepositoryInterface;

class HomeController extends Controller
{

    private $propertiesRepository;

    public function __construct(
        PropertiesRepositoryInterface $propertiesRepository
    ) {
        $this->propertiesRepository = $propertiesRepository;
    }

    public function index(Request $request)
    {
        $config = ['filterByFeatured' => true];
        $config2 = ['filterByNews' => true];

        $propertiesFeatured = $this->propertiesRepository->all('', $config);
        $propertiesNews = $this->propertiesRepository->all('', $config2);
        return view('public.pages.home.index')
            ->with('propertiesFeatured', $propertiesFeatured)
            ->with('propertiesNews', $propertiesNews);
    }
}
