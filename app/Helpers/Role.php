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
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
            ],
            'booking' => [
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'requests' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'agents' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'commissions' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'general-availability' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
            ],
            'properties' => [
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'property-types' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
            ],
            'property-management' => [
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'balances' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'transactions' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'pending-audits' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
            ],
            'cleaning-services' => [
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'staff' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
            ],
            'contractors' => [
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
                'services' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
            ],
            'users' => [
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
                'index' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
                ]),
            ],
            'settings' => [
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
                    'admin'
                ]),
                'damage-deposits' => self::transformSluggedRolesToIds([
                    'super',
                    'admin'
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
            'pm' => 3,
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