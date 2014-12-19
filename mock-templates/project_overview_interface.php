<?php

// Prevent loading this file directly
defined('ABSPATH') || exit ;
/**
 * Created by PhpStorm.
 * User: Hesk
 * Date: 14年5月15日
 * Time: 上午10:48
 *
 * Template Name: Project OverView
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header();
?>
    <div id="primary" class="site-content nine columns">
        <!--<div id="content" role="main">
            <?php /*
            while (have_posts()) : the_post();
                 get_template_part('content', 'page');
               comments_template('', true);
            endwhile;
            */
        ?>
        </div>-->
        <div id="content" role="main"><?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1>Login for 1Call Staff</h1>
                    </header>
                    <div class="entry-content"><?php the_content(); ?></div>
                    <footer class="entry-meta">
                        <?php edit_post_link(__('Modify System', 'twentytwelve'), '<span class="edit-link">', '</span>'); ?>
                    </footer>
                </article> <?php endwhile; // end of the loop. ?>
        </div>
        <!-- #content -->
    </div><!-- #primary --><?php
get_footer();
?>