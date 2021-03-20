<?php 

namespace App\Helpers;

class ContactsHelper
{
    public static function getTypes() {
        return [
            'home-owner' => (object ) [
                'id' => 'home-owner',
                'label' => __('Home Owner'),
            ],
            'property-manager' => (object ) [
                'id' => 'property-manager',
                'label' => __('Property Manager'),
            ],
            'administrator' => (object ) [
                'id' => 'administrator',
                'label' => __('Administrator'),
            ],
        ];
    }

    public static function getLabelBySlug($typeSlug) {
        $types = self::getTypes();

        if(isset($types[$typeSlug])) {
            return $types[$typeSlug]->label;
        }

        return '';
    }
}