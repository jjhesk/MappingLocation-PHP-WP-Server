<?php
defined('ABSPATH') || exit;
$app_cp_panel = new adminapp(
    array(
        'type' => 'main',
        'icon' => EXIMAGE . "adv_3234ng.png",
        'position' => 11,
        'parent_id' => 'joblisting',
        'cap' => 'cp',
        'title' => __('Job List Market', HKM_LANGUAGE_PACK),
        'name' => __('Job List', HKM_LANGUAGE_PACK),
        'cb' => array('oc_job_list', 'render_page_list'),
        'script' => 'page_job_application',
        'style' => array('adminsupportcss', 'datatable', 'dashicons'),
        /*'script_localize' => array("jb_tablesource", array(
            "tableurl" => site_url("/api/appaccess/") . "get_my_jobs_market",
        )
        )*/
    )
);

$app_cp_panel->add_sub(array(
    'title' => __('My Jobs In Progress', HKM_LANGUAGE_PACK),
    'name' => __('My Jobs', HKM_LANGUAGE_PACK),
    'sub_id' => 'successoffers',
    'cb' => array('oc_job_list', 'render_page_task'),
    'script_screen_id' => 'job-list_page_successoffers',
    //  'script' => 'joblisttb',
    //   'style' => 'kendo_default',
    'script' => 'page_job_task_history',
    'style' => array('adminsupportcss', 'datatable', 'dashicons'),
/*    'script_localize' => array("jb_tablesource", array(
        "tableurl" => site_url("/api/appaccess/") . "get_my_jobs_progress",
    ))*/
));

