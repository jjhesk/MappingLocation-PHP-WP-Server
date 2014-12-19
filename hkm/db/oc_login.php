<?php

/**
 * Created by PhpStorm.
 * User: Hesk
 * Date: 14年5月23日
 * Time: 上午10:22
 */
class oc_login
{
    function __construct()
    {

    }

    public function pre_init()
    {
        add_action('wp_authenticate', array(&$this, 'check_custom_authentication'));
        return $this;
    }

    public function check_custom_authentication($username)
    {
        global $wpdb;

        if (!username_exists($username)) {
            return;
        }
        $userinfo = get_user_by('login', $username);
        $property = $wpdb->prefix . "capabilities";
        $caps = $userinfo->$property;
        foreach ($caps as $role) {
            if ($role == 'cp') {
                $this->wpExternalLoginProcess($username, $_POST['pwd']);
            }
        }
    }

    private function wpExternalLoginProcess($user_name, $pw)
    {

    }
} 