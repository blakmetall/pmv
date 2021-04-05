<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\RoleHelper;
use App\Repositories\RolesSectionsPermissionsRepositoryInterface;
use App\Repositories\RolesRepositoryInterface;
use App\Models\Role;
use App\Models\RoleSectionPermission;
use Auth;

class RolesSectionsPermissionsController extends Controller
{
    private $repository;
    private $rolesRepository;

    public function __construct(
        RolesSectionsPermissionsRepositoryInterface $repository,
        RolesRepositoryInterface $rolesRepository
    ) {
        $this->repository = $repository;
        $this->rolesRepository = $rolesRepository;
    }

    public function index(Role $role)
    {        
        $user_id = Auth::id();
        $userSectionPermissions = RoleSectionPermission::where('user_id', $user_id)->get();

        return view('roles.sections-permissions.index')
            ->with('role', $role)
            ->with('userSectionPermissions', $userSectionPermissions)
            ->with('sections', $this->get_sections());
    }

    // saves the sections allowed according to a specific role
    public function save(Request $request)
    {
        $role_id = $request->role_id;
        $allowedSections = $request->all();
        unset($allowedSections['_token']);
        unset($allowedSections['role_id']);

        // all allowable sections
        $allowableSections = $this->get_sections();

        // save allowed sections
        if(count($allowedSections)) {
            foreach($allowedSections as $sectionAllowed => $value) {
                $restrictionFound = RoleSectionPermission::
                    where('role_id', $role_id)
                    ->where('section_slug', $sectionAllowed)
                    ->where('user_id', null);

                if($restrictionFound) {
                    unset($allowableSections[$sectionAllowed]);
                    $roleSectionPermission = new RoleSectionPermission;
                    $roleSectionPermission->role_id = $role_id;
                    $roleSectionPermission->section_slug = $sectionAllowed;
                    $roleSectionPermission->user_id = null;
                    $roleSectionPermission->save();
                }
            }
        }

        $nowAllowableSections = $allowableSections;

        foreach($nowAllowableSections as $notAllowableSection => $name) {
            RoleSectionPermission::
                where('section_slug', $notAllowableSection)
                ->where('user_id', null)
                ->delete();
        }

        return back();
    }

    private function get_sections() {
        $sections = [
            "properties-all" => "Properties > All ",
            "properties-offline" => "Properties > Offline",
            "properties-new-listing" => "Properties > New Listing",
            "properties-disabled" => "Properties > Disabled",
            "property-management-all" => "Property Managment > All",
            "property-management-new-transaction" => "Property Management > New Transaction",
            "property-management-transaction-bulk" => "Property Management > Transaction Bulk",
            "property-management-balances" => "Property Management > Balances",
            "property-management-pending-audits-mazatlan" => "Property Management > Pending Audits Mazatlan",
            "property-management-pending-audits-pv" => "Property Management > Pending Audits Puerto Vallarta",
            "reservations-all" => "Reservations > All",
            "reservations-new" => "Reservations > New",
            "reservations-arrivals-and-departures" => "Reservations > Arrivals & Departures",
            "reservations-agents" => "Reservations > Agents",
            "reservations-general-availability" => "Reservations > Disponibilidad General",
            "cleaning-services-all" => "Cleaning Services > All",
            "cleaning-services-monthly-batch" => "Cleaning Services > Monthly Batch",
            "human-resources-all" => "Human Resources > All",
            "human-resources-directory" => "Human Resources > Directory",
            "reporting" => "Reporting",
            "public-pages" => "Public > Pages",
            "public-payment-methods" => "Public > Payment Methods",
            "public-testimonials" => "Public > Testimonials",
            "public-agencies" => "Public > Agencies",
            "public-lgbt" => "Public > LGBT",
            "settings-users" => "Settings > Users",
            "settings-workgroups" => "Settings > Workgroups",
            "settings-roles" => "Settings > Roles",
            "settings-cities" => "Settings > Cities",
            "settings-offices" => "Setting > Offices",
            "settings-zones" => "Settings > Zones",
            "settings-buildings" => "Settings > Buildings",
            "settings-contacts" => "Settings > Contacts",
            "settings-amenities" => "Settings > Amenities",
            "settings-transaction-types" => "Settings > Transaction Types",
            "settings-cleaning-options" => "Settings > Cleaning Options",
            "settings-damage-deposits" => "Settings > Damage Deposits",
        ];

        return $sections;
    }
}