<?php

function oc_register_table() {
    global $wpdb;
    $wpdb -> wptuts_activity_log = "{$wpdb->prefix}wptuts_activity_log";
    wptuts_create_tables();
}

function oc_install_db() {
  //  $sql_filename = 'install.sql';
  //  $sql_contents = file_get_contents($sql_filename);
  //  $result = mysql_query($sql_contents) or die('Database query failed: ' . mysql_error());
}

add_action('init', 'oc_register_table', 1);
add_action('switch_blog', 'oc_register_table');

function wptuts_create_tables() {
    // Code for creating a table goes here
}

// Create tables on plugin activation
//register_activation_hook(__FILE__, 'wptuts_create_tables');
?>