<?php

namespace App\Http\Controllers\_Public;

use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PropertyBooking;
use App\Repositories\PropertiesRepositoryInterface;

class ConciergeServicesController extends Controller
{

    private $propertiesRepository;

    public function __construct(
        PropertiesRepositoryInterface $propertiesRepository
    ) {
        $this->propertiesRepository = $propertiesRepository;
    }

    public function index(Request $request)
    {
        return view('public.pages.concierge-services.index');
    }

    public function helpfulInformation()
    {
        return view('public.pages.concierge-services.helpful-information');
    }
}
