<?php

namespace App\Http\Controllers;

class SettingsController extends Controller
{
    /**
     * Sets the active language for the user in the database
     */
    public function index() 
    {
        $menu = [
            [
                'label' => __('Cities'),
                'url'=> route('cities')
            ],
            [
                'label' => __('Zones'),
                'url' => route('zones')
            ],
            [
                'label' => __('Amenities'),
                'url' => route('amenities')
            ],
            [
                'label' => __('Transaction Types'),
                'url' => route('transaction-types')
            ],
            [
                'label' => __('Cleaning Options'),
                'url' => route('cleaning-options')
            ],
            [
                'label' => __('Damage Deposits'),
                'url' => route('damage-deposits')
            ],
        ];
        
        return view('settings.index')->with('menu', $menu);
    }
}
