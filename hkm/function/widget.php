<?php

/**
 * WordPress Widgets start right here.
 */
function responsive_widgets_init() {

	register_sidebar(array('name' => __('Copyright statements', 'hkm'), 'description' => __('This sider bar is for ADVERTISEMENT only.. ', 'responsive'), 'id' => 'fmega', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '', 'after_title' => '', ));

	/*
	 register_sidebar(array(
	 'name' => __('Main Sidebar', 'responsive'),
	 'description' => __('Area One - sidebar.php', 'responsive'),
	 'id' => 'main-sidebar',
	 'before_title' => '<div class="widget-title">',
	 'after_title' => '</div>',
	 'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
	 'after_widget' => '</div>'
	 ));

	 register_sidebar(array(
	 'name' => __('Right Sidebar', 'responsive'),
	 'description' => __('Area Two - sidebar-right.php', 'responsive'),
	 'id' => 'right-sidebar',
	 'before_title' => '<div class="widget-title">',
	 'after_title' => '</div>',
	 'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
	 'after_widget' => '</div>'
	 ));

	 register_sidebar(array(
	 'name' => __('Left Sidebar', 'responsive'),
	 'description' => __('Area Three - sidebar-left.php', 'responsive'),
	 'id' => 'left-sidebar',
	 'before_title' => '<div class="widget-title">',
	 'after_title' => '</div>',
	 'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
	 'after_widget' => '</div>'
	 ));

	 register_sidebar(array(
	 'name' => __('Left Sidebar Half Page', 'responsive'),
	 'description' => __('Area Four - sidebar-left-half.php', 'responsive'),
	 'id' => 'left-sidebar-half',
	 'before_title' => '<div class="widget-title">',
	 'after_title' => '</div>',
	 'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
	 'after_widget' => '</div>'
	 ));

	 register_sidebar(array(
	 'name' => __('Right Sidebar Half Page', 'responsive'),
	 'description' => __('Area Five - sidebar-right-half.php', 'responsive'),
	 'id' => 'right-sidebar-half',
	 'before_title' => '<div class="widget-title">',
	 'after_title' => '</div>',
	 'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
	 'after_widget' => '</div>'
	 ));

	 register_sidebar(array(
	 'name' => __('Home Widget 1', 'responsive'),
	 'description' => __('Area Six - sidebar-home.php', 'responsive'),
	 'id' => 'home-widget-1',
	 'before_title' => '<div id="widget-title-one" class="widget-title-home"><h3>',
	 'after_title' => '</h3></div>',
	 'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
	 'after_widget' => '</div>'
	 ));

	 register_sidebar(array(
	 'name' => __('Home Widget 2', 'responsive'),
	 'description' => __('Area Seven - sidebar-home.php', 'responsive'),
	 'id' => 'home-widget-2',
	 'before_title' => '<div id="widget-title-two" class="widget-title-home"><h3>',
	 'after_title' => '</h3></div>',
	 'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
	 'after_widget' => '</div>'
	 ));

	 register_sidebar(array(
	 'name' => __('Home Widget 3', 'responsive'),
	 'description' => __('Area Eight - sidebar-home.php', 'responsive'),
	 'id' => 'home-widget-3',
	 'before_title' => '<div id="widget-title-three" class="widget-title-home"><h3>',
	 'after_title' => '</h3></div>',
	 'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
	 'after_widget' => '</div>'
	 ));

	 register_sidebar(array(
	 'name' => __('Gallery Sidebar', 'responsive'),
	 'description' => __('Area Nine - sidebar-gallery.php', 'responsive'),
	 'id' => 'gallery-widget',
	 'before_title' => '<div class="widget-title">',
	 'after_title' => '</div>',
	 'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
	 'after_widget' => '</div>'
	 ));
	 register_sidebar(array(
	 'name' => __('Left Sidebar Half Page', 'responsive'),
	 'description' => __('Area Four - sidebar-left-half.php', 'responsive'),
	 'id' => 'left-sidebar-half',
	 'before_title' => '<div class="widget-title">',
	 'after_title' => '</div>',
	 'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
	 'after_widget' => '</div>'
	 ));*/
}

add_action('widgets_init', 'responsive_widgets_init');





//Add my comments. Shows user his last 5 comments
function dashboard_user_comments_widget_function() {
?><img width='100%' src='http://linker.imusictech.com/wp-content/themes/linkr/images/logo_600x200.png'/><?php;
}

function dashboard_user_add_comments_widget_function() {
	wp_add_dashboard_widget(
	'my_comments_user_dashboard_widget', 
	'WSM DASHBOARD', 
	'dashboard_user_comments_widget_function'
	);
}

add_action('wp_dashboard_setup', 'dashboard_user_add_comments_widget_function');



function example_dashboard_widget_function() {
// Display whatever it is you want to show
the_author_meta();
} 





// Create the function use in the action hook
function example_add_dashboard_widgets() {
wp_add_dashboard_widget('example_dashboard_widget', 'User Profile',    'example_dashboard_widget_function');
}
// Hoook into the 'wp_dashboard_setup' action to register our otherfunctions
add_action('wp_dashboard_setup', 'example_add_dashboard_widgets' );
//end

//bannerscript
function wpse_53035_script_enqueuer(){
    echo <<<HTML
    <script type="text/javascript">
    jQuery(document).ready( function($) {
        jQuery('<div style="width:100%;text-align:center;"><img src="http://wsm.imusictech.com/wp-content/uploads/2012/10/wsm01-banner.jpg"></div>').insertBefore('#dashboard-widgets');
    });     
    </script>
HTML;
}
add_action('admin_head-index.php', 'wpse_53035_script_enqueuer');




/*
 * Builds the Custom Dashboard Widget
 *
 */
// add_action('wp_dashboard_setup', 'wpse_46445_dashboard_widget');
function wpse_46445_dashboard_widget()
{
    $the_widget_title = 'Site Tutorials';
    wp_add_dashboard_widget('dashboard_tutorials_widget', $the_widget_title, 'wpse_46445_add_widget_content');
}

/*
 * Prints the Custom Dashboard Widget content
 *
 */
function wpse_46445_add_widget_content() 
{
    $tutorial_1 = wpse_46445_make_youtube_thumb_link(
        array(
            'id'=>'s-c_urzTWYQ', 
            'color'=>'#FF6645', 
            'title' => 'Video Tutorial', 
            'button' => 'Watch now'
        )
    );

    $tutorial_2 = wpse_46445_make_youtube_thumb_link(
        array(
            'id'=>'HIq9kkHbMCA', 
            'color'=>'#FF6645', 
            'title' => 'Tutorial em Vídeo', 
            'button' => 'Ver agora'
        )
    );

    $html = <<<HTML
    <h4 style="text-align:center">How to render videos for web using YouTube horsepower</h4>
    {$tutorial_1}
    <hr />
    <h4 style="text-align:center">Como renderizar para web videos usando o poder do YouTube</h4>
    {$tutorial_2}
HTML;

    echo $html;
}

/*
 * Makes a thumbnail with YouTube official image file 
 * the video links opens the video in the "watch_popup" mode (video fills full browser window)
 * 
 */
function wpse_46445_make_youtube_thumb_link($atts, $content = null) 
{
    $img   = "http://i3.ytimg.com/vi/{$atts['id']}/default.jpg";
    $yt    = "http://www.youtube.com/watch_popup?v={$atts['id']}";
    $color = ($atts['color'] && $atts['color'] != '') ? ';color:' . $atts['color'] : '';

    $html  = <<<HTML
        <div class="poptube" style="text-align:center;margin-bottom:40px">
        <h2 class="poptube" style="text-shadow:none;padding:0px{$color}">{$atts['title']}</h2>
        <a href="{$yt}" target="_blank"><img class="poptube" src="{$img}" style="margin-bottom:-19px"/></a><br />
        <a class="poptube button-secondary" href="{$yt}" target="_blank">{$atts['button']}</a></div>
HTML;

    return $html;
}