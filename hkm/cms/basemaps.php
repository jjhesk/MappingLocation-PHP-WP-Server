<?php
global $meta_boxes;
$meta_boxes[] = array(
    'pages' => array(HKMBASEMAP),
    //This is the id applied to the meta box
    'id' => 'post_bm_basics',
    //This is the title that appears on the meta box container
    'title' => __('General Reporting Map Meta Data', HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
    //This sets the priority within the context where the boxes should show
    'priority' => 'high',
    //Here we define all the fields we want in the meta box
    'fields' => array(
        array(
            'name' => 'Uploaded by CP',
            'id' => "cpname",
            'type' => 'text',
        ),
        array(
            'name' => 'CP - License',
            'id' => "cplicense",
            'type' => 'text',
        ),
        array(
            'name' => 'Work Site Location',
            'id' => "locationsite",
            'type' => 'text',
        ),
        array(
            'name' => 'Project ID',
            'id' => "projectid",
            'type' => 'text',
        ),
        array(
            'name' => 'CP system id',
            'id' => "cp_id",
            'type' => 'text',
        ),
    )
);
$meta_boxes[] = array(
    'pages' => array(HKMBASEMAP),
    //This is the id applied to the meta box
    'id' => 'post_bm_notes',
    //This is the title that appears on the meta box container
    'title' => __('Other Attachment Notes', HKM_LANGUAGE_PACK),
    //This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
    //This sets the priority within the context where the boxes should show
    'priority' => 'high',
    //Here we define all the fields we want in the meta box
    'fields' => array(
//start fields
        array(
            'name' => __('Note from CP', HKM_LANGUAGE_PACK),
            'desc' => 'The special not from the CP investigation',
            'id' => 'cp_special_note',
            'type' => 'textarea',
            'std' => '',
            'cols' => '40',
            'rows' => '8',
        ),
        array(
            'name' => __('Note from staff', HKM_LANGUAGE_PACK),
            'desc' => 'The special not from the staffs',
            'id' => 'official_note',
            'type' => 'textarea',
            'std' => '',
            'cols' => '40',
            'rows' => '8',
        ),
    ));
$labels = array(
    'name' => _x('CP Uploaded Base Map', 'post type general name'),
    'singular_name' => _x('CPbasemap', 'post type singular name'),
    'add_new' => _x('new CPbasemap', HKM_LANGUAGE_PACK),
    'add_new_item' => __('new CPbasemap', HKM_LANGUAGE_PACK),
    'edit_item' => __('Fix CPbasemap', HKM_LANGUAGE_PACK),
    'new_item' => __('new CPbasemap', HKM_LANGUAGE_PACK),
    'all_items' => __('View All CPbasemap', HKM_LANGUAGE_PACK),
    'view_item' => __('CPbasemap', HKM_LANGUAGE_PACK),
    'search_items' => __('Search CPbasemap', HKM_LANGUAGE_PACK),
    'not_found' => __('CPbasemap not found', HKM_LANGUAGE_PACK),
    'not_found_in_trash' => __('CPbasemap was not found in the trash', HKM_LANGUAGE_PACK),
    'parent_item_colon' => '',
    'menu_name' => __('CP BaseMap', HKM_LANGUAGE_PACK)
);
// to learn more
// http://justintadlock.com/archives/2010/04/29/custom-post-types-in-wordpress
$args = array(
    'labels' => $labels,
    'description' => __('The base map uploaded by CP.'),
    'public' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'basemap', 'with_front' => false, 'hierarchical' => false),
    'capability_type' => 'post',
    'has_archive' => true,
    //  'hierarchical' => true,
    'menu_position' => null,
    'taxonomies' => array('post_tag'),
    'supports' => array('title', 'author'),
    'menu_icon' => HKM_ART_PATH . 'DrawingPin2_Blue.png',
);
register_post_type(HKMBASEMAP, $args);
//flush_rewrite_rules();
?>