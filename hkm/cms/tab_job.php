<?php
global $meta_boxes;
$meta_boxes[] = array(
    'pages' => array(HKM_JOB),
    //This is the id applied to the meta box
    'id' => 'postconfirmation',
    //This is the title that appears on the meta box container
    'title' => __('Order Confirmation', HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
    //This sets the priority within the context where the boxes should show
    'priority' => 'high',
    //Here we define all the fields we want in the meta box
    'fields' => array(
        array(
            'name' => __('Order by', HKM_LANGUAGE_PACK),
            'desc' => 'The type of order that was made for this job',
            'id' => METAPREFIX . 'ordermetho',
            'type' => 'select',
            'options' => array(
                '-1' => __("please select order type", HKM_LANGUAGE_PACK),
                'online' => __('via automatic system', HKM_LANGUAGE_PACK),
                'call' => __('via telephone call', HKM_LANGUAGE_PACK)
            )
        ),
        array(
            'name' => __('Client Company', HKM_LANGUAGE_PACK),
            'desc' => 'Ref. of the client company in company ID',
            'id' => METAPREFIX . 'client',
            'type' => 'select',
            'options' => oc_company::get_list_companies_metabox_options()
        ),
        array(
            'name' => __('Company Rep. ID', HKM_LANGUAGE_PACK),
            'desc' => 'Ref. of the CR ID',
            'id' => METAPREFIX . 'cr',
            'type' => 'text',
        ),
        array(
            'name' => __('Project ID', HKM_LANGUAGE_PACK),
            'type' => 'text',
            'id' => METAPREFIX . 'projectid',
        ),
        array(
            'name' => __('District', HKM_LANGUAGE_PACK),
            'type' => 'select',
            'options' => oc_project::get_districts_select(),
            'id' => METAPREFIX . 'district'
        ),
        array(
            'name' => __('Order Detail', HKM_LANGUAGE_PACK),
            'desc' => 'The order detail over the phone conversation',
            'id' => METAPREFIX . 'phone_remarks',
            'type' => 'textarea',
            'std' => '',
            'cols' => '40',
            'rows' => '8',
        ),

        array(
            'id' => METAPREFIX . 'location',
            'name' => _x('Google Pin', 'google map', HKM_LANGUAGE_PACK),
            'type' => 'map',
            'std' => '22.25,114.1667,15', // 'latitude,longitude[,zoom]' (zoom is optional)
            'style' => 'width: 100%; height: 500px',
            'address_field' => METAPREFIX . 'reference_loc', // Name of text field where address is entered. Can be list of text fields, separated by commas (for ex. city, state)
            'desc' => 'Choose One District in Hong Kong <strong style="color:red">(*)</strong> is required. It needs to be selected in order to be seen on the website.',
        ),
        array(
            'id' => METAPREFIX . 'reference_loc',
            'name' => _x('Map Search Tool Bar', 'google map', HKM_LANGUAGE_PACK),
            'type' => 'text',
            'std' => _x('Buda, Hong Kong', 'google map', HKM_LANGUAGE_PACK),
        ),
        array(
            'name' => __('Reporting Address', HKM_LANGUAGE_PACK),
            'desc' => 'This address will be used for reporting purpose',
            'id' => METAPREFIX . 'address',
            'type' => 'text',
            'std' => '',
        ),
        /*  array(
            'name' => __('Google Map URL for the address', HKM_LANGUAGE_PACK),
            'desc' => 'Please copy and paste the google URL on this text field and the system will locate the bar/pub place on the frontend<br><img width="100%" src="' . HKM_ART_PATH . 'instruction_googlemap_url.png">',
            'id' => METAPREFIX . 'googleurl',
            'type' => 'text',
            'std' => '',
        ),*/
        array(
            'name' => __('Payment method', HKM_LANGUAGE_PACK),
            'desc' => 'the phone number for the place',
            'id' => METAPREFIX . 'paymentmetho',
            'type' => 'select',
            'options' => array(
                'no-issue' => "no credit issue",
                'bank-in' => 'bank-in',
                'cc' => 'credit card',
                'check' => 'cash check',
            )
        ),
        array(
            'name' => __('Assigned Package Time', HKM_LANGUAGE_PACK),
            'desc' => 'Please specify the time spend during the one day of time',
            'id' => METAPREFIX . '_schedule_day_length',
            'type' => 'select',
            'options' => array(
                '-1' => "Day Length Selection",
                '1D' => "Whole Day (1D)",
                '1/2D' => 'Half Day (1/2D)',
            )
        ),
        array(
            'name' => __('Job Time', HKM_LANGUAGE_PACK),
            'desc' => 'Define the job time range',
            'id' => METAPREFIX . '_time_schedule_setting',
            'type' => 'select',
            'options' => array(
                '-1' => "Schedule Not Defined",
                'single' => "Single Day",
                'range' => 'Time Range',
            )
        ),
        array(
            'name' => __('worksscehdule', HKM_LANGUAGE_PACK),
            'id' => "schedule",
            'type' => 'hidden',
            'std' => '',
        ),
        /*
         *

        array(
            'name' => __('d1', HKM_LANGUAGE_PACK),
            'desc' => 'Define the single day job',
            'id' => "d1",
            'type' => 'text',
            'std' => '',
        ),
        array(
            'name' => __('End Day', HKM_LANGUAGE_PACK),
            'desc' => 'Define the single day job',
            'id' => "d2",
            'type' => 'text',
            'std' => '',
        ),

        */

        /*

        array(
             'name' => __('Job Cost', HKM_LANGUAGE_PACK),
             'desc' => 'The final fix amount of the job cost representing in HKD',
             'id' => METAPREFIX . 'cost',
             'type' => 'number',
         ),

        array(
             'name' => __('Start Time', HKM_LANGUAGE_PACK),
             'id' => METAPREFIX . "start_t",
             'type' => 'datetime',
             // jQuery date picker options. See here http://api.jqueryui.com/datepicker
             'js_options' => array(
                 'appendText' => _x('(yyyy-mm-dd)', 'time format', HKM_LANGUAGE_PACK),
                 'dateFormat' => _x('yy-mm-dd', 'time format', HKM_LANGUAGE_PACK),
                 'timeFormat' => 'hh:mm:00',
                 'changeMonth' => true,
                 'changeYear' => true,
                 'showButtonPanel' => true,
                 'showMonthAfterYear' => true,
                 'stepMinute' => 5,
                 'showSecond' => false,
                 'numberOfMonths' => 3,
                 'showCurrentAtPos' => 1,
                 'createButton' => true
             ),
         ),

         array(
             'name' => __('End Time', HKM_LANGUAGE_PACK),
             'id' => METAPREFIX . "end_t",
             'type' => 'datetime',
             // jQuery date picker options. See here http://api.jqueryui.com/datepicker
             'js_options' => array(
                 'appendText' => _x('(yyyy-mm-dd)', 'time format', HKM_LANGUAGE_PACK),
                 'dateFormat' => _x('yy-mm-dd', 'time format', HKM_LANGUAGE_PACK),
                 'timeFormat' => 'hh:mm:00',
                 'changeMonth' => true,
                 'changeYear' => true,
                 'showButtonPanel' => true,
                 'showMonthAfterYear' => true,
                 'stepMinute' => 5,
                 'showSecond' => false,
                 'numberOfMonths' => 3,
                 'showCurrentAtPos' => 1,
                 'createButton' => true
             ),
         ),

        */
    )
);
$meta_boxes[] = array(
    'pages' => array(HKM_JOB),
    //This is the id applied to the meta box
    'id' => 'jobassignment',
    //This is the title that appears on the meta box container
    'title' => __('Job Assignment', HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
    //This sets the priority within the context where the boxes should show
    'priority' => 'high',
    //Here we define all the fields we want in the meta box
    'fields' => array(

        array(
            'name' => __('App Info Images', HKM_LANGUAGE_PACK),
            'desc' => 'The input of the related images for the CP',
            'id' => METAPREFIX . 'base_map',
            'type' => 'image_advanced',
            'max_file_uploads' => 20,
        ),
        array(
            'name' => __('Tool Assignments', HKM_LANGUAGE_PACK),
            'desc' => 'Name of the Tools',
            'id' => METAPREFIX . 'tool',
            'type' => 'text',
        ),
        array(
            'name' => __('Job status', HKM_LANGUAGE_PACK),
            'desc' => 'The status to look for the suitable personnel for the opened job. <br> close: close and unlist<br>open: open to be seleced for the available candidates<br>hired: the cp is hired for this job and the deals are agreed',
            'id' => METAPREFIX . 'jobstatus',
            'type' => 'select',
            'options' => array(
                'closed' => 'close and unlisted',
                'open' => 'open for the public',
                'hired' => 'cp hired'
            ),
            'std' => '-1'
        ),
        array(
            'name' => __('work status', HKM_LANGUAGE_PACK),
            'desc' => 'this box is controlled by the system /0: job confirmation, /1: assign CP /2: assign Job Data /3: final stage - review reports',
            'id' => 'work_status_virtual',
            'type' => 'hidden',
            'std' => '0'
        ),
        array(
            'name' => __('CPID', HKM_LANGUAGE_PACK),
            'type' => 'hidden',
            'id' => 'offerjbcpid',
            'std' => '-1'
        )
    )
);
$meta_boxes[] = array(
    'pages' => array(HKM_JOB),
    //This is the id applied to the meta box
    'id' => 'job_cost_calculator',
    //This is the title that appears on the meta box container
    'title' => __('Accounting Box', HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
    //This sets the priority within the context where the boxes should show
    'priority' => 'high',
    //Here we define all the fields we want in the meta box
    'fields' => array(
        array(
            'name' => __('Relevant information', HKM_LANGUAGE_PACK),
            'desc' => 'To Consider this job cost...',
            'id' => METAPREFIX . 'job_json',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => __('CP Name', HKM_LANGUAGE_PACK),
            'desc' => 'Name of the CP',
            'id' => METAPREFIX . 'cp_name',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => __('CP License Cert', HKM_LANGUAGE_PACK),
            'desc' => 'CP Certification',
            'id' => METAPREFIX . 'cp_cert',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => __('Rating of the CP', HKM_LANGUAGE_PACK),
            'desc' => 'The historical CP rating at the point of the job assignment',
            'id' => METAPREFIX . 'cp_rating',
            'type' => 'text',
        ),
        array(
            'name' => __('Payment method', HKM_LANGUAGE_PACK),
            'desc' => 'the phone number for the place',
            'id' => METAPREFIX . 'paymentmetho',
            'type' => 'select',
            'options' => array(
                'no-issue' => "no credit issue",
                'bank-in' => 'bank-in',
                'cc' => 'credit card',
                'check' => 'cash check',
            )
        ),
        array(
            'name' => __('Total Cost of this Job', HKM_LANGUAGE_PACK),
            'desc' => 'Total Cost of this Project of jobs',
            'id' => METAPREFIX . 'cost_total',
            'type' => 'number',
        ),
        array(
            'name' => __('Single cost of this job', HKM_LANGUAGE_PACK),
            'desc' => 'Costing',
            'id' => METAPREFIX . 'cost_single',
            'type' => 'number',
        ),
    )
);
$meta_boxes[] = array(
    'pages' => array(HKM_JOB),
    //This is the id applied to the meta box
    'id' => 'jobsubmission',
    //This is the title that appears on the meta box container
    'title' => __('Submission', HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
    //This sets the priority within the context where the boxes should show
    'priority' => 'high',
    //Here we define all the fields we want in the meta box
    'fields' => array(

        array(
            'name' => __('Site Pictures', HKM_LANGUAGE_PACK),
            'desc' => 'The pictures taken from the site',
            'id' => METAPREFIX . 'sitepix',
            'type' => 'hidden',
            'std' => ''
        ),
        array(
            'name' => __('Measurement reports', HKM_LANGUAGE_PACK),
            'desc' => 'The sketching including the returned base map',
            'id' => METAPREFIX . 'drafts',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => __('E-signature', HKM_LANGUAGE_PACK),
            'desc' => 'The signature completed from the CP',
            'id' => METAPREFIX . 'sign',
            'type' => 'hidden',
            'std' => ''
        ),
        array(
            'name' => __('Document status', HKM_LANGUAGE_PACK),
            'id' => METAPREFIX . 'docstatus',
            'type' => 'select',
            'options' => array(
                'new' => _x('New', 'job status', HKM_LANGUAGE_PACK),
                'sketching' => _x('Sketching', 'job status', HKM_LANGUAGE_PACK),
                'submitted' => _x('Submitted', 'job status', HKM_LANGUAGE_PACK),
                'aftersubmit' => _x('Reviewing', 'job status', HKM_LANGUAGE_PACK),
                'complete' => _x('Complete', 'job status', HKM_LANGUAGE_PACK),
            ),
            'desc' => 'the phone number for the place',
            'multiple' => false,
            'std' => 'new'
        ),
    )
);
//print_r($meta_boxes);
// this is the demo post type plese open a new one
$labels = array(
    'name' => _x('Job', 'post type general name'),
    'singular_name' => _x('Job', 'post type singular name'),
    'add_new' => _x('New Job', HKM_LANGUAGE_PACK),
    'add_new_item' => __('Add Job', HKM_LANGUAGE_PACK),
    'edit_item' => __('Modify Job', HKM_LANGUAGE_PACK),
    'new_item' => __('New Job', HKM_LANGUAGE_PACK),
    'all_items' => __('View Jobs', HKM_LANGUAGE_PACK),
    'view_item' => __('View jobs', HKM_LANGUAGE_PACK),
    'search_items' => __('Search Job', HKM_LANGUAGE_PACK),
    'not_found' => __('The demanded Job was not found', HKM_LANGUAGE_PACK),
    'not_found_in_trash' => __('There is no Job can be found in the trash can', HKM_LANGUAGE_PACK),
    'parent_item_colon' => '',
    'menu_name' => __('Job Market', HKM_LANGUAGE_PACK)
);
// to learn more
// http://justintadlock.com/archives/2010/04/29/custom-post-types-in-wordpress
$args = array(
    'labels' => $labels,
    'description' => __('Manage all the job listings in Hong Kong'),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    /*
    'capability_type' => 'bar_editing',
    'capabilities'=>array(
                 'publish_posts' => 'publish_bar',
                 'edit_posts' => 'edit_bar',
                 'edit_others_posts' => 'edit_others_bar',
                 'delete_posts' => 'delete_bar',
                 'delete_others_posts' => 'delete_others_bar',
                 'read_private_posts' => 'read_private_bar',
                 'edit_post' => 'edit_bar',
                 'delete_post' => 'delete_bar',
                 'read_post' => 'read_bar',
      ),

    */
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title', 'author'),
    'menu_icon' => HKM_ART_PATH . '1346241562_travel.png',
);
register_post_type(HKM_JOB, $args);
//$mpthnail = new MultiPostThumbnails(array('label' => "LOCATION MAP", 'id' => 'local_map', 'post_type' => HKM_JOB));
$job_panel_support = new adminsupport(HKM_JOB);
$job_panel_support->add_title_input_place_holder(__("Enter job ID here", HKM_LANGUAGE_PACK));
$job_panel_support->change_publish_button_label(__("Enqueue job", HKM_LANGUAGE_PACK));


$job_panel_support->add_script_name('both', 'admin_post_job_process');
$job_panel_support->add_style('adminsupportcss');
$job_panel_support->load_admin_valuables('admin_post_job_process', 'jp_status', array(
    METAPREFIX . 'jobstatus', METAPREFIX . 'docstatus', METAPREFIX . 'ordermetho'
), array(
    'tpm_normal_field' => ui_handler::apply_oc_template_with_mustache('admin_metabox_field_options', array(
            "Field_Label_id" => "ui_ref_order_id",
            "Field_Label" => "Ref. Order ID",
            "Field_Select_Option" => oc_db_order::prepare_ui_options()
        )),
    'recent_orders_html' => oc_db_order::prepare_ui_options(),
    'days_schedule_html' => get_oc_template('admin_job_confirmation_range'),
));

$job_panel_support

    ->add_metabox(
        "measurement_report",
        __("Job Reports", HKM_LANGUAGE_PACK),
        get_oc_template('admin_job_record_template_table'))

    ->add_metabox(
        'cp_applicant_list',
        __("CP Candidate List", HKM_LANGUAGE_PACK),
        array("ocmodel", "list_applicant_job_cp_html"),
        array("offerjbcpid", "cplistresult")
    );

/*$job_panel_support->add_hide_metaboxes_on_new_post(array(
    'jobsubmission', 'measurement_report', 'cp_applicant_list'
));*/
function cp_mgm_special_save_support($post_id)
{

    if (!isset($_POST['offerjbcpid'])) return;
    if (empty($_POST['offerjbcpid'])) return;
    $cpID = $_POST['offerjbcpid'];
    // if (intval($cpID) != intval(get_post_meta($post_id, 'offerjbcpid', true))) {
    // debugoc::upload_bmap_log("update is on 380 ", 49800);
    // oc_market_notification::notify_job_offer($post_id, $cpID);
    // }
}

add_action('rwmb_jobassignment_after_save_post', 'cp_mgm_special_save_support');
function postconfirmation_save_support($post_id)
{
    if (!isset($_POST[METAPREFIX . 'projectid'])) return;
    oc_project::insert_ref_row($_POST[METAPREFIX . 'projectid'], $post_id, $_POST[METAPREFIX . 'district']);
}

add_action('rwmb_postconfirmation_after_save_post', 'postconfirmation_save_support');


?>