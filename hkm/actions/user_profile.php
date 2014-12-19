<?php
/**
 * Created by PhpStorm.
 * User: hesk
 * Date: 1/26/14
 * Time: 1:09 AM
 */
/*
$save_data_list = array(
    "greeting" => "Greeting",
    "id4digit" => "The first 4 digits of the ID",
    "country_code"=>"Country"
);*/
function add_profile_options($user_object)
{
    $user_profile_render = new admin_user_profile();
    $user_profile_render->init($user_object);

    /*
    if (in_array('store_manager', $user_object->roles) && oc_db_account::has_role("administrator")) {
        $user_profile_render->add_box(array(
            "mac_id" => "machine mac address",
            "vendor_loc_center" => "location center",
            "vendor_id" => "Exclusive vendor",
            "stock_manager_report" => "Report 2",
            "stock_manager_review_account" => "Account review 1"
        ));
    }
    */

    if (in_array('cp', $user_object->roles)) {
        $user_profile_render->add_box(array(
            "rate" => "Rating",
            "price" => "Price Range",
            "cp_cert" => "Certification No.",
            "cp_certexp" => "Certification Expiration",
            "portrait" => "Cert Photo",
            "gf_cp_attachments" => "CP Documents",
            "company_id" => "Company",
            "phone1" => "Contact Number 1St",
            "phone2" => "Contact Number 2nd",
            "address" => "Address",
            "mac_id" => "Recent mac address",
            "access_token" => "Login Token",
            "email_activation" => "Email Verified",
            "status" => "Current Activity",
            "last_login_lastlogintime" => "Last Login"
        ), true);
    } else if (in_array('cr', $user_object->roles)) {
        $user_profile_render->add_box(array(
            "price" => "Set Fix Price for Projects",
            "jobsordered" => "Ordered Jobs",
            "company_id" => "Company ID",
            "phone1" => "Contact Number",
            "email_activation" => "Email Verified",
            "status" => "Current Activity",
            "last_login_lastlogintime" => "Last Login"
        ), true);
    } else {
        $user_profile_render->add_box(array(
            "last_login_lastlogintime" => "Last Login"
        ), true);
    }
    /**
     *   $lastlogin = get_user_meta($user->ID, 'last_login_lastlogintime', true);
     * if ($lastlogin) {
     * $t = strftime($format, $lastlogin);
     * } else {
     * $t = "";
     * }
     */
    /*
    if (in_array('administrator', $user_object->roles)) {
         $user_profile_render->add_box(array(
             "latest" => "IP",
         ));
     }
    */

    $user_profile_render->render_end();
}

/**
 * Custom User Contact Methods
 */
add_filter('user_contactmethods', 'dp_custom_user_contactmethods');
function dp_custom_user_contactmethods($methods)
{
    /* Add custom contact methods
    $new_methods = array(
        'twitter' => __('Twitter', 'dp'),
        'facebook' => __('Facebook', 'dp'),
        'location' => __('Location', 'dp')
    );
    */
    $new_methods = array();
    return array_merge($new_methods, $methods);
}

add_action('show_user_profile', 'add_profile_options');
add_action('edit_user_profile', 'add_profile_options');
//add_action('personal_options', 'add_profile_options');
//add_filter('user_contactmethods', 'add_extra_contactmethod', 10, 1);
//add_action('personal_options_update', array('admin_user_profile', 'update', 10, 1));
add_action('edit_user_profile_update', array('admin_user_profile', 'update'), 10, 1);
add_action('personal_options_update', array('admin_user_profile', 'update'), 10, 1);