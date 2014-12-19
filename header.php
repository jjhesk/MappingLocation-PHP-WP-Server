<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width"/>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
    <![endif]-->
    <?php wp_head();
    //'items_wrap'=> '<ul id="%1$s rr" class="%2$s">%3$s</ul>',
    ?>
</head>
<body <?php body_class(); ?>>
<?php


 do_action('resoc_oc_header');
?>
<!--<nav class="menu_control"><ul class="rr">
         <li><a href="#">home</a></li>
         <li class="current"><a href="#">profile</a></li>
         <li><a href="#">project</a></li>
         <li><a href="#">setting</a></li>
 </ul></nav>-->
<div id="page" class="container white">
    <!-- parts/header_site.php -->
    <div id="main" class="wrapper paper">