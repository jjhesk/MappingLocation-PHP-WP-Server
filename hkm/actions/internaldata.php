<?php

function get_system_time() {
    date_default_timezone_set('Asia/Hong_Kong');
    return date("F j, Y, g:i a");
}

function get_system_header($template) {
    $user = wp_get_current_user();
    if ($user -> exists()) {
        // to show the object of this user
        //   debugoc::logarray('e %s', $user);
        $name = $user -> data -> display_name;
        $r = $user -> roles;
        return sprintf($template, $name, $r[0], get_system_time());
    } else {
        return "Please make sure you screen size is 1024x800";
    }

}

function system_message_for_header() {
    return get_system_header("Welcome, %s, Your current role is %s and the system is now %s");
}
?>