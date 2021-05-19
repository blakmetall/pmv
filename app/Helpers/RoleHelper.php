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
            foreach ($user->roles as $role) {
                $roles[] = $role->translations()->where('language_id', $lang->id)->first();
            }
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

    /**
     * @return array List of url sections with their subsections
     *               and their allowed roles ids per section
     */
    public static function getAllowedSections()
    {
        $sections = [
            'dashboard' => [
                '*' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
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
            'property-bookings' => [
                '*' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
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
            ],
            'properties' => [
                '*' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
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
                ]),
            ],
            'property-management' => [
                '*' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
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
            'cleaning-services' => [
                '*' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
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
                '*' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
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
                '*' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
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
                '*' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
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
            'rentals' => 4,
            // 'rentals-agent' => 5, (external rentals agent)
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

    /**
     * $permission ['view', 'edit']; base code for permission section inside controller 
     *
     * @return bool true or false according to current role and permission action
     */
    public static function can( $roleSlug, $permission, $section, $subsection) {
        $section = getSectionPermission($section, $subsection);

        if($permission == 'view') {
            if(isset($section[$roleSlug]) && in_array($permission, $section[$roleSlug])) {
                return true;
            }
            
            return false;
        }

        if($permission == 'edit') {
            if(isset($section[$roleSlug]) && in_array($permission, $section[$roleSlug])) {
                return true;
            }
            
            return false;
        }

        return false;
    }

    /**
     * función para comparar una sección con un slug y ver si tiene permiso para ver o editar
     */
    public static function getSectionPermission($section, $subsection, $roleSlug)
    {
        $sections = [
            'dashboard' => [
                'index' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'property-management' => ['view', 'edit'],
                    'rentals' => ['view', 'edit'],
                    'operations-manager' => ['view', 'edit'],
                    'operations-assistant' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                    'concierge' => ['view', 'edit'],
                ]
            ],
            'property-bookings' => [
                'property' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'property-management' => ['view', 'edit'],
                    'rentals' => ['view', 'edit'],
                    'operations-assistant' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                    'concierge' => ['view', 'edit'],
                    'owner' => ['view', 'edit'],
                ],
                'owner' => [
                    'owner' => ['view', 'edit'],
                ],
                'requests' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'rentals' => ['view', 'edit'],
                    'operations-assistant' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                ],
                'owner-requests' => [
                    'owner' => ['view', 'edit'],
                ],
                'agents' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'rentals' => ['view', 'edit'],
                    'operations-assistant' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                ],
                'commissions' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'rentals' => ['view', 'edit'],
                    'operations-assistant' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                ],
                'general-availability' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'property-management' => ['view', 'edit'],
                    'rentals' => ['view', 'edit'],
                    'operations-assistant' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                    'concierge' => ['view', 'edit'],
                ],
            ],
            'properties' => [
                'index' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'property-management' => ['view', 'edit'],
                    'rentals' => ['view', 'edit'],
                    'operations-manager' => ['view', 'edit'],
                    'operations-assistant' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                    'owner' => ['view', 'edit'],
                ],
                'general-availability' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'property-management' => ['view', 'edit'],
                    'rentals' => ['view', 'edit'],
                    'operations-manager' => ['view', 'edit'],
                    'operations-assistant' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                ],
            ],
            'property-management' => [
                'new-transaction' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'property-management' => ['view', 'edit'],
                    'operations-manager' => ['view', 'edit'],
                    'operations-assistant' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                ],
                'transaction-bulk' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'property-management' => ['view', 'edit'],
                    'operations-manager' => ['view', 'edit'],
                    'operations-assistant' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                ],
                'index' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                ],
                'balances' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'property-management' => ['view', 'edit'],
                    'operations-manager' => ['view', 'edit'],
                    'operations-assistant' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                    'owner' => ['view', 'edit'],
                ],
                'transactions' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'property-management' => ['view', 'edit'],
                    'operations-manager' => ['view', 'edit'],
                    'operations-assistant' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                ],
                'pending-audits' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'property-management' => ['view', 'edit'],
                    'operations-manager' => ['view', 'edit'],
                    'operations-assistant' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                ],
            ],
            'cleaning-services' => [
                'heading-menu' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'property-management' => ['view', 'edit'],
                    'rentals' => ['view', 'edit'],
                    'operations-assistant' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                    'concierge' => ['view', 'edit'],
                    'owner' => ['view', 'edit'],
                ],
                'index' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'property-management' => ['view', 'edit'],
                    'rentals' => ['view', 'edit'],
                    'operations-assistant' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                    'concierge' => ['view', 'edit'],
                    'owner' => ['view', 'edit'],
                ],
                'monthly-batch' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'property-management' => ['view', 'edit'],
                    'operations-assistant' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                ],
            ],
            'human-resources' => [
                'index' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'human-resources' => ['view', 'edit'],
                ],
                'directory' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'human-resources' => ['view', 'edit'],
                    'property-management' => ['view', 'edit'],
                    'rentals' => ['view', 'edit'],
                    'operations-manager' => ['view', 'edit'],
                    'operations-assistant' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                    'concierge' => ['view', 'edit'],
                ],
            ],
            'pages' => [
                'index' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                ],
            ],
            'settings' => [
                'users' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                ],
                'workgroups' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                ],
                'roles' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                ],
                'cities' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                ],
                'offices' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                ],
                'zones' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                ],
                'buildings' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                ],
                'amenities' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                ],
                'transaction-types' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                ],
                'cleaning-options' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                ],
                'damage-deposits' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                ],
                'contacts' => [
                    'super' => ['view', 'edit'],
                    'admin' => ['view', 'edit'],
                    'accounting' => ['view', 'edit'],
                    'administrative-assistant' => ['view', 'edit'],
                ],
            ],
        ];

        if(isset($sections[$section]) && isset($sections[$section][$subsection])) {
            return $sections[$section][$subsection];
        }

        return [];
    }
}
