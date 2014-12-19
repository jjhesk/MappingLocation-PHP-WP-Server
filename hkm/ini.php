<?php
/**
 * HKM CMS CORE MANAGEMENT INIT
 *
 * Author: HESKEYO KAM
 * Copyright: &#169; 2011
 * {@link http://hkmdev.wordpress.com/ HKM LLC}
 *
 * Released under the terms of the GNU General Public License.
 * You should have received a copy of the GNU General Public License,
 * along with this software. In the main directory, see: /licensing/
 * If not, see: {@link http://www.gnu.org/licenses/}.
 *
 * @package Core
 * @since 1.4
 */
define("HKM_COM", "occompany");
define("HKM_JOB", "oc-job");
define("HKM_TOOLS", "oc-tools");
define("HKM_REPORT", "reports");
define("HKMBASEMAP", "cp-map");


define("DB_PENDING", "onecallapp_pending_data");
define("DB_COM", "onecallapp_company");
define("DB_JOB", "onecallapp_job");
define("DB_PROJECT", "onecallapp_project");
define("DB_PROJECTRETURN", "onecallapp_project_return");
define("DB_BOARDCAST", "onecallapp_operation_market");
define("DB_ORDER", "onecallapp_cpserviceorders");
define("DB_TOOL", "onecallapp_toolings");
define("DB_BASEMAP", "onecallapp_basemap");
define("DB_DISTRICT", "onecallapp_district");
define("EXIMAGE", get_template_directory_uri() . "/hkm/art/");


$uploads = wp_upload_dir();
//developed by Heskeyo Kam
//2013 @ imusictech
define("OC_BR_UPLOADPATH", $uploads['basedir'] . DIRECTORY_SEPARATOR . 'br' . DIRECTORY_SEPARATOR);
define("OC_CERT_UPLOADPATH", $uploads['basedir'] . DIRECTORY_SEPARATOR . 'certification' . DIRECTORY_SEPARATOR);
define("OC_ORDER_PLAN_UPLOADPATH", $uploads['basedir'] . DIRECTORY_SEPARATOR . 'plan' . DIRECTORY_SEPARATOR);
define("OC_IDPIC_UPLOADPATH", $uploads['basedir'] . DIRECTORY_SEPARATOR . 'profileid' . DIRECTORY_SEPARATOR);
define("OC_RETURNBASEMAP_UPLOADPATH", $uploads['basedir'] . DIRECTORY_SEPARATOR . 'returnbasemap' . DIRECTORY_SEPARATOR);
define("SINGLE_PATH", STYLESHEETPATH . '/single/');
define("METAPREFIX", 'odk_');
/**
 * implementation of onecall basemap system
 */
if (!defined("PATH_IMAGE_LEGEND"))
    define("PATH_IMAGE_LEGEND", get_template_directory_uri() . "/images/legend_webuse/");

if (!defined("PATH_OC_IMAGE_PROCESS"))
    define("PATH_OC_IMAGE_PROCESS", get_template_directory_uri() . "/images/oc_temp_process/");

if (!defined("PATH_PRINT_OC_BSMAP"))
    define("PATH_PRINT_OC_BSMAP", get_template_directory_uri() . "/oc_print_basemap/");

if (!defined("OC_PRINT_SINGLE_BASEMAP"))
    define("OC_PRINT_SINGLE_BASEMAP", 396);
if (!defined("OC_GUI_PRINT")) {
    define("OC_GUI_PRINT", 399);
}
if (!defined("OC_UPLOAD_KEY")) {
    define("OC_UPLOAD_KEY", "#&47sds789fs7d");
}
define("HKM_LANGUAGE_PACK", "hkm_data_lan_pack");
define("HKM_LIBJS", get_template_directory_uri() . "/js/");
define("LIBJS_ADMIN_MODEL", get_template_directory_uri() . "/js/adminmodel/");
define("LIBJS_ADMIN", get_template_directory_uri() . "/js/admin/");
define("HKM_LIBCSS", get_template_directory_uri() . "/css/");
define("HKM_LIBFONTS", get_template_directory_uri() . "/fonts/");
define("HKM_IMG_PATH", get_template_directory_uri() . "/images/");
define("HKM_ART_PATH", get_template_directory_uri() . "/hkm/art/");
spl_autoload_register(function ($className) {

    if (!class_exists($className) && $className == 'Mustache_Engine') {
        require_once(get_template_directory() . '/thirdparty/Mustache/Autoloader.php');
        Mustache_Autoloader::register();
    }

    $possibilities = array('smalllib', 'cms2', 'db', 'autoload-class', 'gfclass', 'hkmdebug');
    foreach ($possibilities as $folder) {
        $hkm_file = get_template_directory() . DIRECTORY_SEPARATOR . 'hkm' . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $className . '.php';
        if (file_exists($hkm_file)) {
            require_once($hkm_file);
            return true;
        }
    }
    return false;
});
if (WP_DEBUG_LOG && WP_DEBUG) {
    ini_set('error_log', WP_CONTENT_DIR . '/logs/' . sanitize_title(get_bloginfo()) . '-' . date('Ymd') . '.log');
}
$define_pages = array(
    "LAND_ADMIN" => 162,
    "LAND_STAFF" => 250,
    "LAND_CP" => 217,
    "LAND_CR" => 2,
);
$define_pages_keep_editor = array(
    "PROFILE_PG" => 2,
    "HOME_PG" => 14,
    "PROJECT" => 17,
    "ADDJOB" => 21,
    "LAND_PUBLIC" => 14
);
/*$define_types = array(
    "HKM_JOB" => "oc-job",
    "HKM_TOOLS" => "oc-tools",
    "HKM_REPORT" => "oc-questionaire"
);*/
$define_interface = array(
//the prefix for some functions
    "HKMBACKEND_PATH" => get_template_directory_uri() . "/hkm/function/hkmbackend/",
    "DATATYPE_PREFIX" => "hkm_",
    "API_OC_CORE" => site_url() . '/api/staffcontrol/',
    "HKMCLASS" => get_template_directory() . DIRECTORY_SEPARATOR . 'hkm/class/'
);
$define_constant_values = array_merge($define_pages, $define_interface, $define_pages_keep_editor);
foreach ($define_constant_values as $constant => $value) {
    if (!defined($constant)) {
        define($constant, $value);
    }
}
unset($define_constant_values);
/**
 * Define global theme functions.
 */
$ec_themename = 'OCapp';
$ec_themenamefull = 'onecallapp System';
$ec_themeslug = 'oc';
$ec_root = get_template_directory_uri();
$ec_pagedocs = 'http://cyberchimps.com/question/using-the-eclipse-page-options/';
$ec_sliderdocs = 'http://cyberchimps.com/question/using-the-eclipse-feature-slider/';

require_once get_template_directory() . '/hkm/classy-options/classy-options-framework/classy-options-framework.php';
require_once get_template_directory() . '/inc/classyoptions.php';
require_once get_template_directory() . '/inc/hkmbrand.php';
require_once get_template_directory() . "/hkm/rebrand/hkmBrandEXE.php";
require_once get_template_directory() . "/hkm/function/common_functions.php";
include_once(ABSPATH . 'wp-admin/includes/plugin.php');
$setup_feature_images_metabox = array();
if (count($setup_feature_images_metabox) > 0) {
    foreach ($setup_feature_images_metabox as $k => $value) {
        //    new hkm_feat_img_customization($value);
    }
}
/*
add_action('init', 'my_rewrite');
function my_rewrite() {
    global $wp_rewrite;
    $wp_rewrite->add_permastruct('typename', 'typename/%year%/%postname%/', true, 1);
    add_rewrite_rule('typename/([0-9]{4})/(.+)/?$', 'index.php?typename=$matches[2]', 'top');
    $wp_rewrite->flush_rules(); // !!!
}*/

/**
 * start implementing everything in here
 */
//initialization of rebrand panel
$hkmbrand = new hkmBrandEXE();
$admin_action_bar = new adminbar();
$admin_menu = new adminmenu();
$adminajax = new adminajax();
$adminajax->reg_admin_ajax_control(array(
    /**
     * class name = (
     * action name => class method,
     * action name => class method
     * )
     */
    "oc_project" => array(
        "search" => "search"
    ),
    "oc_db_order" => array(
        "get_order_data" => "ajax_get_order_data_package",
    ),
    "ocmodel" => array(
        "list_results_applicants" => "ajax_get_listed_applicant_job_cp",
        "boardcast_cp" => "ajax_action_boardcast",
        "cp_response_action" => "ajax_cp_resp_act",
        "cp_job_offer" => "ajax_notify_job_offer",
        "assign_job_to_cp" => "ajax_notify_job_offer_and_complete"
    ),
    "oc_db_pending" => array(
        "action_taken_company" => "actiontakencompany",
        "action_taken_cp" => "actiontakencp",
        "action_taken_cr" => "actiontakencr"
    )
    /* "heatbeat" => array(
         "ocmodel" => true
     )*/
));
$disablewy = new disable_rich_text_editor();
$json_extend = new json_api_extend();
$script = new ocscript();
$report = new report_b();
$disablewy->makeDisabled(array_values($define_pages));
//extension for gform
//GWPreviewConfirmation::create_lead();
//extension for json-api initialization
if (is_plugin_active('gravityforms/gravityforms.php')) {
    define("GF_CR_REG_FORM", 15);
    define("gf_cr_login_name", 3);
    define("gf_cr_login_email", 13);
    define("gf_bind_cr_user_id", 16);
    define("gf_cr_person_name", 5);
    define("gf_cr_person_phone", 10);
    define("gf_cr_company", 14);

    define("GF_CP_REG_FORM", 7);
    define("gf_cp_title", 13);
    define("gf_cp_login_name", 4);
    define("gf_cp_login_email", 10);
    define("gf_cp_name_first", 2);
    define("gf_cp_name_last", 3);
    define("gf_cp_name_chn", 5);
    define("gf_cp_address", 7);
    define("gf_cp_company", 6);
    define("gf_cp_contact_1st", 8);
    define("gf_cp_contact_2nd", 9);
    define("gf_cp_exp", 12);
    define("gf_cp_license_no", 11);
    define("gf_cp_attachments", 21);
    define("gf_cp_photo", 25);

    define("GF_REP_REGISTRATION_FORM", 8);
    define("fieldid_nicename", 5);
    define("fieldid_displayname", 6);
    define("fieldid_useremail", 4);
    define("fieldid_phonenumber", 2);
    define("fieldid_name", 1);
    define("fieldid_companyname", 7);


    define("GF_NEW_COM_FORM", 13);
    define("nc_comfullname", 3);
    define("nc_conshortname", 4);
    define("nc_contactname", 5);
    define("nc_contactnumber", 10);
    define("nc_contactemail", 13);
    define("nc_contactfax", 12);

    define("nc_brnumber", 15);
    define("nc_brfile", 16);
    define("nc_brissuedate", 17);
    define("nc_exp_date", 22);
    define("nc_remark", 20);
    define("nc_cr_reg_info_json", 19);
    define("nc_bind_post_company", 21);

    define("GF_SERVICE_ORDER_FORM_INTERNAL", 12);
    define("GF_SERVICE_ORDER_FORM", 9);
    define("ff_geoloc", 10);
    define("ff_expectdate", 2);
    define("ff_expectedtime", 3);
    define("ff_cr_id", 13);
    define("ff_client_company", 11);
    define("ff_site_address", 1);
    define("ff_staff_id", 5);
    define("ff_table_service", 4);


    //GF_CP_REG_FORM
    //GF_SERVICE_ORDER_FORM
    //GF_REP_REGISTRATION_FORM
    //GF_NEW_COM_FORM
    GWPreviewConfirmation::init();
    gfExt::init();
}

foreach (glob(get_template_directory() . "/hkm/actions/*.php") as $filename) {
    require_once $filename;
}
//$header_config = new header_direct();
$mobileDetect = new hkm_mobile_detection();
$mobileDetect->detect();
if (class_exists('RW_Meta_Box') && class_exists('metabox_module')) {
    new metabox_module();
}
new system_log_display();
?>