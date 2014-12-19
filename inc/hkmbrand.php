<?php
/**!
* Initializes the HKM BRANDING PANEL OPTIONS FRONT END
*
* Author: HESKEYO KAM
* Copyright: © 2011
* {@link HTTP://hkmdev.wordpress.com}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package HKM BRANDING PANEL
* @since 1.0
*
*/
/*
 * \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
 *  require(HKM_Classy_Options_Framework);
 * \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
 * 
 */

//require( get_template_directory() . '/hkm/function/hkmbackend/core.php');
add_action('init', 'hkmbranding_init_options');
function hkmbranding_init_options() {

global $hkmbranding_options, $hkm_hud, $ec_themename, $ec_themenamefull;
//$ec_themenamefull.
$hkm_hud="hkmbrandin";
$hkmbranding_options = new ClassyOptions('hkmbranding', "reBrand");
$terms2 = get_terms('category', 'hide_empty=0');
    $blogoptions = array();                                  
    $blogoptions['all'] = "All";
    foreach($terms2 as $term){
       $blogoptions[$term->slug] = $term->name;
    }
$hkmbranding_options
    ->section("info")
        ->info("<h1>Branding CMS</h1><p>This is the setting panel for Wordpress 3.5 - HKM United Development 2012. Branding CMS has been a great tool for all user to customize your backend elements and styles within their finger tips. We recommend not to resell this. </p><p>  這是設置面板中的WordPress3.5 - HKM聯合發展2012。 品牌CMS是一個偉大的工具，為所有用戶自定義您的後端元素和風格，在他們的手指尖。我們建議不得轉售。</p>")
    ->section("Admin Panel Settings")
        ->open_outersection()
            ->upload($hkm_hud."_ele1", "Change admin bar logo 220x100")
            ->text($hkm_hud."_ele2", "Change admin bar logo link")
            ->upload($hkm_hud."_ele3", "Custom header image")
        ->close_outersection()
        ->subsection("Elements to Hide")
            ->checkbox($hkm_hud."_ele4_toggle","Hide WordPress logo", array('default' => true))
            ->checkbox($hkm_hud."_ele5_toggle","Hide WordPress top bar dropdown menus", array('default' => true))
            ->checkbox($hkm_hud."_ele6_toggle","Hide admin bar update notifications", array('default' => true))
            ->checkbox($hkm_hud."_ele7_toggle","Hide WordPress update notification bar", array('default' => true))
            ->checkbox($hkm_hud."_ele8_toggle","Hide Screen Options menu", array('default' => true))
            ->checkbox($hkm_hud."_ele9_toggle","Hide Help menu", array('default' => true))
            ->checkbox($hkm_hud."_ele10_toggle","Hide Favorite Actions", array('default' => true))
            ->text($hkm_hud."_ele11","Change Howdy text")
            ->text($hkm_hud."_ele12_","Change Log out text")
            ->checkbox($hkm_hud."_ele13_toggle","Remove \"Edit My Profile\" option from dropdown menu", array('default' => true))
            ->checkbox($hkm_hud."_ele14_toggle","Log out only", array('default' => false))
       ->subsection_end()
       ->subsection("Admin Footer")
            ->checkbox($hkm_hud."_af1_toggle", "Hide footer text", array('default' => true))
            ->text($hkm_hud."_af2", "Change footer text")
            ->checkbox($hkm_hud."_af3_toggle", "Hide version text",array('default' => false))
            ->text($hkm_hud."_af4", "Change version text")
        ->subsection_end()
     ->section("Dashboard")
         ->open_outersection("Static Banner")
            ->upload($hkm_hud."_dash1_img", "Upload an image for the Dashboard 600x400 px")
            ->checkbox($hkm_hud."_dash2_toggle","Hide Dashboard heading icon", array('default' => true))
            ->text($hkm_hud."_dash3", "Change Dashboard heading text")
            ->text($hkm_hud."_dash4", "Add custom Dashboard content (text or HTML content)")
         ->close_outersection()
         ->subsection("Widgets Options")
                ->info("Info: These settings override settings in Screen options on Dashboard page.")
                ->checkbox($hkm_hud."_w1_toggle", "Hide \"Welcome\" WordPress Message", array('default' => true))
                ->checkbox($hkm_hud."_w2_toggle", "Hide \"Recent Comments\"", array('default' => true))
                ->checkbox($hkm_hud."_w3_toggle", "Hide \"Incoming Links\"", array('default' => true))
                ->checkbox($hkm_hud."_w4_toggle", "Hide \"Plugins\"", array('default' => true))
                ->checkbox($hkm_hud."_w5_toggle", "Hide \"Quick Press\"", array('default' => true))
                ->checkbox($hkm_hud."_w6_toggle", "Hide \"Right Now\"", array('default' => true))
                ->checkbox($hkm_hud."_w7_toggle", "Hide \"Recent Drafts\"", array('default' => true))
                ->checkbox($hkm_hud."_w8_toggle", "Hide primary widget area", array('default' => true))
                ->checkbox($hkm_hud."_w9_toggle", "Hide secondary widget area", array('default' => true))
         ->subsection_end()
     ->section("Login")
         ->open_outersection()
         ->text($hkm_hud."_login1", "Change back to blog text")
         ->upload($hkm_hud."_dash2_img", "Image for the login header, or a link of the image file. (Image can be of any size and type.)")
         ->close_outersection()
         ->subsection("login background image")
         ->upload($hkm_hud."_dashbg_img", "Image for the background of the login screen, or a link of the image file")
         ->text($hkm_hud."_dashbg_config_w", "The width of image", array('default'=>'2000'))
         ->text($hkm_hud."_dashbg_config_h", "The height of image", array('default'=>'1690'))
         ->checkbox($hkm_hud."_dashbg_config_fitscn_toggle", "Fit to the screen 100%", array('default' => true))
         ->subsection_end()
         ->subsection("login links")
         ->text($hkm_hud."_login3", "Change hyperlink on Login image (For blog URL use %BLOG%)")
         ->subsection_end()
         ->subsection("others")
             ->checkbox($hkm_hud."_login4_toggle", "Hide Login header image", array('default' => false))
             ->checkbox($hkm_hud."_login5_toggle", "Round box corners", array('default' => false))
         ->subsection_end()
     ->section("CMS stylings")
          ->info("<p>This is the place where you can pick and choose your admin panel styling and making it like a OEM.</p>")
         ->select($hkm_hud."_build_in_css", "Select a built in Admin Theme",  array( 'options' => hkmBrandEXE::get_list_css() ) )
         ->textarea($hkm_hud."_oem_css", "Parse your CSS scripts in here...")
         ->textarea($hkm_hud."_oem_jq", "Enter your JQuery or JS in here...")
     ->section("Data I/O")
        ->open_outersection()
            ->export("Hard Code Export")
            ->import("Hard Code Import")
        ->close_outersection()
;
}

?>