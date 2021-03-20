<?php

namespace App\Http\Controllers;

class SettingsController extends Controller
{
    public function index() 
    {
        $menu = [
            [
                'label' => __('Users'),
                'url'=> route('users')
            ],
            [
                'label' => __('Workgroups'),
                'url'=> route('workgroups')
            ],
            [
                'label' => __('Roles'),
                'url'=> route('roles')
            ],
            [
                'label' => __('Cities'),
                'url'=> route('cities')
            ],
            [
                'label' => __('Zones'),
                'url' => route('zones')
            ],
            [
                'label' => __('Contacts'),
                'url'=> route('contacts')
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
