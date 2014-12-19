<?php

/**
 * HKM development All Rights Reserved
 * Template Name: PRINTING SINGLE
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.0
 */
//app_submission::graphic_print();
?>

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
?>
<?php

get_header('basemap');
if (isset($_POST['filename'])):
    ?>
    <table id="finalized_basemap_print">
        <tr>
            <td colspan="4">
                <img src="<?php echo HKM_IMG_PATH . "printing_logo.png"; ?>" width="198px">
            </td>
        </tr>
        <tr>
            <td colspan="4"><?php
                do_action('report_sketch_draw_head', $_POST['filename']);
                ?>
                <!-- <table id="map_header">
                     <tbody>
                     <tr>
                         <th>Project no.:</th>
                         <td>{{project_no}}</td>
                         <th>Location:</th>
                         <td>{{location}}</td>
                         <th>Survey Date:</th>
                         <td>{{survey_date}}</td>
                         <th>Scale:</th>
                         <td>{{scale}}__A3 1: 250</td>
                     </tr>
                     <tr>
                         <th>Name of CP:</th>
                         <td>{{cp_name}}</td>
                         <th>CP no.:</th>
                         <td>{{cp_no}}</td>
                         <th>Signature:</th>
                         <td>{{sign}}</td>
                     </tr>
                     </tbody>
                 </table>-->
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <div class="tablebox">
                    <img id="content_image"
                         src="<?php app_submission::path_print_file(); ?>"/>
                    <?php app_submission::print_legend(); ?>
                </div>
            </td>
        </tr>
    </table>
    <div id="actionbar">
        <?php global $mobileDetect;
        if (!$mobileDetect->isMobile()) {
            $var = get_permalink(419) . '?h=' . report_b::get_hash_by_filename($_POST['filename']); ?>
            <button class="button" id="printpage">print</button>
            <button class="button" id="get_image">generate a image</button>
            <button class="button" id="toggle_image">show/hide image</button>
        <a class="button" href="<?php echo $var; ?>">Reivew cable detection entries (form b)</a><?php
        }
        ?>
    </div>
    <!--    <div id="save_image_box" class="hidden">
            <div class="cover_to_show dark_alpha sticky_top_left_span">Right click to save the image</div>
            <div id="save_image_area"></div>
        </div>-->
<?php
else:
    ?><a href="<?php echo get_permalink(399); ?>">View Print List</a><?php
endif;

get_footer();
?>