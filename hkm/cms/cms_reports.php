<?php
/**
 * Created by PhpStorm.
 * User: Hesk
 * Date: 14年6月6日
 * Time: 上午11:06
 */


global $meta_boxes;
$meta_boxes[] = array(
    'pages' => array(HKM_REPORT),
    //This is the id applied to the meta box
    'id' => 'post_report_basic_box',
    //This is the title that appears on the meta box container
    'title' => __('Basic report data', HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
    //This sets the priority within the context where the boxes should show
    'priority' => 'high',
    //Here we define all the fields we want in the meta box
    'fields' => array(
        //TAXONOMY
        array(
            'name' => 'Job ID',
            'id' => "report_job_id",
            'type' => 'select',
            'options' => oc_job_list::get_options_new()
        ),
        array(
            'name' => __('Revision Number', HKM_LANGUAGE_PACK),
            'id' => "report_revision",
            'type' => 'text',
        ),
        array(
            'name' => __('Month and year', HKM_LANGUAGE_PACK),
            'desc' => 'the submitting month and year',
            'id' => 'report_month_year',
            'type' => 'text',
        ),
        array(
            'id' => 'total_pages',
            'type' => 'hidden',
        ),
        array(
            'id' => 'template_used',
            'type' => 'hidden',
        ),
        //loaded_submission_id
        array(
            'id' => 'loaded_submission_id',
            'type' => 'hidden',
        ),
        array(
            'id' => 'save_report',
            'type' => 'hidden',
        ),
    )
);

//print_r($meta_boxes);
// this is the demo post type plese open a new one
$labels = array(
    'name' => _x('Report Bank', 'post type general name'),
    'singular_name' => _x('Report Bank', 'post type singular name'),
    'add_new' => _x('Add Report', HKM_LANGUAGE_PACK),
    'add_new_item' => __('Add Report', HKM_LANGUAGE_PACK),
    'edit_item' => __('Edit Report', HKM_LANGUAGE_PACK),
    'new_item' => __('Add Report', HKM_LANGUAGE_PACK),
    'all_items' => __('List All', HKM_LANGUAGE_PACK),
    'view_item' => __('View Report', HKM_LANGUAGE_PACK),
    'search_items' => __('Search Report', HKM_LANGUAGE_PACK),
    'not_found' => __('Not Found', HKM_LANGUAGE_PACK),
    'not_found_in_trash' => __('Not Found', HKM_LANGUAGE_PACK),
    'parent_item_colon' => '',
    'menu_name' => __('Report Bank', HKM_LANGUAGE_PACK)
);
// to learn more
// http://justintadlock.com/archives/2010/04/29/custom-post-types-in-wordpress
$args = array(
    'labels' => $labels,
    'description' => __('Report Management System'),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    /*  'capability_type' => 'bar_editing',
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
      ),*/
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title', 'custom-fields'),
    'menu_icon' => HKM_ART_PATH . 'briefcase_16.png',
);
register_post_type(HKM_REPORT, $args);


$report_panel_support = new adminsupport(HKM_REPORT);
$report_panel_support->add_title_input_place_holder(__("Enter Job Report ID", HKM_LANGUAGE_PACK));
$report_panel_support->change_publish_button_label(__("Create New Job Report", HKM_LANGUAGE_PACK));
$report_panel_support->add_script_name('both', 'admin_report_js');
$report_panel_support->add_style('cms_report_panel_css');
$report_panel_support->load_admin_valuables('admin_report_js', 'jp_status', array(
        'report_job_id',
        'report_revision',
        'report_month_year'
    ), array(
        'tpm_normal_field' => ui_handler::apply_oc_template_with_mustache(
                'admin_metabox_field_options',
                array(
                    "Field_Label_id" => "ui_ref_order_id",
                    "Field_Label" => "Ref. Order ID",
                    "Field_Select_Option" => ""
                )
            ),
    )
);
$report_panel_support

    ->add_metabox(
        "report_template_list",
        __("Report Template List", HKM_LANGUAGE_PACK),
        get_oc_template('admin_report_template_table'))

    ->add_metabox(
        'report_book_content',
        __("Report Content", HKM_LANGUAGE_PACK),
        get_oc_template('admin_report_content')
    )

    ->add_metabox(
        'returned_data_list',
        __("Submission Data List", HKM_LANGUAGE_PACK),
        get_oc_template('admin_report_datalist')
    );

$report_panel_support->add_hide_metaboxes_on_new_post(
    array(
        'report_template_list',
        'report_book_content'
    )
);