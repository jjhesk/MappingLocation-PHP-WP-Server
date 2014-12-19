<?php
defined('ABSPATH') || exit;
if (!class_exists('json_api_extend')) {
    /**
     * Created by PhpStorm.
     * User: hesk
     * Date: 5/13/14
     * Time: 11:35 PM
     */
    class json_api_extend
    {
        function __construct()
        {
            $this->init();
        }

        public function init()
        {
            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
            $error = "Json-API is not activated please make sure that plugin is activated. Download it at http://wordpress.org/plugins/json-api/other_notes/";
            if (is_plugin_active('json-api/json-api.php')) {
                add_filter('json_api_controllers', function ($controllers) {
                    $add_controllers = array(
                        'staffcontrol',
                        'crapi',
                        'appaccess',
                        'systemlog'
                    );
                    return array_merge($controllers, $add_controllers);
                });
                add_filter('json_api_staffcontrol_controller_path', function () {
                    return get_template_directory() . '/hkm/api/staffcontrol.php';
                });
                add_filter('json_api_crapi_controller_path', function () {
                    return get_template_directory() . '/hkm/api/crapi.php';
                });
                add_filter('json_api_appaccess_controller_path', function () {
                    return get_template_directory() . '/hkm/api/appaccess.php';
                });
                add_filter('json_api_systemlog_controller_path', function () {
                    return get_template_directory() . '/hkm/api/systemlog.php';
                });
            } else {
                echo $error;
            }
        }
    }
}