<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class Profile extends Model {

    use AppModel;
    
    protected $table = 'profiles';
    public $timestamps = true;
    protected $fillable = [
        'firstname',
        'lastname',
        'country',
        'state',
        'city',
        'street',
        'zip',
        'phone',
        'mobile',
        'config_language',
        'config_agent_commission',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public static $saveValidation = [
        'firstname' => 'required',
        'lastname'  => 'required',
        'country'   => 'required',
        'state'     => 'required',
        'city'      => 'required',
        'street'    => 'required',
        'zip'       => 'required',
        'phone'     => 'required',
        'mobile'    => 'required',
    ];

    public static $updateValidation = [
        'firstname' => 'required',
        'lastname'  => 'required',
        'country'   => 'required',
        'state'     => 'required',
        'city'      => 'required',
        'street'    => 'required',
        'zip'       => 'required',
        'phone'     => 'required',
        'mobile'    => 'required',
    ];
}
