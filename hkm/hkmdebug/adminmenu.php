<?php

/**
 * system admin page menu display extension model for wordpress
 * User: hesk
 * Date: 2/7/14
 * Time: 11:36 PM
 */
use hkmdebug\core\log_admin_menui as menuo;
if (class_exists('hkmdebug\core\log_admin_menui')):
    class adminmenu extends menuo
    {
        public function __construct()
        {
            if (is_admin()) {
                $this->init(21);
                $this->setup_menu_list(
                    array(
                        array(
                            "parent_id" => $this->top_level_slug,
                            "name" => __('Uploads', "hkm_lang"),
                            "id" => "upload-log",
                            "cb" => "uploadlog",
                            "class" => "adminmenu"
                        ),

                    )
                );
                $this->run();
            }
        }

        public static function uploadlog()
        {
            echo "<div class=\"wrap\"><h2>The Upload Activities</h2>";
            viewdebugoc::review_code_list(105);
            echo "</div>";
        }

        public static function emaillog()
        {
            echo "<div class=\"wrap\"><h2>The Email Activities</h2>";
            viewdebugoc::review_code_list(110);
            echo "</div>";
        }

        /**
         * Override
         */
        public static function ini_page()
        {
            echo "<div class=\"wrap\"><h2>The Example Review</h2>";
            echo "XXXX e";
            echo "</div>";
        }

    }
endif;