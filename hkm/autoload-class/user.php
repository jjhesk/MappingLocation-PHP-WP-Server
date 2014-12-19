<?php

/**
 * Created by PhpStorm.
 * User: hesk
 * Date: 4/23/14
 * Time: 11:22 PM
 */
class user extends WP_User
{
    public function __construct()
    {

    }

    /**
     * check the role
     * @param $role_name
     * @internal param $role_key
     * @return bool
     */
    public static function has_role($role_name)
    {
        $cu = wp_get_current_user();
        if (isset($cu->roles)) {
            // debugoc::log_array($cu -> roles);
            return in_array($role_name, $cu->roles);
        } else
            return false;
    }

    public static function has_role_id($role_name, $user_id)
    {
        $user = new WP_User($user_id);
        if (isset($user->roles)) {
            return in_array($role_name, $user->roles);
        } else
            return false;
    }
} 