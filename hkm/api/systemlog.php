<?php
/*
  Controller name: System Log
  Controller description: Backend API for presenting the JSON of system log. <br>Detail please refer to our Google Drive documentation. <br>Author: Ryo
 */
if (!class_exists('JSON_API_Systemlog_Controller')) {
    class JSON_API_Systemlog_Controller
    {

        public static function login_log()
        {
            global $wpdb;
            $table_app_log = 'onecallapp_app_log';
            $myrows = $wpdb->get_results("SELECT * FROM $table_app_log WHERE event_code = 521");
            api_handler::outSuccessDataTable($myrows);
        }

        public static function email_log()
        {
            global $wpdb;
            $table_app_log = 'onecallapp_app_log';
            $myrows = $wpdb->get_results("SELECT * FROM $table_app_log WHERE event_code = 522");
            api_handler::outSuccessDataTable($myrows);
        }

        public static function vcoin_app_log()
        {
            global $wpdb;
            $table_app_log = 'onecallapp_app_log';
            $myrows = $wpdb->get_results("SELECT * FROM $table_app_log WHERE event_code = 523");
            api_handler::outSuccessDataTable($myrows);
        }

        public static function new_account_log()
        {
            global $wpdb;
            $table_app_log = 'onecallapp_app_log';
            $myrows = $wpdb->get_results("SELECT * FROM $table_app_log WHERE event_code = 524");
            api_handler::outSuccessDataTable($myrows);
        }

        public static function redemption_verification_log()
        {
            global $wpdb;
            $table_app_log = 'onecallapp_app_log';
            $myrows = $wpdb->get_results("SELECT * FROM $table_app_log WHERE event_code = 525");
            api_handler::outSuccessDataTable($myrows);
        }

        public static function redemption_verify_log()
        {
            global $wpdb;
            $table_app_log = 'onecallapp_app_log';
            $myrows = $wpdb->get_results("SELECT * FROM $table_app_log WHERE event_code = 526");
            api_handler::outSuccessDataTable($myrows);
        }

        public static function third_party_app_transaction_log()
        {
            global $wpdb;
            $table_app_log = 'onecallapp_app_log';
            $myrows = $wpdb->get_results("SELECT * FROM $table_app_log WHERE event_code = 527");
            api_handler::outSuccessDataTable($myrows);
        }

        public static function upload_log()
        {
            global $wpdb;
            $table_app_log = 'onecallapp_app_log';
            $myrows = $wpdb->get_results("SELECT * FROM $table_app_log WHERE event_code = 528");
            api_handler::outSuccessDataTable($myrows);
        }
    }
}
