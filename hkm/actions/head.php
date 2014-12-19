<?php
// Prevent loading this file directly
defined('ABSPATH') || exit ;

add_action('response_post', 'response_post_content');

/**
 * Index content FROM THE SINGLE.PHP
 *
 * @since 1.0
 */
function response_post_content()
{

    global $options, $ec_themeslug, $post, $sidebar, $content_grid; // call globals

    if (is_single()) {
        $class = 'single';
    } elseif (is_archive()) {
        $class = 'archive';
    } else {
        $class = '';
    }

   // debugoc::upload_bmap_log($class, 49023);
}


add_action('resoc_oc_header', 'see_oc_header');

function see_oc_header()
{
    // if (is_user_logged_in())
    //     echo oc_header();
    echo oc_header();
}

function oc_get_home_url()
{
    if (oc_db_account::has_role('cp'))
        return get_permalink(LAND_CP);
    if (oc_db_account::has_role('ocstaff') || oc_db_account::has_role('administrator'))
        return get_permalink(LAND_STAFF);
    if (oc_db_account::has_role('cr'))
        return get_permalink(LAND_CR);
}

function oc_header()
{
    global $options, $ec_themeslug;
    $html = "";
    $logo_row = $options->get($ec_themeslug . '_logo');
    //print_r($logo_row);
    $tpl = '<div class="navbar navbar-fixed-top"><div class="navbar-inner"><div class="oc_container_header">%s</div></div></div>';
    $tpl2 = '<div class="brand logo"><img src="%s"/></div><div class="systemmessage">%s</div>';
    $img = sprintf($tpl2, $logo_row['url'], system_message_for_header());
    if (is_page(555)) {
        ob_start();
        echo '<div class="nav-collapse collapse" id="main-menu">';
        wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'nav', 'walker' => new OC_Walker_Nav_Menu(),));
        // wp_nav_menu(array('theme_location' => 'rightmenu', 'menu_class' => 'nav-menu-right', 'walker' => new OC_Walker_Nav_Menu(), ));
        echo '</div>';

        $html = ob_get_clean();

    }
    //debugoc::logarray('e %s',$logo_row);
    if (is_page(180)) {
        //debugoc::logarray('e %s',$logo_row);
        $html = ocmodel::get_tpl('menu', 'newcompany');
    }
    if (is_page(161)) {
        //debugoc::logarray('e %s',$logo_row);
        $html = ocmodel::get_tpl('menu', 'newcr');
    }
    if (is_page(194)) {
        //debugoc::logarray('e %s',$logo_row);
        $html = ocmodel::get_tpl('menu', 'newcp');
    }
    if (is_page_template('mock-templates/project_overview_interface.php')) {
        //debugoc::logarray('e %s',$logo_row);
        $html = ocmodel::get_tpl('menu', 'staff');
    }
    if (is_page(217) || is_page(309)) {
        //debugoc::logarray('e %s',$logo_row);
        $html = ocmodel::get_tpl('menu', 'cp');
    }
    return sprintf($tpl, $img . $html);
}

?>