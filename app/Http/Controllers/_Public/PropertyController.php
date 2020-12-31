<?php

namespace App\Http\Controllers\_Public;

use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PropertyTranslation;
use App\Repositories\PropertiesRepositoryInterface;
use App\Repositories\ZonesRepositoryInterface;
use Carbon\Carbon;

class PropertyController extends Controller
{

    private $propertiesRepository;
    private $zonesRepository;

    public function __construct(
        PropertiesRepositoryInterface $propertiesRepository,
        ZonesRepositoryInterface $zonesRepository
    ) {
        $this->propertiesRepository = $propertiesRepository;
        $this->zonesRepository = $zonesRepository;
    }

    public function availabilityResults(Request $request)
    {
        $lang = LanguageHelper::current();
        $query = PropertyTranslation::query();
        $pax = $request->adults + $request->children;
        $search = [
            'type' => ($request->property_type)?$request->property_type:false,
            'city' => ($request->city)?$request->city:false,
            'zone' => ($request->zone)?$request->zone:false,
            'arrival' => $request->arrival,
            'departure' => $request->departure,
            'pax' => $pax,
            'bedrooms' => ($request->bedrooms)?$request->bedrooms:0,
        ];
        $query->where(function ($query) use ($lang, $search) {
            $query->whereHas('property', function ($query) use ($search) {
                if($search['type']){
                    $query->where('property_type_id', $search['type']);
                }
                if($search['city']){
                    $query->where('city_id', $search['city']);
                }
                if($search['zone']){
                    $query->where('zone_id', $search['zone']);
                }
                $query->where('bedrooms', '>=', $search['bedrooms']);
                $query->where('pax', '>=', $search['pax']);
            })->where('language_id', $lang->id);
        });
        $properties = $query->paginate(3);
        foreach($properties as $index => $property){
            if($property->property->bookings){
                foreach($property->property->bookings as $booking){
                    $startDate = Carbon::createFromFormat('Y-m-d', $booking->arrival_date);
                    $endDate = Carbon::createFromFormat('Y-m-d', $booking->departure_date);
                    $checkArrival = $startDate->between($search['arrival'], $search['departure']);
                    $checkDeparture = $endDate->between($search['arrival'], $search['departure']);
                    if($checkArrival || $checkDeparture){
                        unset($properties[$index]);
                    }
                }
            }
        }
        if (!$properties) {
            $request->session()->flash('error', __('Not Records Found'));
            return redirect()->back();
        }
        $config = ['filterByNews' => true];

        $propertiesNews = $this->propertiesRepository->all('', $config);
        return view('public.pages.properties.availability-results')
            ->with('properties', $properties)
            ->with('propertiesNews', $propertiesNews);
    }


    public function propertyDetail(Property $property)
    {
        return view('public.pages.properties.property-detail')
            ->with('property', $property);
    }

    public function zones($city)
    {
        $zones = $this->zonesRepository->all('', [], $city);

        return $zones;
    }
}
