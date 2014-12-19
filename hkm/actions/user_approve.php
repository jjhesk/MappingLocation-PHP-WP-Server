<?php
/**
 * Created by PhpStorm.
 * User: Hesk
 * Date: 14年5月26日
 * Time: 下午2:58
 */

$app_cr_approve = new adminapp(
    array(
        'type' => 'user',
        'sub_id' => 'crapprovals',
        'cap' => 'ocstaff',
        'title' => __('CR Approvals Application', HKM_LANGUAGE_PACK),
        'name' => __('CR Approvals', HKM_LANGUAGE_PACK),
        'script_screen_id' => 'users_page_crapprovals',
        'style' => array('adminsupportcss', 'datatable'),
        'script' => 'page_approve_new_cr',
        'cb' => array('oc_cr', 'render_admin_page_approve_cr')
    )
);

$app_cp_approve = new adminapp(
    array(
        'type' => 'user',
        'sub_id' => 'cpapprovals',
        'cap' => 'ocstaff',
        'title' => __('CP Approvals Application', HKM_LANGUAGE_PACK),
        'name' => __('CP Approvals', HKM_LANGUAGE_PACK),
        'script_screen_id' => 'users_page_cpapprovals',
        'style' => array('adminsupportcss', 'datatable'),
        'script' => 'page_approve_new_cp',
        'cb' => array('oc_cp', 'render_admin_page_approve_cp')
    )
);

//http://onecallapp.imusictech.net/wp-admin/users.php?role=cp




?>