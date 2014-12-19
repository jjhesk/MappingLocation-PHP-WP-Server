<?php
global $meta_boxes;
$meta_boxes[] = array(
    'pages' => array(HKM_COM),
    //This is the id applied to the meta box
    'id' => 'post_r_company',
    //This is the title that appears on the meta box container
    'title' => __('Registered HK Company', HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
    //This sets the priority within the context where the boxes should show
    'priority' => 'high',
    //Here we define all the fields we want in the meta box
    'fields' => array(
// TAXONOMY
        array(
            'name' => '區域',
            'id' => METAPREFIX . "location",
            'desc' => 'Choose One District in Hong Kong <strong style="color:red">(*)</strong> is required. It needs to be selected in order to be seen on the website.',
            'type' => 'text',
        ),
        array(
            'name' => 'Full Name of the Company',
            'id' => "comnamefull",
            'type' => 'text',
        ),
        array(
            'name' => 'Short Name of the Company',
            'id' => "comnameshort",
            'type' => 'text',
        ),
        array(
            'name' => __('Contact Person Name', HKM_LANGUAGE_PACK),
            'desc' => 'The person you want to reach',
            'id' => 'com_contact_person',
            'type' => 'text',
        ),
        array(
            'name' => __('Contact Number (+852)', HKM_LANGUAGE_PACK),
            'desc' => 'The Contact phone number for the company',
            'id' => 'comphoneno',
            'type' => 'text',
        ),
        array(
            'name' => __('Fax Number (+852)', HKM_LANGUAGE_PACK),
            'id' => 'comfaxno',
            'type' => 'text',
        ),
        array(
            'name' => __('Contact official email for the company', HKM_LANGUAGE_PACK),
            'desc' => 'This is the official email contact method',
            'id' => 'com_email',
            'type' => 'text',
        ),

    )
);
$meta_boxes[] = array(
    'pages' => array(HKM_COM),
    //This is the id applied to the meta box
    'id' => 'post_comrelatedinfo',
    //This is the title that appears on the meta box container
    'title' => __('Company Related Information', HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
    //This sets the priority within the context where the boxes should show
    'priority' => 'high',
    //Here we define all the fields we want in the meta box
    'fields' => array(
//start fields
        array(
            'name' => __('Detailed Information of the company / remark /  other info', HKM_LANGUAGE_PACK),
            'desc' => 'Try less than 1000 words / <strong style="color:red;">less than 300 words</strong>',
            'id' => 'com_remark',
            'type' => 'textarea',
            'std' => '',
            'cols' => '40',
            'rows' => '8',
        ),
        array(
            'name' => __('Company Website', HKM_LANGUAGE_PACK),
            'desc' => 'The official website of the company',
            'id' => 'com_url',
            'type' => 'url',
            'std' => '',
        ),


    ));
$meta_boxes[] = array(
    'pages' => array(HKM_COM),
    //This is the id applied to the meta box
    'id' => 'post_comlegal',
    //This is the title that appears on the meta box container
    'title' => __('Company Legal documents', HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
    //This sets the priority within the context where the boxes should show
    'priority' => 'high',
    //Here we define all the fields we want in the meta box
    'fields' => array(
//start fields
        array(
            'name' => __('Business Registration (BR) PDF', HKM_LANGUAGE_PACK),
            'desc' => 'The official document Document Code for the registered company',
            'id' => 'combrpdf',
            'type' => 'text',
        ),
        array(
            'name' => __('Business Registeration Number', HKM_LANGUAGE_PACK),
            'desc' => 'The HK BR No.',
            'id' => 'combrno',
            'type' => 'text',
        ),
        array(
            'name' => __('Business Registration (BR) Issue Date', HKM_LANGUAGE_PACK),
            'desc' => 'The official document stated the registration date',
            'id' => 'combrregistration',
            'type' => 'text',
        ),
    ));
//print_r($meta_boxes);
// this is the demo post type plese open a new one
$labels = array(
    'name' => _x('Company', 'post type general name'),
    'singular_name' => _x('Company', 'post type singular name'),
    'add_new' => _x('Company Reg', HKM_LANGUAGE_PACK),
    'add_new_item' => __('Company Reg', HKM_LANGUAGE_PACK),
    'edit_item' => __('Edit Company', HKM_LANGUAGE_PACK),
    'new_item' => __('Add Company', HKM_LANGUAGE_PACK),
    'all_items' => __('Company List', HKM_LANGUAGE_PACK),
    'view_item' => __('View Company', HKM_LANGUAGE_PACK),
    'search_items' => __('Find Company', HKM_LANGUAGE_PACK),
    'not_found' => __('Not found', HKM_LANGUAGE_PACK),
    'not_found_in_trash' => __('Not found from the trash bin', HKM_LANGUAGE_PACK),
    'parent_item_colon' => '',
    'menu_name' => __('Company List', HKM_LANGUAGE_PACK)
);
// to learn more
// http://justintadlock.com/archives/2010/04/29/custom-post-types-in-wordpress
$args = array(
    'labels' => $labels,
    'description' => __('Manage the Hong Kong bars nad pubs in the backend system.'),
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
    'supports' => array('title', 'thumbnail', 'author'),
    'menu_icon' => HKM_ART_PATH . 'building-old.png',
);
register_post_type(HKM_COM, $args);
$company_support = new adminsupport(HKM_COM);
$company_support->add_title_input_place_holder(__("Enter the company short name here", HKM_LANGUAGE_PACK));
$company_support->change_publish_button_label(__("Register", HKM_LANGUAGE_PACK));
$company_support->add_script_name('both', 'admin_post_company');
$app_approve = new adminapp(
    array(
        'type' => 'sub',
        'parent_id' => 'edit.php?post_type=' . HKM_COM,
        'sub_id' => 'approvals',
        'cap' => 'ocstaff',
        'title' => __('New Company Approvals', HKM_LANGUAGE_PACK),
        'name' => __('Company Approvals', HKM_LANGUAGE_PACK),
        'script_screen_id' => 'occompany_page_approvals',
        'style' => array('adminsupportcss', 'datatable'),
        'script' => 'page_approve_new_company',
        'cb' => array('oc_company', 'render_admin_page_approve_company')
    )
);


?>