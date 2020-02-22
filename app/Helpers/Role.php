<?php 

namespace App\Helpers;

class Role
{
    /**
     * Get the current user role configured in profile
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

        return \App\Models\Role::where('id', $user->profile->config_role_id)->first();
    }

    /**
     * Checks if role is allowed for a speficic section, subsection and section listing
     * 
     * @return bool
     */
    public static function isAllowed($role_id, $section, $sub, $sections) 
    {
        if ( isset($sections[$section]) && isset($sections[$section][$sub])) {
            
            if ( in_array($role_id, $sections[$section][$sub])) {
                return true;
            }

        }

        return false;
    }
    
    /**
     * @return Array List of url sections with their subsections 
     *               and their allowed roles ids per section
     */
    public static function getAllowedSections() {
        $sections = [
            'calendar' => [
                '*' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
                'heading-menu' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'rentals-agent',
                    'rentals-agent',
                    'operations-manager',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                    'concierge',
                ]),
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'rentals-agent',
                    'operations-manager',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                    'concierge',
                ]),
            ],
            'booking' => [
                '*' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'heading-menu' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'rentals-agent',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                    'concierge',
                ]),
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'rentals-agent',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                    'concierge',
                ]),
                'requests' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'rentals',
                    'rentals-agent',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                ]),
                'agents' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'rentals',
                    'rentals-agent',
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
                    'rentals-agent',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                    'concierge',
                ]),
            ],
            'properties' => [
                '*' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'heading-menu' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'rentals-agent',
                    'operations-manager',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                ]),
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'rentals-agent',
                    'operations-manager',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                ]),
                'property-types' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'rentals-agent',
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
                ]),
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'operations-manager',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                ]),
                'balances' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'operations-manager',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
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
                    'rentals-agent',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                    'concierge',
                ]),
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'rentals',
                    'rentals-agent',
                    'operations-assistant',
                    'accounting',
                    'administrative-assistant',
                    'concierge',
                ]),
                'staff' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'operations-assistant',
                    'concierge',
                ]),
            ],
            'contractors' => [
                '*' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
                'heading-menu' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'operations-manager',
                    'accounting',
                    'administrative-assistant',
                ]),
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'operations-manager',
                    'accounting',
                    'administrative-assistant',
                ]),
                'services' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'property-management',
                    'operations-manager',
                    'accounting',
                    'administrative-assistant',
                ]),
            ],
            'users' => [
                '*' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'heading-menu' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'staff-groups' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'roles' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
            ],
            'reporting' => [
                '*' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
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
                    'admin'
                ]),
                'heading-menu' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'accounting',
                    'administrative-assistant',
                ]),
                'cities' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'zones' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'amenities' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'transaction-types' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'rental-cleaning-options' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                ]),
                'damage-deposits' => self::transformSluggedRolesToIds([
                    'super',
                    'admin',
                    'accounting',
                    'administrative-assistant',
                ]),
            ]
        ];

        return $sections;
    }

    /**
     * $roles_slug_list Array of role slugs 
     * 
     * @return Array List of roles ids
     */
    public static function transformSluggedRolesToIds($roles_slug_list) {

        //echo '<pre>', print_r($roles_slug_list), '<pre>'; exit; 

        $base_roles = [
            'super' => 1,
            'admin' => 2,
            'property-management' => 3,
            'rentals' => 4,
            'rentals-agent' => 5,
            'operations-manager' => 6,
            'operations-assistant' => 7,
            'accounting' => 8,
            'administrative-assistant' => 9,
            'concierge' => 10
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