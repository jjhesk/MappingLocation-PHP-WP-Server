<?php
// Prevent loading this file directly
defined('ABSPATH') || exit;
/**
 * Created by PhpStorm.
 * User: Hesk
 * Date: 14年5月15日
 * Time: 上午11:01
 */
if (!class_exists('ocscript')) {
    class ocscript
    {
        /**
         * Adds JavaScript to pages with the comment form to support
         * sites with threaded comments (when in use).
         *
         * Adds JavaScript for handling the navigation menu hide-and-show behavior.
         */
        function __construct()
        {
            add_action('wp_enqueue_scripts', array(&$this, 'register'));
            add_action('wp_enqueue_scripts', array(&$this, 'run'));
            add_action('admin_enqueue_scripts', array(__CLASS__, 'register'));
            add_action('login_enqueue_scripts', array(&$this, 'login_custom'));
        }

        public function login_custom()
        {
            wp_enqueue_style('custom-login', HKM_LIBCSS . 'admin/loginsupport.css');
            //   wp_enqueue_script('custom-login', get_template_directory_uri() . '/style-login.js');
        }

        public static function register()
        {
            //  if (is_singular() && comments_open() && get_option('thread_comments'))
            //   wp_enqueue_script('comment-reply');
            wp_enqueue_script('jquery');
            wp_deregister_script('underscore');
            wp_register_script('underscore', HKM_LIBJS . 'vendor/underscore.js', array(), '1.5', false);
            wp_register_script('moment', HKM_LIBJS . 'vendor/moment.js', array('jquery'), '2.7', false);
            wp_register_script('xdantimepicker', HKM_LIBJS . 'vendor/xdantimepicker.js', array('jquery', 'moment'), '2.0', false);
            wp_register_script('twentytwelve-navigation', HKM_LIBJS . 'navigation.js', array('jquery'), '1.0', true);
            wp_register_script('crip', 'http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js', array('jquery'), '1.0', true);
            wp_register_script('onecall_core', HKM_LIBJS . 'oc.js', array('jquery'), '1.0', false);
            wp_register_script('onecall_core_zepto', HKM_LIBJS . 'vendor/zepto.js', array('jquery'), '1.0', false);
            wp_register_script('onecall_core_mustache', HKM_LIBJS . 'vendor/mustache.js', array('jquery'), '1.0', false);
            //wp_register_script('onecall_core_backbone', HKM_LIBJS . 'vendor/backbone.js', array('jquery'), '1.0', false);
            wp_register_script('onecall_core_require', HKM_LIBJS . 'vendor/require.js', array('jquery'), '1.0', false);
            wp_register_script('onecall_core_bar', HKM_LIBJS . 'vendor/mustache.handlerbar.js', array('jquery', 'onecall_core_mustache'), '1.0', false);
            wp_register_script('grid', HKM_LIBJS . 'oc_canvas_grid.js', array('onecall_core'), '20120827', false);
            wp_register_script('canvasdraw', HKM_LIBJS . 'oc_draw.js', array('onecall_core', 'grid'), '20120827', false);
            wp_register_script('addjob', HKM_LIBJS . 'oc_addjob.js', array('onecall_core'), '1.0', false);
            wp_register_script('oc_form_model', HKM_LIBJS . 'oc.form.js', array('jquery'), '1.0', false);
            wp_register_script('oc_crflow', HKM_LIBJS . 'oc_cr_flow.js', array('jquery'), '1.0', false);
            wp_register_script('oc_ostaff', HKM_LIBJS . 'oc_staff_flow.js', array('jquery'), '1.0', false);
            wp_register_script('oc_ostaff_buttons', HKM_LIBJS . 'oc_staff_buttons.js', array('jquery'), '1.0', false);
            wp_register_script('oc_interactive_piles', HKM_LIBJS . 'oc_interactive_piles.js', array('jquery'), '1.0', false);
            wp_register_script('oc_newcompany', HKM_LIBJS . 'oc_newcompany.js', array('jquery'), '1.0', false);
            wp_register_script('oc_newcompany2', HKM_LIBJS . 'pendings/new_company.js', array('jquery'), '1.0', false);
            wp_register_script('oc_newcr', HKM_LIBJS . 'oc_newcr.js', array('jquery'), '1.0', false);
            wp_register_script('oc_newcp', HKM_LIBJS . 'oc_newcp.js', array('jquery'), '1.0', false);
            wp_register_script('oc_demodata', HKM_LIBJS . 'oc_demo_data.js', array('jquery'), '1.0', false);
            wp_register_script('oc_data_page', HKM_LIBJS . 'data2.js', array('jquery'), '1.0', false);
            wp_register_script('oc_dialog', HKM_LIBJS . 'bootstrap/bootbox.min.js', array('jquery'), '1.0', false);
            wp_register_script('ocbootstrap', HKM_LIBJS . 'bootstrap/bootstrap.min.js', array('jquery'), '1.0', false);
            wp_register_script('royalslider', HKM_LIBJS . 'vendor/jquery.royalslider.min.js', array('jquery'), '1.0', false);
            wp_register_script('oc_paper_core', HKM_LIBJS . 'vendor/paper.min.js', null, '1.0', false);
            wp_register_script('oc_sketch', HKM_LIBJS . 'oc_sketch.js', null, '1.0', false);
            wp_register_script('oc_sketchtool', HKM_LIBJS . 'oc_sketch_tools.js', null, '1.0', false);
            wp_register_script('oc_dhxcore', HKM_LIBJS . 'dhx/dhtmlxscheduler.js', null, '1.0', false);
            wp_register_script('oc_dhxcore_ext_timeline', HKM_LIBJS . 'dhx/ext/dhtmlxscheduler_timeline.js', array('oc_dhxcore'), '1.0', false);
            wp_register_script('oc_dhxcore_ext_editor', HKM_LIBJS . 'dhx/ext/dhtmlxscheduler_editors.js', array('oc_dhxcore'), '1.0', false);
            wp_register_script('oc_dhxcore_ext_terrace', HKM_LIBJS . 'dhx/ext/dhtmlxscheduler_dhx_terrace.js', array('oc_dhxcore'), '1.0', false);
            wp_register_script('oc_mobihesk', HKM_LIBJS . 'mobi/mobiscroll.hesk-2.5.4.min.js', array(), '1.0', false);
            wp_register_script('jq_timepick', HKM_LIBJS . 'vendor/jquery.timepick.js', array('jquery'), '1.0', false);
            wp_register_script('oc_colorbox', HKM_LIBJS . 'colorbox/jquery.colorbox-min.js', array('jquery'), '1.0', false);
            wp_register_script('canvas_print', HKM_LIBJS . 'imageprocess/html2canvas.js', array('jquery'), '1.0', false);
            wp_register_script('canvas2image', HKM_LIBJS . 'imageprocess/canvas2image.js', array('canvas_base64'), '1.0', false);
            wp_register_script('canvas_base64', HKM_LIBJS . 'imageprocess/base64bit.js', array('canvas_print'), '1.0', false);
            wp_register_script('base_map_review_control', HKM_LIBJS . 'print_base_map_control.js', array('jquery', 'canvas_print'), '1.0', false);
            //https://datatables.net/
            wp_register_script('datatable', '//cdn.datatables.net/1.10.0/js/jquery.dataTables.js', array('jquery'), '1.0', false);
            wp_register_script('datatable_refresh', '//cdn.datatables.net/plug-ins/28e7751dbec/api/fnReloadAjax.js', array('jquery'), '1.0', false);
            wp_register_script('htmlminifier', HKM_LIBJS . 'vendor/htmlminifier.js', array('jquery'), '1.0', false);
            //map clusters
            wp_register_script('gmapscluster', 'http://maps.google.com/maps/api/js?sensor=true', array('jquery'));
            wp_register_script('gmaps', HKM_LIBJS . 'vendor/gmaps.js', array('gmapscluster'), '1.0', false);
            //gmaps clusters
            wp_register_script('kendo', HKM_LIBJS . 'kendoui/kendo.all.min.js', array('jquery'), '1.0', false);
            wp_register_script('joblisttb', HKM_LIBJS . 'admin/jblisttb.js', array('jquery', 'kendo'), '1.0', false);
            wp_register_script('cp_management', LIBJS_ADMIN_MODEL . 'CPManagement.js', array('jquery', 'datatable', 'datatable_refresh'), '1.0', false);
            wp_register_script('job_report_list', LIBJS_ADMIN_MODEL . 'JobReportList.js', array('jquery', 'datatable', 'onecall_core_bar'), '1.0', false);
            wp_register_script('reportcontenteditor', LIBJS_ADMIN_MODEL . 'ReportContentEditor.js', array('jquery'), '1.0', false);
            wp_register_script('listsubmission', LIBJS_ADMIN_MODEL . 'ListSubmission.js', array('jquery', 'datatable', 'datatable_refresh'), '1.0', false);
            wp_register_script('orderconfirmation', LIBJS_ADMIN_MODEL . 'JobOrderConfirmation.js', array('jquery'), '1.0', false);
            wp_register_script('listtemplatecontrol', LIBJS_ADMIN_MODEL . 'ListTemplateControl.js', array('jquery', 'datatable', 'datatable_refresh', 'underscore'), '1.0', false);
            wp_register_script('adminsupport', LIBJS_ADMIN_MODEL . 'adminsupporttools.js', array('jquery'), '1.0', false);
            wp_register_script('admin_post_job_process', LIBJS_ADMIN . 'jobpanel.js', array(
                'jquery',
                'datatable',
                'datatable_refresh',
                'jquery-ui-autocomplete',
                'job_report_list',
                'cp_management',
                'orderconfirmation',
                'xdantimepicker',
                'adminsupport'
            ), '1.0', true);

            wp_register_script('admin_report_js', LIBJS_ADMIN . 'report_panel.js', array(
                'jquery',
                'datatable',
                'datatable_refresh',
                'jquery-ui-autocomplete',
                'listsubmission',
                'listtemplatecontrol',
                'adminsupport',
                'onecall_core_bar',
                'royalslider',
                'htmlminifier',
                'reportcontenteditor'
            ), '1.1', true);

            wp_register_script('admin_post_company', LIBJS_ADMIN . 'company_panel.js', array(
                'adminsupport', 'datatable', 'datatable_refresh'
            ), '1.0', false);

            wp_register_script('page_list_support', LIBJS_ADMIN_MODEL . 'listing_support.js', array('jquery', 'datatable', 'onecall_core_bar'), '1.0', false);
            wp_register_script('page_admin_system_log', LIBJS_ADMIN . 'admin_system_log.js', array('page_list_support', 'datatable', 'onecall_core_bar'), '1.0', false);
            wp_register_script('page_approve_new_company', LIBJS_ADMIN . 'company_new_approve.js', array('page_list_support', 'datatable', 'onecall_core_bar'), '1.0', false);
            wp_register_script('page_approve_new_cr', LIBJS_ADMIN . 'cr_new_approve.js', array('page_list_support', 'datatable', 'onecall_core_bar'), '1.0', false);
            wp_register_script('page_approve_new_cp', LIBJS_ADMIN . 'cp_new_approve.js', array('page_list_support', 'datatable', 'onecall_core_bar'), '1.0', false);
            wp_register_script('page_job_application', LIBJS_ADMIN . 'job_app.js', array('jquery', 'datatable', 'datatable_refresh', 'onecall_core_bar'), '1.0', false);
            wp_register_script('page_job_task_history', LIBJS_ADMIN . 'job_task.js', array('jquery', 'datatable', 'onecall_core_bar'), '1.0', false);
            //gravity form supports

            wp_register_script('gfordersupport', HKM_LIBJS . 'gravityforms/order.js', array('onecall_core_bar', 'gmaps', 'jquery', 'xdantimepicker'), '1.0', false);
            wp_register_script('gfnewcomsupport', HKM_LIBJS . 'gravityforms/reg_company.js', array('jquery', 'onecall_core_bar'), '1.0', false);
            /*royalslider css*/
            wp_register_script('rsslider', HKM_LIBJS . 'gravityforms/reg_company.js', array('jquery', 'onecall_core_bar'), '1.0', false);
            /*
            table.dataTable tbody tr

             wp_register_script('oc_mobihesk', HKM_LIBJS . 'mobi/mobiscroll.hesk-2.5.4.min.js', array('oc_dhxcore'), '1.0', false);

            */
            /**
             * implementation of CSS style loading system
             *
             *
             */
            wp_register_style('xdanstyle', HKM_LIBCSS . 'xdan/xdan.css', null, '2.0');
            wp_register_style('datatable', '//cdn.datatables.net/1.10.0/css/jquery.dataTables.css', false, '1', 'screen');
            /*royalslider css*/
            wp_register_style('rs-core', HKM_LIBCSS . 'royalslider/core.css', null, '9.5');
            wp_register_style('rs-min-white', HKM_LIBCSS . 'royalslider/rs-minimal-white.css', array("rs-core"), '9.5');

            wp_register_style('oc_mobi_core', HKM_LIBCSS . 'mobi/mobiscroll.core-2.5.4.css', array(), '1');
            wp_register_style('oc_mobi_ios', HKM_LIBCSS . 'mobi/mobiscroll.ios-2.5.4.css', array(), '1');
            wp_register_style('oc_mobi_animation', HKM_LIBCSS . 'mobi/mobiscroll.animation-2.5.4.css', array(), '1');
            wp_register_style('oc_icons', HKM_LIBFONTS . 'icon.css', array(), '1');

            wp_register_style('print_single_basemap', HKM_LIBCSS . 'a3.css', array(), '1.1');
            wp_register_style('print_report', HKM_LIBCSS . 'a4.css', array(), '1.1');

            wp_register_style('gf_hot_fix', HKM_LIBCSS . 'gravityforms/basicfixes.css', array(), '1');

            wp_register_style('dashicons', HKM_LIBCSS . 'dashicons.css', array(), '1');

            wp_register_style('gfcsssupport', HKM_LIBCSS . 'gravityforms/orderscss.css', array('gf_hot_fix', 'xdanstyle'), '1');

            wp_register_style('adminsupportcss', HKM_LIBCSS . 'admin/normalcontrol.css',
                array(
                    'dashicons',
                    'datatable',
                    'xdanstyle')
                , '1');
            wp_register_style('cms_report_panel_css', HKM_LIBCSS . 'a4admin.css', array('adminsupportcss', 'rs-min-white'), '1');
            wp_register_style('kendo_common', HKM_LIBCSS . 'kendoui/kendo.common.min.css', array(), '1');
            wp_register_style('kendo_default', HKM_LIBCSS . 'kendoui/kendo.default.min.css', array('dashicons', 'kendo_common'), '1');

            //kendo_common
        }

        /**
         * Loads our special font CSS file.
         *
         * The use of Open Sans by default is localized. For languages that use
         * characters not supported by the font, the font can be disabled.
         *
         * To disable in a child theme, use wp_dequeue_style()
         * function mytheme_dequeue_fonts() {
         *     wp_dequeue_style( 'twentytwelve-fonts' );
         * }
         * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
         */
        private function config_css()
        {


            /* translators: If there are characters in your language that are not supported
             by Open Sans, translate this to 'off'. Do not translate into your own language. */
            if ('off' !== _x('on', 'Open Sans font: on or off', 'twentytwelve')) {
                $subsets = 'latin,latin-ext';
                /* translators: To add an additional Open Sans character subset specific to your language, translate
                 this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language. */
                $subset = _x('no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'twentytwelve');
                if ('cyrillic' == $subset)
                    $subsets .= ',cyrillic,cyrillic-ext';
                elseif ('greek' == $subset)
                    $subsets .= ',greek,greek-ext';
                elseif ('vietnamese' == $subset)
                    $subsets .= ',vietnamese';

                $protocol = is_ssl() ? 'https' : 'http';
                $query_args = array('family' => 'Open+Sans:400italic,700italic,400,700', 'subset' => $subsets,);
                wp_enqueue_style('twentytwelve-fonts', add_query_arg($query_args, "$protocol://fonts.googleapis.com/css"), array(), null);
            }
            /*
            Loads our main stylesheet.
            */
            wp_enqueue_style('twentytwelve-style', get_stylesheet_uri());
            wp_dequeue_style('jquery-ui-core');
            /*
             Loads the Internet Explorer specific stylesheet.
             */
            wp_enqueue_style('normalize', HKM_LIBCSS . 'bootstrap.min.css', null, '4.0');

            //wp_enqueue_style('foundation4', HKM_LIBCSS . 'foundation.min.css', array('normalize'), '4.0');
            // wp_enqueue_style('twentytwelve-ie', HKM_LIBCSS . 'ie.css', array('twentytwelve-style'), '20121010');
            wp_enqueue_style('accordionmenu', HKM_LIBCSS . 'accordionmenu.css', null, '1');
            wp_enqueue_style('datepick', HKM_LIBCSS . 'oc_datepick.css', array(), null);
            wp_enqueue_style('form', HKM_LIBCSS . 'form.css', array('datepick'), null);
            wp_enqueue_style('oc_base', HKM_LIBCSS . 'oc.css', array(), null);
            wp_enqueue_style('ocanim', HKM_LIBCSS . 'animate-custom.css', array(), null);
            wp_enqueue_style('oc_color_box_s', HKM_LIBJS . 'colorbox/example5/colorbox.css', array(), null);
            wp_register_style('dhxcorecss', HKM_LIBCSS . 'dhtmlxscheduler.css', array(), '1');
            global $wp_styles;
            $wp_styles->add_data('twentytwelve-ie', 'conditional', 'lt IE 9');
        }

        private function preloadjs()
        {
            wp_enqueue_style('oc_icons');
            wp_enqueue_script('oc_colorbox');
            wp_enqueue_script('crip');
            //  wp_enqueue_script('onecall_core_require');
            wp_enqueue_script('onecall_core_zepto');
            //wp_enqueue_script('onecall_core_backbone');
            wp_enqueue_script('onecall_core_mustache');
            wp_enqueue_script('onecall_core_bar');
            wp_enqueue_script('ocbootstrap');
            wp_enqueue_script('jq_timepick');
            //wp_enqueue_script('underscore');
            wp_enqueue_script('onecall_core');
            wp_localize_script('onecall_core', 'oc_obj', array(&$this, 'get_environoment_config'));
            wp_enqueue_script('oc_form_model');
        }

        function get_environoment_config()
        {
            $f = array("cascac", "casc");
            $translation_array = array('some_string' => __('Some string to translate'), 'imgbin' => HKM_IMG_PATH);
            if (is_page(309)) {
                // $layer_image = HKM_IMG_PATH . "demo/2013-07-26_131457.jpg";
            }
            $application_loader = HKM_IMG_PATH . 'load2.gif';
            if (oc_db_account::has_role('ocstaff') || oc_db_account::has_role('administrator')) {
                include_once(ABSPATH . 'wp-admin/includes/plugin.php');
                if (is_plugin_active('json-api/json-api.php')) {
                    /**
                     * there we have a collection of API gateways for a bunch of data exchanges
                     */
                    // $api
                    //   $oxext = new ocexta();
                    //    $api = $oxext -> getAPIs();
                    $api_getpending_com = API_OC_CORE . 'getPendingCOM/';
                    $api_getpending_cp = API_OC_CORE . 'getPendingCP/';
                    $api_accPending = API_OC_CORE . 'acceptPending/';
                    $api_rejPending = API_OC_CORE . 'rejectPending/';
                    $channel_service_order = API_OC_CORE . 'get_new_service_order/';

                    $apitoolset = API_OC_CORE . 'get_tools/';
                    $api_gettool_set_from_list = API_OC_CORE . 'get_toolset_by_job/';

                    $api_addnewproject = API_OC_CORE . 'add_new_project/';
                    $api_get_job_by_order = API_OC_CORE . 'get_job_data/';
                    $api_remove_job_approve = API_OC_CORE . 'remove_job_approve/';
                    $api_job_new_job = API_OC_CORE . 'add_new_job/';
                    $api_save_job = API_OC_CORE . 'save_editing_data_from_job/';
                }
            }
            $staff_ajax = admin_url('admin-ajax.php');
            // generate a nonce with a unique ID "myajax-post-comment-nonce"
            // so that you can check it later when an AJAX request is sent
            if (is_user_logged_in()) {
                $cNonce = wp_create_nonce(NONCE_SALT . get_current_user_id() . '_' . str_replace('.', '', gettimeofday(true)));
            } else {
                $cNonce = wp_create_nonce(NONCE_SALT . '_' . str_replace('.', '', gettimeofday(true)));
            }
            if (is_page(180)) {
                $api_cr_list_submission = API_OC_CORE . 'enter_CR_List/';
            }
            $returnbasemap_url = get_permalink(OC_GUI_PRINT);
            return get_defined_vars();
        }

        function run()
        {
            global $post;
            $this->config_css();
            $this->preloadjs();
            if (is_page()) {
                if (is_page(ADDJOB) || is_page(120)) {
                    wp_enqueue_script('addjob');
                }
                wp_enqueue_script('grid');
                wp_enqueue_script('canvasdraw');
            }
            if (is_page(180)) {
                //new company form php
                wp_enqueue_script('oc_newcompany');
            }
            if (is_page(161)) {
                //new cr form php
                wp_enqueue_script('oc_newcr');
            }
            if (is_page(194)) {
                //new cp form php
                wp_enqueue_script('oc_newcp');
            }
            if (is_page(2))
                wp_enqueue_script('oc_crflow');

            if (is_page_template('mock-templates/project_overview_interface.php')) {
                //the one call staff after login page
                //wp_enqueue_script('oc_mobihesk');
                //the setup for the external image uploader
                wp_enqueue_media();
                //the external dialog component
                wp_enqueue_script('oc_dialog');
                // data manipulations
                wp_enqueue_script('oc_demodata');
                //core engine for the oc staff
                wp_enqueue_script('oc_ostaff');
                wp_enqueue_script('oc_interactive_piles');
                //button functions for the oc staff
                wp_enqueue_script('oc_ostaff_buttons');
                //schdule controller for the job time and schdules
                wp_enqueue_script('oc_dhxcore');
                wp_enqueue_script('oc_dhxcore_ext_timeline');
                wp_enqueue_script('oc_dhxcore_ext_editor');
                wp_enqueue_script('oc_dhxcore_ext_terrace');
                //   wp_enqueue_style('oc_mobi_animation');
                //    wp_enqueue_style('oc_mobi_core');
                //   wp_enqueue_style('oc_mobi_ios');
                wp_enqueue_style('dhxcorecss');
            }
            if (is_page(309)) {
                //sketch page for CP page
                wp_enqueue_script('underscore');
                wp_enqueue_script('oc_paper_core');
                wp_enqueue_script('oc_sketch');
                wp_enqueue_script('oc_sketchtool');
            }
            if (is_page_template('mock-templates/new_print_draw_map.php') || is_page_template('mock-templates/print_single.php') || is_page_template('mock-templates/print_report_form_b.php')) {
                wp_enqueue_script('underscore');
                wp_enqueue_script('canvas_print');
                wp_enqueue_script('canvas_base64');
                wp_enqueue_script('canvas2image');
                wp_enqueue_script('base_map_review_control');
                wp_enqueue_style('print_single_basemap');
            }
            if (is_page_template('mock-templates/newcompany.php')) {
                wp_enqueue_script('underscore');
                wp_enqueue_script('oc_data_page');
                wp_enqueue_script('oc_newcompany2');
            }
        }

    }
}