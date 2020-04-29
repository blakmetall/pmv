<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class Property extends Model {

    use AppModel;

    protected $table = 'properties';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'city_id',
        'zone_id',
        'property_type_id',
        'cleaning_option_id',
        'is_featured',
        'is_enabled',
        'is_online',
        'building',
        'rental_commission',
        'maid_fee',
        'bedrooms',
        'bedding_JSON',
        'baths',
        'sleeps',
        'floors',
        'has_parking',
        'lot_size_sqft',
        'construction_size_sqft',
        'phone',
        'address'
    ];

    public $en;
    public $es;

    public function languages() {
        return $this->belongsToMany('App\Models\Language', 'properties_translations')
            ->withPivot('name', 'description', 'cancellation_policies');
    }

    public function translations() {
        return $this->hasMany('App\Models\PropertyTranslation');
    }

    public function images() {
        return $this->hasMany('App\Models\PropertyImage');
    }

    public function rates() {
        return $this->hasMany('App\Models\PropertyRate');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function type() {
        return $this->hasOne('App\Models\PropertyType', 'id');
    }

    public function city() {
        return $this->belongsTo('App\Models\City');
    }

    public function zone() {
        return $this->belongsTo('App\Models\Zone');
    }

    public function amenities(){
        return $this->belongsToMany('App\Models\Amenity', 'properties_has_amenities');
    }

    public function cleaningOption() {
        return $this->hasOne('App\Models\CleaningOption' , 'id');
    }

    public function contacts() {
        return $this->hasMany('App\Models\PropertyContact');
    }

    public function management() {
        return $this->hasMany('App\Models\PropertyManagement');
    }

    public function notes() {
        return $this->hasMany('App\Models\PropertyNote');
    }

    public function cleaningServices() {
        return $this->hasMany('App\Models\CleaningService');
    }
}