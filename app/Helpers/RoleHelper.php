<?php

namespace App\Helpers;

use App\Models\Role;
use App\Models\User;
use Config;

class RoleHelper
{
    /**
     * Get the current user role configured in profile.
     *
     * @return Illuminate\Database\Eloquent\Model object or false
     */
    public static function current()
    {
        $config_role_id = null;

        $user = auth()->user();
        if ($user && $user->profile) {
            $config_role_id = $user->profile->config_role_id;
        }

        return Role::where('id', $config_role_id)->first();
    }

    /**
     * Sets the active role base on role_id.
     */
    public static function setActive($id)
    {
        if (self::hasValidRoleId($id)) {
            $profile = auth()->user()->profile;
            $profile->config_role_id = $id;
            $profile->save();
        }
    }

    /**
     * Get the user roles available.
     *
     * @return array of Illuminate\Database\Eloquent\Model of type RoleTranslation
     */
    public static function available($user_id = false)
    {
        $roles = [];

        $lang = LanguageHelper::current();

        if ($user_id) {
            $user = User::find($user_id);
        } else {
            $user = auth()->user();
        }

        if ($user && $user->roles()->count()) {
            $roles = [];

            foreach ($user->roles as $role) {
                $roleItem = $role->translations()->where('language_id', $lang->id)->first();
                $roles[$roleItem->name] = $roleItem;
            }
            
            ksort($roles);
        }

        return $roles;
    }

    public static function is($roleSlug)
    {
        $compareRoleId = config('constants.roles.' . $roleSlug);

        $current = self::current();

        return $current->id === $compareRoleId;
    }

    public static function hasValidRoleId($id)
    {
        $allowed_roles = self::available();

        if (count($allowed_roles)) {
            foreach ($allowed_roles as $role) {
                if ($role->role_id == $id) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Checks if role is allowed for a speficic section, subsection and section listing.
     *
     * @return bool
     */
    public static function isAllowed($role_id, $section, $sub, $sections)
    {
        if (isset($sections[$section]) && isset($sections[$section][$sub])) {
            if (in_array($role_id, $sections[$section][$sub])) {
                return true;
            }
        }

        return false;
    }

    public static function can($action = 'view',  $sectionSlug) {
        $currentRole = self::current();

        $can = false;
        
        switch($sectionSlug){
            // properties
            case 'properties':
                if($action == 'view') {
                    $view_properties = [8,2,9,14,10,13,7,6,3,5,1];
                    $can = in_array($currentRole->id, $view_properties);
                }
                
                if($action == 'edit') {
                    $edit_properties = [8,2,6,5,1];
                    $can = in_array($currentRole->id, $edit_properties);
                }
                break;

            // property-images
            case 'property-images':
                if($action == 'view') {
                    $view_properties = [8,2,9,14,10,13,7,6,3,5,1];
                    $can = in_array($currentRole->id, $view_properties);
                }
                
                if($action == 'edit') {
                    $edit_properties = [8,2,6,5,1];
                    $can = in_array($currentRole->id, $edit_properties);
                }
                break;
            
            // property-bookings
            case 'property-bookings':
                if($action == 'view') {
                    $view_properties = [8,2,9,14,10,13,7,6,3,5,1];
                    $can = in_array($currentRole->id, $view_properties);
                }
                
                if($action == 'edit') {
                    $edit_properties = [8,2,6,5,1];
                    $can = in_array($currentRole->id, $edit_properties);
                }
                break;

            // property-rates
            case 'property-rates':
                if($action == 'view') {
                    $view_properties = [8,2,9,14,10,13,7,6,3,5,1];
                    $can = in_array($currentRole->id, $view_properties);
                }
                
                if($action == 'edit') {
                    $edit_properties = [8,2,6,5,1];
                    $can = in_array($currentRole->id, $edit_properties);
                }
                break;

            // property-contacts
            case 'property-contacts':
                if($action == 'view') {
                    $view_properties = [8,2,9,14,10,13,7,6,3,5,1];
                    $can = in_array($currentRole->id, $view_properties);
                }
                
                if($action == 'edit') {
                    $edit_properties = [8,2,6,5,1];
                    $can = in_array($currentRole->id, $edit_properties);
                }
                break;

            // property notes
            case 'property-notes':
                if($action == 'view') {
                    $view_notes = [8,2,9,14,10,7,6,3,5,1];
                    $can = in_array($currentRole->id, $view_notes);
                }
                
                if($action == 'edit') {
                    $edit_notes = [8,2,9,14,10,7,6,3,5,1];
                    $can = in_array($currentRole->id, $edit_notes);
                }
                break;

            // property-calendar
            case 'property-calendar':
                if($action == 'view') {
                    $view_properties = [8,2,9,14,10,13,7,6,3,5,1];
                    $can = in_array($currentRole->id, $view_properties);
                }
                
                if($action == 'edit') {
                    $edit_properties = [8,2,6,5,1];
                    $can = in_array($currentRole->id, $edit_properties);
                }
                break;

            // property-preview
            case 'property-preview':
                if($action == 'view') {
                    $view_properties = [8,2,9,14,10,13,7,6,3,5,1];
                    $can = in_array($currentRole->id, $view_properties);
                }
                
                if($action == 'edit') {
                    $edit_properties = [8,2,6,5,1];
                    $can = in_array($currentRole->id, $edit_properties);
                }
                break;

            // property-management
            case 'property-management':
                if($action == 'edit') {
                    $edit_properties = [8,2,9,6,1];
                    $can = in_array($currentRole->id, $edit_properties);
                }
                break;
        }

        return $can;
    }

    /**
     * @return array List of url sections with their subsections
     *               and their allowed roles ids per section
     */
    public static function getAllowedSections()
    {
        $sections = [
            'dashboard' => [
                'heading-menu' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'operations-manager',
                    'operations-assistant',
                    'cleanings',
                    'accounting',
                    'administrative-assistant',
                ]),
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'operations-manager',
                    'operations-assistant',
                    'cleanings',
                    'accounting',
                    'administrative-assistant',
                    'concierge',
                ]),
                'general-search' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'operations-manager',
                    'operations-assistant',
                    'cleanings',
                    'accounting',
                    'administrative-assistant',
                    'concierge',
                ]),
            ],
            'properties' => [
                'heading-menu' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'operations-manager',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                    'owner',
                    'human-resources',
                ]),
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'operations-manager',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                    'owner',
                    'human-resources'
                ]),
                'general-availability' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'operations-manager',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                    'human-resources',
                ]),
            ],
            'property-management' => [
                'heading-menu' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'operations-manager',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                    'owner',
                ]),
                'new-transaction' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'operations-manager',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                ]),
                'transaction-bulk' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'operations-manager',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                ]),
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'accounting',
                ]),
                'balances' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'operations-manager',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                    'owner',
                ]),
                'transactions' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'operations-manager',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                    'cleanings',
                ]),
                'pending-audits' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'operations-manager',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                ]),
            ],
            'property-bookings' => [
                'heading-menu' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                    'concierge',
                    'owner',
                ]),
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                    'concierge',
                    'owner',
                ]),
                'property' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                    'concierge',
                    'owner',
                ]),
                'owner' => self::transformSluggedRolesToIds([
                    'owner',
                ]),
                'requests' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'rentals',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                ]),
                'owner-requests' => self::transformSluggedRolesToIds([
                    'owner',
                ]),
                'agents' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'rentals',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                ]),
                'commissions' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'rentals',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                ]),
                'general-availability' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                    'concierge',
                ]),
                'rates-calculator' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                    'concierge',
                ]),
            ],
            'cleaning-services' => [
                'heading-menu' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'operations-assistant',
                    'cleanings',
                    'accounting',
                    'administrative-assistant',
                    'concierge',
                    'owner',
                ]),
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'operations-assistant',
                    'cleanings',
                    'accounting',
                    'administrative-assistant',
                    'concierge',
                    'owner',
                ]),
                'monthly-batch' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'operations-assistant',
                    'cleanings',
                    'accounting',
                    'administrative-assistant',
                ]),
            ],
            'human-resources' => [
                'heading-menu' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'human-resources',
                    'property-management',
                    'rentals',
                    'operations-manager',
                    'operations-assistant',
                    'cleanings',
                    'accounting',
                    'administrative-assistant',
                    'concierge',
                ]),
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'human-resources',
                ]),
                'directory' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'human-resources',
                    'property-management',
                    'rentals',
                    'operations-manager',
                    'operations-assistant',
                    'cleanings',
                    'accounting',
                    'administrative-assistant',
                    'concierge',
                ]),
            ],
            'pages' => [
                'heading-menu' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'accounting',
                    'administrative-assistant',
                ]),
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'accounting',
                    'administrative-assistant',
                ]),
            ],
            'settings' => [
                'heading-menu' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'accounting',
                    'administrative-assistant',
                ]),
                'users' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
                'workgroups' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
                'roles' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
                'cities' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
                'offices' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
                'zones' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
                'buildings' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
                'amenities' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
                'transaction-types' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
                'cleaning-options' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
                'damage-deposits' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'accounting',
                    'administrative-assistant',
                ]),
                'contacts' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'rentals',
                    'accounting',
                    'administrative-assistant',
                ]),
            ],
        ];

        return $sections;
    }

    /**
     * $roles_slug_list Array of role slugs.
     *
     * @return array List of roles ids
     */
    public static function transformSluggedRolesToIds($roles_slug_list)
    {
        $base_roles = [
            'super' => 1,
            'admin' => 2,
            'property-management' => 3,
            // 'rentals-agent' => 4, (external rentals agent)
            'rentals' => 5,
            'operations-manager' => 6,
            'operations-assistant' => 7,
            'accounting' => 8,
            'administrative-assistant' => 9,
            'concierge' => 10,
            'owner' => 11,
            // 'regular' => 12
            'human-resources' => 13,
            'cleanings' => 14,
        ];

        $roles_ids = [];

        if (is_array($roles_slug_list) && count($roles_slug_list)) {
            foreach ($roles_slug_list as $role_slug) {
                if (isset($base_roles[$role_slug])) {
                    $roles_ids[] = $base_roles[$role_slug];
                }
            }
        }

        return $roles_ids;
    }
}
