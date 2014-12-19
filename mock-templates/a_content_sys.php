<?php

/**
 HKM development All Rights Reserved
 Template Name: OC Login
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.0
 */
 get_header();
// global $post;

?> 
 <div id="primary" class="site-content">
	<div id="content" role="main">
		<?php
		if (have_posts()) :
			while (have_posts()) : the_post();
				echo "yes post";
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) );
				debugoc::logarray("e %s", $post);
			endwhile;
			twentytwelve_content_nav('nav-below');
			edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' );
		else :
			echo "no post";
			echo ocmodel::get_tpl('error', 'nopost');
		endif; // end have_posts() check
		  wp_reset_query();
		?>
	</div><!-- #content -->
</div><!-- #primary -->
<?php
get_footer();

?>

