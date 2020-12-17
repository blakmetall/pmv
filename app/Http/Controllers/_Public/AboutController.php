<?php

namespace App\Http\Controllers\_Public;

use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PropertyBooking;
use App\Repositories\PropertiesRepositoryInterface;

class AboutController extends Controller
{

    private $propertiesRepository;

    public function __construct(
        PropertiesRepositoryInterface $propertiesRepository
    ) {
        $this->propertiesRepository = $propertiesRepository;
    }

    public function index(Request $request)
    {
        return view('public.pages.about.index');
    }

    public function puertoVallarta(Request $request)
    {
        return view('public.pages.about.puerto-vallarta-history');
    }

    public function nuevoVallarta(Request $request)
    {
        return view('public.pages.about.nuevo-vallarta-history');
    }

    public function mazatlanVallarta(Request $request)
    {
        return view('public.pages.about.mazatlan-history');
    }

    public function testimonials(Request $request)
    {
        return view('public.pages.about.testimonials');
    }

    public function privacyPolicy(Request $request)
    {
        return view('public.pages.about.privacy-policy');
    }

    public function termsOfUse(Request $request)
    {
        return view('public.pages.about.terms-of-use');
    }

    public function realEstateBusinessDirectory(Request $request)
    {
        return view('public.pages.about.real-estate-business-directory');
    }

    public function lgbtBusinessDirectory(Request $request)
    {
        return view('public.pages.about.lgbt-business-directory');
    }
}
