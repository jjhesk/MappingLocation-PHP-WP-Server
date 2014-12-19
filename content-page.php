<?php
// Prevent loading this file directly
defined('ABSPATH') || exit ;
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h1><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>
    <!-- .entry-content -->
    <footer class="entry-meta">
        <?php edit_post_link(__('Modify System', 'twentytwelve'), '<span class="edit-link">', '</span>'); ?>
    </footer>
    <!-- .entry-meta -->
</article><!-- #post -->
