<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\RoleHelper;
use App\Repositories\RolesRepositoryInterface;

class RolesController extends Controller
{
    private $repository;

    public function __construct(RolesRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function index()
    {
        $roles = $this->repository->all();

        $rolesAllowedSections = [
            // accounting
            '8' => [
                __('Dashboard'),
                __('General Search'),
                __('Properties'),
                __('Bookings'),
                __('Bookings > General Availability'),
                __('Property Management > All'),
                __('Property Management > New Transaction'),
                __('Property Management > Transaction Bulk'),
                __('Property Management > Balances'),
                __('Property Management > Transactions'),
                __('Property Management > Pending Audits'),
                __('Cleanings > All'),
                __('Cleanings > Monthly Batch'),
                __('Human Resources > All'),
                __('Human Resources > Directory'),
                __('Site'),
                __('Settings > Damage Deposits'),
                __('Settings > Contacts'),
            ],
            // admin
            '2' => [
                __('Dashboard'),
                __('General Search'),
                __('Properties'),
                __('Bookings'),
                __('Bookings > General Availability'),
                __('Property Management > All'),
                __('Property Management > New Transaction'),
                __('Property Management > Transaction Bulk'),
                __('Property Management > Balances'),
                __('Property Management > Transactions'),
                __('Property Management > Pending Audits'),
                __('Cleanings > All'),
                __('Cleanings > Monthly Batch'),
                __('Human Resources > All'),
                __('Human Resources > Directory'),
                __('Site'),
                __('Settings > Users'),
                __('Settings > Workgroups'),
                __('Settings > Roles'),
                __('Settings > Cities'),
                __('Settings > Zones'),
                __('Settings > Buildings'),
                __('Settings > Amenities'),
                __('Settings > Transaction Types'),
                __('Settings > Cleaning Options'),
                __('Settings > Damage Deposits'),
                __('Settings > Contacts'),
            ],
            // administrative-assistant
            '9' => [
                __('Dashboard'),
                __('General Search'),
                __('Properties'),
                __('Bookings'),
                __('Bookings > General Availability'),
                __('Property Management > New Transaction'),
                __('Property Management > Transaction Bulk'),
                __('Property Management > Balances'),
                __('Property Management > Transactions'),
                __('Property Management > Pending Audits'),
                __('Cleanings > All'),
                __('Cleanings > Monthly Batch'),
                __('Human Resources > Directory'),
                __('Site'),
                __('Settings > Damage Deposits'),
                __('Settings > Contacts'),
            ],
            // concierge
            '10' => [
                __('Dashboard'),
                __('General Search'),
                __('Bookings'),
                __('Bookings > General Availability'),
                __('Cleanings > All'),
                __('Human Resources > All'),
                __('Human Resources > Directory'),
            ],
            // external rentals agent
            '5' => [
                __('Dashboard'),
                __('General Search'),
                __('Properties'),
                __('Bookings'),
                __('Bookings > General Availability'),
                __('Cleanings > All'),
                __('Human Resources > Directory'),
            ],
            // human resources
            '13' => [
                __('Human Resources > All'),
                __('Human Resources > Directory'),
            ],
            // operations assistant
            '7' => [
                __('Dashboard'),
                __('General Search'),
                __('Properties'),
                __('Bookings'),
                __('Bookings > General Availability'),
                __('Property Management > New Transaction'),
                __('Property Management > Transaction Bulk'),
                __('Property Management > Balances'),
                __('Property Management > Transactions'),
                __('Property Management > Pending Audits'),
                __('Cleanings > All'),
                __('Cleanings > Monthly Batch'),
                __('Human Resources > Directory'),
            ],
            // operations managers
            '6' => [
                __('Dashboard'),
                __('General Search'),
                __('Properties'),
                __('Property Management > New Transaction'),
                __('Property Management > Transaction Bulk'),
                __('Property Management > Balances'),
                __('Property Management > Transactions'),
                __('Property Management > Pending Audits'),
                __('Human Resources > Directory'),
            ],
            // property management
            '3' => [
                __('Dashboard'),
                __('General Search'),
                __('Properties'),
                __('Bookings'),
                __('Bookings > General Availability'),
                __('Property Management > New Transaction'),
                __('Property Management > Transaction Bulk'),
                __('Property Management > Balances'),
                __('Property Management > Transactions'),
                __('Property Management > Pending Audits'),
                __('Cleanings > All'),
                __('Cleanings > Monthly Batch'),
                __('Human Resources > Directory'),
            ],
            // rentals agent
            '4' => [
                __('Dashboard'),
                __('General Search'),
                __('Properties'),
                __('Bookings'),
                __('Bookings > General Availability'),
                __('Cleanings > All'),
                __('Human Resources > Directory'),
            ],
            // owner
            '11' => [
                __('Properties'),
                __('Property Management > Balances'),
                __('Bookings'),
                __('Cleanings > All'),
            ],
        ];

        return view('roles.index')
            ->with('roles', $roles)
            ->with('rolesAllowedSections', $rolesAllowedSections);
    }

    public function setActive($id) 
    { 
        RoleHelper::setActive($id);
        return redirect(route('dashboard'));
    }
}