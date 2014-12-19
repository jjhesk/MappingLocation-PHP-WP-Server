<?php

/* THIS IS A STAND ALONE CODE AND IT CAN BE FREED MOVED , ALL FUNCTIOSN ARE GLOBALIZED */
// Exit if accessed directly
if (!defined('ABSPATH')) :
    exit;
endif;

if (!function_exists('get_menu_ressembled')) :

    /**
     * DEVELOPED BY HESKEMO 2012 - THIS SOFTWARE IS TO AIM FOR MAKING A MENU
     * width is array
     * height is a integer
     *
     * @category    helper
     * @link        www.hkmdev.wordpress.com
     * @param $width_list
     * @param $height
     * @param $id
     * @param $url
     * @param bool $print_out_li_elements
     * @param bool $vertical css + list HTML5 structure
     * @return bool|string
     */
    function get_menu_ressembled($width_list, $height, $id, $url, $print_out_li_elements = true, $vertical = false)
    {
        $w = 0;
        $total = count($width_list);
        if (!is_array($width_list)) {
            return false;
        }
        $p = 0;
        $display_position = 0;
        $html_content = '<style>';
        for ($i = 0; $i < $total; $i++) {
            if (is_array($width_list)) {
                $location = $i - 1;
                if ($location >= 0) {
                    $p += intval($width_list[$location]);
                    $display_position = $p;
                }
            } else {
                $display_position = $w * $i;
            }
            $on_element = "." . $id . ">li:nth-child(" . intval($i + 1) . ")";
            $html_content .= $on_element . "{width:" . $width_list[$i] . "px;background-position: -" . $display_position . "px 0; }";
            $html_content .= $on_element . ":hover{background-position: -" . $display_position . "px -" . $height . "px; }";
            $html_content .= $on_element . ":active{background-position: -" . $display_position . "px -";
            $html_content .= 2 * $height . "px;}" . $on_element . ".active," . $on_element . ".active,";
            $html_content .= $on_element . ".current_page_item," . $on_element . ".current_main_bar{background-position: -" . $display_position . "px -";
            $html_content .= 3 * $height . "px;}";
            //$html_content .=$height*2."px;}".$id.$i.".active,#".$id.$i.".active,#";
            //$html_content .=$id.$i.".current_page_item{background-position: -".$i*$w."px -".$height*2."px;}";
        }
        if ($vertical) {
            $extra = 'clear:both';
        } else {
            $extra = 'float:left';
        }
        $html_content .= '.' . $id . '>li{margin: 0;padding: 0;height:' . $height . 'px;background-image:url(' . $url . ');font-size:0;list-style:none;' . $extra . ';}';
        $html_content .= '.' . $id . ' a{margin: 0;font-size:0px; padding:0;display:block;height:' . $height . 'px;width:100%;}';
        $html_content .= '.' . $id . '{position:absolute;top:100px;left:10px;z-index:10;}';
        $html_content .= '</style>';
        if ($print_out_li_elements) {
            $html_content .= "<ul id='list_" . $id . "' class='" . $id . "'>";
            for ($i = 0; $i < $total; $i++) {
                $html_content .= '<li><a></a></li>';
            }
            $html_content .= "</ul>";
        }
        return $html_content;
    }

endif;
/*global agent detention for mobile phones*/
if (!function_exists('detect_mobile')) :
    function detect_mobile()
    {
        if (preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|playbook|sagem|sharp|sie-|silk|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']))
            return true;
        else
            return false;
    }
endif;
/*=======================================================================
 * Forgive me for the beginner regex question but I was hoping that someone could show me how to get the youtube id out of a url regardless of what other GET variables are in the URL.
 * Use this video for example:
 * http://www.youtube.com/watch?v=C4kxS1ksqtw&feature=related
 * so between v= and before the next &
 *=======================================================================*/
if (!function_exists('parse_youtube_id')) :
    function parse_youtube_id($url)
    {
        //$url = "http://www.youtube.com/watch?v=C4kxS1ksqtw&feature=relate";
        $my_array_of_vars = array();
        parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
        return $my_array_of_vars['v'];
        // Output: C4kxS1ksqtw
    }
endif;
/*====================================
 * @source: http://www.456bereastreet.com/archive/201010/how_to_make_wordpress_urls_root_relative/
 * WordPress, on the other hand, seems to like absolute URLs for some reason. To clean this up a bit I have the following simple function in my functions.php file to strip the protocol and domain name from URL strings:
 * ===================================*/
if (!function_exists('make_href_root_relative')) :
    function make_href_root_relative($input)
    {
        return preg_replace('!http(s)?://' . $_SERVER['SERVER_NAME'] . '/!', '/', $input);
    }
endif;
/*=======================================================================
 TAXONOMY WALKER HKM MOD. DEVELOPMENT - HKM HESKEMO
 *=======================================================================*/
if (!function_exists('custom_taxonomy_walker')) :
    //Walker function
    function custom_taxonomy_walker($taxonomy, $parent = 0, $hide_empty = true)
    {
        $terms = get_terms($taxonomy, array('parent' => $parent, 'hide_empty' => $hide_empty));
        //If there are terms, start displaying
        if (count($terms) > 0) {
            //Displaying as a list
            $out = "<ul class=\"" . $taxonomy . "\">";
            //Cycle though the terms
            foreach ($terms as $term) {
                //Secret sauce.  Function calls itself to display child elements, if any
                $out .= "<li class=\"" . $term->slug . "\"><a>" . $term->name . custom_taxonomy_walker($taxonomy, $term->term_id) . "</a></li>";
            }
            $out .= "</ul>";
            return $out;
        }
        return;
    }

endif;
/*=======================================================================
 TAXONOMY WALKER HKM MOD. DEVELOPMENT - HKM HESKEMO
 *=======================================================================*/
if (!function_exists('custom_taxonomy_walker_level_1')) :
    //Walker function
    function custom_taxonomy_walker_level_1($taxonomy, $parent = 0, $hide_empty = true)
    {
        $terms = get_terms($taxonomy, array('parent' => $parent, 'hide_empty' => $hide_empty));
        //If there are terms, start displaying
        if (count($terms) > 0) {
            //Displaying as a list
            $out = "<ul class=\"" . $taxonomy . "\">";
            //Cycle though the terms
            foreach ($terms as $term) {
                //Secret sauce.  Function calls itself to display child elements, if any
                $out .= "<li class=\"" . $term->slug . "\"><a>" . $term->name . custom_taxonomy_walker($taxonomy, $term->term_id) . "</a></li>";
            }
            $out .= "</ul>";
            return $out;
        }
        return;
    }

endif;

/*=======================================================================
 * TAXONOMY CROSS POST TYPE WALKER HKM HESKEMO MOD. DEVELOPMENT
 *=======================================================================*/
if (!function_exists('custom_taxonomy_walker_level_2')) :
    //Walker function
    function custom_taxonomy_walker_level_2($taxonomy, $post_type, $parent = 0, $hideempty = false)
    {
        if (empty($post_type) || empty($taxonomy))
            return false;
        $out = "";
        $terms = get_terms($taxonomy, array('parent' => $parent, 'hide_empty' => $hideempty));
        //If there are terms, start displaying
        if (count($terms) > 0) {
            foreach ($terms as $term) {
                //Displaying as a list
                //echo "<br>this is ".$term -> slug;
                $out .= "<div class=\"tag slug-" . $term->slug . "\"></div>";
                $out .= "<ul class=\"" . $taxonomy . " slug-" . $term->slug . "\">";
                //Cycle though the terms
                $args = array('tax_query' => array('relation' => 'AND', array('taxonomy' => $taxonomy, 'field' => 'slug', 'terms' => array($term->slug))), 'post_type' => $post_type, 'posts_per_page' => '-1', 'status' => 'published', 'orderby' => 'date', 'order' => 'DESC',);
                //global $taxonomy_quer;
                $taxonomy_quer = new WP_Query($args);
                if ($taxonomy_quer->have_posts()) :
                    while ($taxonomy_quer->have_posts()) : $taxonomy_quer->the_post();
                        //Secret sauce.  Function calls itself to display child elements, if any post_permalink get_permalink get_the_title
                        $out .= "<li class=\"SingaID-" . $taxonomy_quer->post->ID . "\"><a href=\"" . post_permalink() . "\" >";
                        $out .= get_post_meta($taxonomy_quer->post->ID, 'ss_star_name', TRUE) . "</a></li>";
                    endwhile;
                endif;
                wp_reset_postdata();
                $out .= "</ul>";
            }
            return $out;
        }
        return false;
    }

endif;

/* no auto p short code on the editor screen*/
function my_formatter($content)
{
    $new_content = '';
    $pattern_full = '{(\[raw\].*?\[/raw\])}is';
    $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
    $pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

    foreach ($pieces as $piece) {
        if (preg_match($pattern_contents, $piece, $matches)) {
            $new_content .= $matches[1];
        } else {
            $new_content .= wptexturize(wpautop($piece));
        }
    }

    return $new_content;
}

remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');
add_filter('the_content', 'my_formatter', 99);
if (!function_exists('template_part_shortcode')) :
    function template_part_shortcode($atts)
    {
        extract(shortcode_atts(array('part' => '',), $atts));
        $file = locate_template('parts/' . $part . '.php');
        ob_start();
        include $file;
        $template = ob_get_contents();
        ob_end_clean();
        return $template;
    }
    add_shortcode('template', 'template_part_shortcode');
endif;

?>