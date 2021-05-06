<?php

namespace App\Models;

use App\Traits\AppModel;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use AppModel;

    protected $table = 'properties';
    public $timestamps = true;
    protected $fillable = [
        'state_id',
        'city_id',
        'zone_id',
        'building_id',
        'unit',
        'office_id',
        'property_type_id',
        'cleaning_option_id',
        'is_featured',
        'is_enabled',
        'is_online',
        'is_special',
        'pet_friendly',
        'adults_only',
        'beachfront',
        'rental_commission',
        'maid_fee',
        'cleaning_staff_ids',
        'bedrooms',
        'bedding_JSON',
        'baths',
        'floors',
        'pax',
        'has_parking',
        'lot_size_sqft',
        'construction_size_sqft',
        'phone',
        'country',
        'state',
        'city',
        'street',
        'exterior_number',
        'interior_number',
        'zip',
        'address',
        'gmaps_lat',
        'gmaps_lon',
        'cleaning_sunday_bonus',
    ];

    protected $casts = [
        'cleaning_staff_ids' => 'array',
        'bedding' => 'array',
    ];

    public $en;
    public $es;

    public function languages()
    {
        return $this->belongsToMany('App\Models\Language', 'properties_translations')
            ->withPivot('name', 'description', 'cancellation_policies');
    }

    public function translations()
    {
        return $this->hasMany('App\Models\PropertyTranslation');
    }

    public function images()
    {
        return $this->hasMany('App\Models\PropertyImage');
    }

    public function rates()
    {
        return $this->hasMany('App\Models\PropertyRate');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'properties_has_users');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\PropertyType', 'property_type_id');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function office()
    {
        return $this->belongsTo('App\Models\Office');
    }

    public function zone()
    {
        return $this->belongsTo('App\Models\Zone');
    }

    public function building()
    {
        return $this->belongsTo('App\Models\Building');
    }

    public function amenities()
    {
        return $this->belongsToMany('App\Models\Amenity', 'properties_has_amenities');
    }

    public function cleaningOption()
    {
        return $this->belongsTo('App\Models\CleaningOption', 'cleaning_option_id');
    }

    public function management()
    {
        return $this->hasMany('App\Models\PropertyManagement');
    }

    public function notes()
    {
        return $this->hasMany('App\Models\PropertyNote');
    }

    public function cleaningServices()
    {
        return $this->hasMany('App\Models\CleaningService', 'property_id');
    }

    public function monthlyCleaningServices($month = '', $year = '')
    {
        return $this->cleaningServices()
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date', 'asc')
            ->get();
    }

    public function contacts()
    {
        return $this->belongsToMany('App\Models\Contact', 'properties_has_contacts');
    }

    public function bookings()
    {
        return $this->hasMany('App\Models\PropertyBooking');
    }

    public function reservationRequests()
    {
        return $this->hasMany('App\Models\ReservationRequest');
    }

    public function hasDefaultImage()
    {
        return $this->images()->orderBy('order', 'asc')->count();
    }

    public function getDefaultImage()
    {
        return $this->images()->orderBy('order', 'asc')->first();
    }

    public function getActivePM()
    {
        return $this->management()->whereNotNull('is_finished')->first();
    }
}
