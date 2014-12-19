<?php
defined('ABSPATH') || exit;
use hkmdebug\core\log_db as logdb;

//if (class_exists('logdb')):
    class debugoc extends logdb
    {
        public static function upload_email_log($message, $line_code)
        {
            parent::db_access(-1, $message, 110, $line_code);
        }

        public static function upload_bmap_log($message, $line_code)
        {
            parent::db_access(-1, $message, 105, $line_code);
        }

        public static function log_template($template, $var)
        {
            return "<pre>" . sprintf($template, $var) . "</pre>";
        }

        public static function log($template, $var)
        {
            echo self::log_template($template, $var);
        }

        public static function logarray($template, $var)
        {
            echo self::log_template($template, print_r($var, true));
        }

    }
//endif;
