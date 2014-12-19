<?php

/*

register_taxonomy(
    "linkrarea",
    array(HKMBASEMAP),array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'area' )
));*/

add_action('init', 'custom_taxonomy_add_on', 0);
function custom_taxonomy_add_on()
{
    register_taxonomy("category", array("page"), array(
        'hierarchical' => true,
        //  'labels' => $labels,
        'show_ui' => true,
        'show_tagcloud' => false,
        'query_var' => true,
        'rewrite' => array('slug' => 'area')
    ));
}

?>