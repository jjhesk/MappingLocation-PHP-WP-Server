<?php
global $meta_boxes;
$meta_boxes[] = array('pages' => array(HKM_TOOLS),
//This is the id applied to the meta box
    'id' => 'oc_meta_tool_fields',
//This is the title that appears on the meta box container
    'title' => __('Tooling Content Box', HKM_LANGUAGE_PACK),
//This defines the part of the page where the edit screen section should be shown
    'context' => 'normal',
//This sets the priority within the context where the boxes should show
    'priority' => 'high',
//Here we define all the fields we want in the meta box
    'fields' => array(
        array('name' => __('Brand', HKM_LANGUAGE_PACK), 'id' => "brand", 'type' => 'text'),
        array('name' => __('Mode', HKM_LANGUAGE_PACK), 'id' => "model", 'type' => 'text'),
        array('name' => __('Serial Number (S/N)', HKM_LANGUAGE_PACK), 'id' => "serialno", 'type' => 'text',),
        array('name' => __('Calibration Date', HKM_LANGUAGE_PACK), 'desc' => 'Labeling this tool', 'id' => 'caldate', 'type' => 'date'),
        array('name' => __('Total', HKM_LANGUAGE_PACK), 'desc' => 'The Contact phone number for the tool', 'id' => 'oc_tool', 'type' => 'number'),
        array('name' => __('Available', HKM_LANGUAGE_PACK), 'desc' => 'Number amount of tool that is available for use now.', 'id' => 'availabletool', 'type' => 'number')
));
//print_r($meta_boxes);
// this is the demo post type plese open a new one
$labels = array(
    'name' => _x('Tool', 'post type general name'),
    'singular_name' => _x('Tool', 'post type singular name'),
    'add_new' => _x('new tool', HKM_LANGUAGE_PACK),
    'add_new_item' => __('new tool', HKM_LANGUAGE_PACK),
    'edit_item' => __('modify tool', HKM_LANGUAGE_PACK),
    'new_item' => __('new tool', HKM_LANGUAGE_PACK),
    'all_items' => __('list tool', HKM_LANGUAGE_PACK),
    'view_item' => __('view tool detail', HKM_LANGUAGE_PACK),
    'search_items' => __('search tool', HKM_LANGUAGE_PACK),
    'not_found' => __('not found', HKM_LANGUAGE_PACK),
    'not_found_in_trash' => __('no found in the trash bin', HKM_LANGUAGE_PACK),
    'parent_item_colon' => '',
    'menu_name' => __('Tool List', HKM_LANGUAGE_PACK));
// to learn more
// http://justintadlock.com/archives/2010/04/29/custom-post-types-in-wordpress
$args = array(
    'labels' => $labels,
    'description' => __('Manage the Hong Kong bars nad pubs in the backend system.'),
    'public' => true, 'publicly_queryable' => true, 'show_ui' => true, 'show_in_menu' => true,
    'query_var' => true, 'rewrite' => true, 'capability_type' => 'post',
    'has_archive' => true, 'hierarchical' => false, 'menu_position' => null,
    'supports' => array('title', 'author'), 'menu_icon' => HKM_ART_PATH . 'briefcase.png',);
register_post_type(HKM_TOOLS, $args);
?>