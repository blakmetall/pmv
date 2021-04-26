<?php

namespace App\Http\Controllers;

use App\Helpers\RoleHelper;

class SettingsController extends Controller
{
    public function index() 
    {
        $_current_role = RoleHelper::current();

        $menu = [];

        if ($_current_role->isAllowed('settings', 'users')) {
            $menu[] = ['label' => __('Users'), 'url'=> route('users')];
        }

        if ($_current_role->isAllowed('settings', 'workgroups')) {
            $menu[] = ['label' => __('Workgroups'), 'url'=> route('workgroups')];
        }

        if ($_current_role->isAllowed('settings', 'roles')) {
            $menu[] = ['label' => __('Roles'), 'url'=> route('roles')];
        }

        if ($_current_role->isAllowed('settings', 'cities')) {
            $menu[] = ['label' => __('Cities'), 'url'=> route('cities')];
        }

        if ($_current_role->isAllowed('settings', 'offices')) {
            $menu[] = ['label' => __('Offices'), 'url'=> route('offices')];
        }

        if ($_current_role->isAllowed('settings', 'zones')) {
            $menu[] = ['label' => __('Zones'), 'url'=> route('zones')];
        }

        if ($_current_role->isAllowed('settings', 'buildings')) {
            $menu[] = ['label' => __('Buildings'), 'url'=> route('buildings')];
        }

        if ($_current_role->isAllowed('settings', 'contacts')) {
            $menu[] = ['label' => __('Contacts'), 'url'=> route('contacts')];
        }

        if ($_current_role->isAllowed('settings', 'amenities')) {
            $menu[] = ['label' => __('Amenities'), 'url'=> route('amenities')];
        }

        if ($_current_role->isAllowed('settings', 'transaction-types')) {
            $menu[] = ['label' => __('Transaction Types'), 'url'=> route('transaction-types')];
        }

        if ($_current_role->isAllowed('settings', 'cleaning-options')) {
            $menu[] = ['label' => __('Cleaning Options'), 'url'=> route('cleaning-options')];
        }

        if ($_current_role->isAllowed('settings', 'damage-deposits')) {
            $menu[] = ['label' => __('Damage Deposits'), 'url'=> route('damage-deposits')];
        }
        
        return view('settings.index')->with('menu', $menu);
    }
}
