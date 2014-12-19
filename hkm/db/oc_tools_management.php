<?php

// Prevent loading this file directly
defined('ABSPATH') || exit ;
if (!class_exists('oc_tools_management')) {
    class oc_tools_management {

        public static function get_toolset_by_job_display($jobID) {
            global $wpdb;
            $table = DB_TOOL;
            $output = array();
            $rowset = $wpdb -> get_results("SELECT * FROM $table WHERE job_id=$jobID");
            foreach ($rowset as $r) {
                $output[] = self::get_tool_meta_row($r -> tool_id, TRUE);
            }
            if (isset($rowset) && !is_null($rowset)) {
                return $output;
            } else {
                return FALSE;
            }
        }

        public static function get_toolset_by_job($jobID) {
            global $wpdb;
            $table = DB_TOOL;
            $rowset = $wpdb -> get_results("SELECT * FROM $table WHERE job_id=$jobID");
            if (isset($rowset) && !is_null($rowset)) {
                return $rowset;
            } else {
                return FALSE;
            }
        }

        public static function get_available($date, $time) {

            // 24-hour time to 12-hour time
            //"13:30"
            $time_in_12_hour_format = DATE("g:i a", strtotime("13:30"));

            // 12-hour time to 24-hour time
            //"1:30 pm"
            $time_in_24_hour_format = DATE("H:i", strtotime($time));

            $q = $date . " " . $time;
            //print_r($q);
            $time_date = date_parse_from_format("j/n/Y H:i a", $q);
            //$number_at_time = strtotime($time_date);
            // print_r($number_at_time);
            // print_r($time_date);
            $items = get_posts(array('post_type' => HKM_TOOLS, 'posts_per_page' => -1, 'status' => 'published'));
            $array = array();
            foreach ($items as $item) {
                $optionpost = $item -> post_title;
                $array[] = self::get_tool_meta_row($item -> ID);
            }
            return $array;
            //        return $optionpost;
        }

        public static function remove_reserve($tool_id, $job_id) {
            $where = array('tool_id' => $tool_id, 'job_id' => $job_id);
            global $wpdb;
            $result = $wpdb -> delete(DB_TOOL, $where, NULL);
            return $result;
        }

        public static function add_reserve($date, $time, $tool_set, $job_id_key) {
            global $wpdb;
            $format = null;
            if (!empty($tool_set)) {
                $tool_set_array = explode(",", $tool_set);
                //print_r($tool_set);
                if (count($tool_set_array) > 0) {
                    foreach ($tool_set_array as $k => $tool_keyID) {
                        if (intval($tool_keyID) > 0) {
                            $r = $wpdb -> get_row("SELECT * FROM " . DB_TOOL . " WHERE job_id = $job_id_key AND tool_id = $tool_keyID");
                            if (is_null($r)) {
                                $enterdata = array('job_id' => $job_id_key, 'date' => $date, 'time' => $time, 'tool_id' => $tool_keyID);
                                $r = $wpdb -> insert(DB_TOOL, $enterdata, $format);
                                $rID = $r -> insert_id;
                            } else {
                                $where = array('job_id' => $job_id_key, 'tool_id' => $tool_keyID);
                                $wpdb -> delete(DB_TOOL, $where, $format);
                            }
                        }
                    }
                }
            } else {
                $where = array('job_id' => $job_id_key);
                $wpdb -> delete(DB_TOOL, $where, $format);
            }

            $result = $wpdb -> update(DB_JOB, array('toolset_ref_ids' => $tool_set), array('ID' => $job_id_key));
            //oc_db::manipulate_row_id_collection_add(DB_JOB, 'toolset_ref_ids', $job_id_key, $r -> insert_id);
            //       $r = $wpdb -> insert(DB_TOOL, $enterdata, $format);
            return $result;
        }

        public static function get_tool_meta_row($tool_id, $isActive = FALSE) {
            $tool_code = get_the_title($tool_id);
            $available = intval(get_post_meta($tool_id, "oc_tool", TRUE));
            $brand = get_post_meta($tool_id, "brand", TRUE);
            $serialno = get_post_meta($tool_id, "serialno", TRUE);
            $caldate = get_post_meta($tool_id, "caldate", TRUE);
            $model = get_post_meta($tool_id, "model", TRUE);
            return get_defined_vars();
        }

        public static function get_tool_allocation($tool_id) {
            global $wpdb;
            $table = DB_ORDER;
            $row = $wpdb -> get_var("SELECT jobs_from_order FROM $table WHERE ID=$order_id");
            //TODO to finish this time and tool management anaylsis with this thing.
        }

    }

}
?>