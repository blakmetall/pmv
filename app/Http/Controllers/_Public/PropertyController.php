<?php

namespace App\Http\Controllers\_Public;

use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Repositories\PropertiesRepositoryInterface;

class PropertyController extends Controller
{

    private $propertiesRepository;

    public function __construct(
        PropertiesRepositoryInterface $propertiesRepository
    ) {
        $this->propertiesRepository = $propertiesRepository;
    }

    public function checkAvailability(Request $request)
    {
        $property = Property::find($request->booking_id);
        if (!$property) {
            $request->session()->flash('error', __('Not Records Found'));
            return redirect()->back();
        }
        return redirect(route('public.availability-results', [$property->id]));
    }

    public function availabilityResults(Request $request, Property $property)
    {
        $config2 = ['filterByNews' => true];

        $propertiesNews = $this->propertiesRepository->all('', $config2);
        return view('public.pages.properties.availability-results')
            ->with('propertiesNews', $propertiesNews);
    }

    public function propertyDetail(Request $request, Property $property)
    {
        $property = Property::where('', $request->booking_id);
        return view('public.pages.properties.property-detail')
            ->with('property', $property);
    }
}
