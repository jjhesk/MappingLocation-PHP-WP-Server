<?php

// Prevent loading this file directly
defined('ABSPATH') || exit;
if (!class_exists('oc_db_order')) {
    class oc_db_order extends oc_db
    {
        //get all the db orders from by time submission only
        private static function getdb($sort)
        {
            global $wpdb;
            $table = DB_ORDER;
            if (is_array($sort)) {

            }
            $rows = $wpdb->get_results("
                  SELECT * FROM $table
                  WHERE company_id <> -1 
                  ORDER BY timestamp DESC");
            return $rows;
        }

        /**
         * get pending original orders from customers only
         * get pending orders
         * @return array
         */
        public static function get_pendings()
        {
            $data = self::getdb(null);
            // $test = oc_db::ensureJSONString($data);
            $out = array();
            foreach ($data as &$r) {
                $json_array = json_decode($r->json, TRUE);
                $company = "-no company-";
                if (oc_db_account::has_role_ByUserID($r->ID, 'cr')) {
                    $company_id = oc_db_account::getVal($r->ID, 'company_id');
                    $company = oc_company::getComById('company_name', $company_id);
                };
                if (empty($r->jobs_from_order)) {
                    $new = true;
                }
                //   echo get_user_meta($r -> ID,"company_id",TRUE);
                //$company = oc_company::getComById('company_name', get_user_meta($r -> ID,"company_id",TRUE));
                $out[] = array(
                    //-------
                    "submission_date" => $r->timestamp, "location" => $r->site_location,
                    //-------
                    "service_date" => $r->expect_date, "service_time" => $r->expect_time, "order_ref_id" => intval($r->ID),
                    //-------
                    "total" => count($json_array), "company" => $company, "crname" => oc_db_account::getName($r->cr_id),
                    //-------
                    "gform_order_id" => intval($r->gform_order_id), "content_of_service" => array_values($json_array),
                    //-------
                    "processing_orders" => "",
                    //-------
                    "approved_orders" => "",
                    //-------
                    "new_order_zero_jobs" => empty($r->jobs_from_order),
                    //--
                    "followup" => "");
                //self::get_boardcast_preparation($r));
            }
            //TODO making this work
            //print_r(array_values ($out));
            //  echo "foiansd";
            return array_values($out);
        }

        public static function get_boardcast_preparation($data_row)
        {
            if (!empty($data_row->jobs_from_order)) {
                return json_decode($data_row->jobs_from_order, TRUE);
            } else
                return "";
        }

        // adding new orders from the customers
        public static function addOrder($ID, $data, $crid, $companyid)
        {
            global $wpdb;
            $column = array('gform_order_id' => $ID, 'del' => 0, 'approved' => 0, 'cr_id' => $crid, 'company_id' => $companyid,);
            return $wpdb->insert(DB_ORDER, array_merge($column, $data),
                //---
                null);

        }

        //-----------------------------------------------------------------------------------
        // for oc staff to work on the orders
        public static function create_new_job_from_order_id($order_id)
        {
            global $wpdb;
            $table = DB_ORDER;
            $transaction_id = oc_db::gen_order_num();
            $row = $wpdb->get_row("SELECT * FROM $table WHERE ID=$order_id");
            $config = array("order_ref_no" => $order_id, "reference_no" => $transaction_id,);
            $result = $wpdb->insert(DB_JOB, array_merge(oc_db::convert_table_order_to_job($row), $config), null);
            $last_id = $wpdb->insert_id;
            $result_this = oc_db::manipulate_row_id_collection_add(DB_ORDER, 'jobs_from_order', $order_id, $last_id);
            //return as the reference for the new job box in html
            return array("id" => $last_id, "ref" => $transaction_id, 'job_fields_result' => $result_this);
        }

        /**
         * @param $order_id
         * @param $job_id
         * @return array
         */
        public static function remove_approve_job_process($order_id, $job_id)
        {
            global $wpdb;
            $table = DB_ORDER;
            $result_this = oc_db::manipulate_row_id_collection_remove(DB_ORDER, 'jobs_from_order', $order_id, $job_id);
            $row = $wpdb->update(DB_JOB, array('lastupdate_timestamp' => time(), 'deleted' => 1), array('ID' => $job_id));
            //return as the reference for the new job box in html
            return array("id" => $order_id, "ref" => $row, 'job_fields_result' => $result_this);
        }

        /**
         * @param $order_id
         * @return array|string
         */
        public static function get_jobs_from_order_id($order_id)
        {
            if (self::isPreparationStarted($order_id)) {
                return self::get_order_process_approval_list($order_id);
            } else {
                return "no associated data";
            }
        }

        /**
         * @param $order_id
         * @return bool
         */
        public static function isPreparationStarted($order_id)
        {
            global $wpdb;
            $table = DB_ORDER;
            $row = $wpdb->get_var("SELECT jobs_from_order FROM $table WHERE ID=$order_id");
            return !empty($row);
        }

        /**
         * @param $order_id
         * @return array
         */
        private static function get_order_process_approval_list($order_id)
        {
            global $wpdb;
            $table = DB_ORDER;
            $row = $wpdb->get_var("SELECT jobs_from_order FROM $table WHERE ID=$order_id");
            $linked_jobs_unprocessed = explode(' ', $row);
            $table = DB_JOB;
            $result_db_row = array();
            foreach (array_values($linked_jobs_unprocessed) as $value) {
                $value = intval($value);
                $row = $wpdb->get_row("SELECT * FROM $table WHERE ID=$value AND deleted=0");
                // AND deleted=0
                /*
                 if (!is_bool($toolset)) {
                 $row -> toolset = $toolset;
                 } else {
                 $row -> toolset = FALSE;
                 }
                 */
                $row->get_toolset = oc_tools_management::get_toolset_by_job_display($row->ID);
                if (!is_null($row)) {
                    $result_db_row[] = $row;
                }
            }
            return array("total" => count($result_db_row), "data" => $result_db_row);
        }

        /**
         * @param $order_id
         * @param $json
         * @return mixed
         */
        public static function update_preparation($order_id, $json)
        {
            global $wpdb;
            $data = array("jobs_from_order" => $json);
            return $wpdb->insert(DB_ORDER, $data, null);
        }

        /**
         * learn from resources: http://pentestmonkey.net/cheat-sheet/sql-injection/mysql-sql-injection-cheat-sheet
         * getting list of the order
         * @return array
         */
        private static function gf_get_order_history_result()
        {
            global $wpdb;
            $tbl = $wpdb->base_prefix . "rg_lead";
            $prep = "SELECT id AS K, CONCAT(id,'&nbsp;',date_created,if(is_read=1,' (read)','(unread)')) AS V FROM $tbl WHERE form_id=" . GF_SERVICE_ORDER_FORM . " ORDER BY date_created desc";
            return $wpdb->get_results($prep);
        }

        public static function prepare_ui_options()
        {
            $ui = new ui_handler();
            return $ui->options_ui_from_wp_query(self::gf_get_order_history_result(), "ref_order_id", "Select Reference Order", "ui_ref_order_id");
        }

        /**
         *
         * gravity form value retrieve
         *
         * @param $lead_id
         * @param $field_id
         * @return mixed
         */
        protected static function get_gf_archive_val($lead_id, $field_id)
        {
            return parent::gf_get_entry_value(GF_SERVICE_ORDER_FORM, $lead_id, $field_id);
        }

        /**
         * handle the ajax call from the admin job panel - get_order_data
         *
         */
        public static function ajax_get_order_data_package()
        {
            try {
                if (isset($_POST['led_id'])) {
                    $post_job_id = intval($_POST['led_id']);
                    $loc = json_decode(self::get_gf_archive_val($post_job_id, ff_geoloc));
                    $address = self::get_gf_archive_val($post_job_id, ff_site_address);
                    $companyid = self::get_gf_archive_val($post_job_id, ff_client_company);
                    $services = self::get_gf_archive_val($post_job_id, ff_table_service);
                    $ff_expectdate = self::get_gf_archive_val($post_job_id, ff_expectdate);
                    $ff_expectedtime = self::get_gf_archive_val($post_job_id, ff_expectedtime);
                    $cr_id = self::get_gf_archive_val($post_job_id, ff_cr_id);
                    api_handler::outSuccessData(get_defined_vars());
                } else throw new Exception("no input", 1102);
            } catch (Exception $e) {
                api_handler::outFail($e->getCode(), $e->getMessage());
            }
        }

        public static function api_get_order_data_package()
        {
            try {
                if (isset($_GET['job_post_id'])) {
                    if (oc_db_account::has_role('administrator')) {
                        $post_job_id = intval($_GET['job_post_id']);
                        $n = new oc_market_notification($post_job_id);
                        $results = $n->get_notified_cps_db();
                        api_handler::outSuccessDataTable($results);
                    } else throw new Exception("please login with proper permission", 1104);
                } else if (isset($_GET['showall'])) {
                   // if (oc_db_account::has_role('administrator')) {
                        $results = oc_market_notification::get_all_cps();
                        api_handler::outSuccessDataTable($results);
                   // } else throw new Exception("please login with proper permission", 1104);
                } else
                    throw new Exception("no input", 1102);
            } catch (Exception $e) {
                api_handler::outFail($e->getCode(), $e->getMessage());
            }
        }

        public static function init_table()
        {
            $sql = "
            CREATE TABLE IF NOT EXISTS onecallapp_basemap (
             ID bigint(20) NOT NULL AUTO_INCREMENT,
             type int(11) NOT NULL,
             filename varchar(255) COLLATE utf8_bin NOT NULL,
             legend_info varchar(1000) COLLATE utf8_bin NOT NULL COMMENT 'legend json information',
             entries longtext COLLATE utf8_bin NOT NULL COMMENT 'entries data for radius and measurement',
             job_id bigint(20) NOT NULL,
             basemap_assigned_id bigint(20) NOT NULL,
             machine_data longblob NOT NULL,
             hash varchar(36) COLLATE utf8_bin NOT NULL,
             remove tinyint(4) NOT NULL DEFAULT '0',
             user_id_upload varchar(255) COLLATE utf8_bin NOT NULL,
             update timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
             PRIMARY KEY (ID)
            ) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='return base map table'";
            return $sql;
        }
    }
}
?>