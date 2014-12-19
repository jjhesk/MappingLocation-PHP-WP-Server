<?php
/**
 * Created by PhpStorm.
 * User: Hesk
 * Date: 14年1月22日
 * Time: 上午10:29
 */
defined('ABSPATH') || exit;
if (!class_exists('metabox_module')) {
    class metabox_module
    {
        public function __construct()
        {
            foreach (glob(get_template_directory() . "/hkm/cms/*.php") as $filename) {
                require_once $filename;
            }
            add_action('admin_init', array(__CLASS__, 'meta_box_boot_start'));
            add_action('init', array(__CLASS__, 'flush_rewrite'));
        }

        public static function flush_rewrite()
        {

        }

        /**
         * Register meta boxes
         * @return void
         */
        public static function meta_box_boot_start()
        {
            global $meta_boxes;
            // Make sure there's no errors when the plugin is deactivated or during upgrade
            if (class_exists('RW_Meta_Box')) {
                foreach ($meta_boxes as $meta_box) {
                    new RW_Meta_Box($meta_box);
                }
            } else {
                echo('please install hkm-meta-box and have it be active first');
            }

        }
    }
}