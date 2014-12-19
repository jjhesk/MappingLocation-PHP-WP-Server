<?php
// Prevent loading this file directly
defined('ABSPATH') || exit ;
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header();
/*if (is_user_logged_in())
    do_action('afterlogin_page');
else {
    do_action('render_home_page_section');
}*/
//do_action('afterlogin_page');
//do_action('render_home_page_section');
?>
    <div id="primary" class="site-content nine columns">
        <div id="content" role="main">
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('content', 'page'); ?>
                <?php comments_template('', true); ?>
            <?php endwhile; // end of the loop. ?>
        </div>
        <!-- #content -->
    </div><!-- #primary --><?php
get_sidebar();
/*

global $wpdb, $wp_query, $wp_rewrite;

echo "<pre>";
print_r($wp_query);
print_r($wp_rewrite);
echo "</pre>";

*/
get_footer();
?>