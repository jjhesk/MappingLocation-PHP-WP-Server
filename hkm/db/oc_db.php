<?php
//developed by Heskeyo Kam
//2013 @ imusictech
defined('ABSPATH') || exit;
if (!class_exists('oc_db')) {
    class  oc_db
    {

        public static function get_pending_cr_from_newcom_byKeyid($id)
        {
            global $wpdb;
            $table = DB_PENDING;
            $pending_type = 'newcr';
            /*
             $row = $wpdb -> get_row("
             SELECT * FROM $table
             WHERE ID='$column_ID'");
             $id=$row['key1']; */

            $row = $wpdb->get_results("
                       SELECT * FROM $table
                       WHERE type='$pending_type' AND key1=$id
                       ORDER BY stamp DESC");
            //$total = count($row);
            return $row;
        }

        //getting the row by the pending ID
        public static function get_pending_by_type($pending_type)
        {
            global $wpdb;
            $table = DB_PENDING;
            $row = $wpdb->get_results("
                                    SELECT * FROM $table
                                    WHERE type='$pending_type'
                                    ORDER BY stamp DESC");
            return $row;
        }

        public static function get_depending_key_from_row_pending($indexKey)
        {
            global $wpdb;
            $table = DB_PENDING;
            $row = $wpdb->get_row("SELECT * FROM $table WHERE ID = $indexKey", ARRAY_A);
            if (is_null($row)) {
                //not found
                return -1;
            } else
                return $row['key1'];
        }

        public static function get_rows_pending($related_to_id, $pending_type)
        {
            global $wpdb;
            $table = DB_PENDING;
            $rows = $wpdb->get_results("
                  SELECT * FROM $table
                  WHERE type='$pending_type' AND key1=$related_to_id 
                  ORDER BY stamp DESC");
            return $rows;
        }

        public static function get_row_pending($row_id, $pending_type, $onlyJson = true)
        {
            global $wpdb;
            $table = DB_PENDING;
            $row = $wpdb->get_row("SELECT * FROM $table WHERE ID=$row_id AND TYPE='$pending_type'");
            if ($row == null) {
                return false;
            } else {
                $json_array = json_decode($row->json, TRUE);
                if ($onlyJson) {
                    return $json_array;
                } else {
                    return array_merge($json_array, array("key1" => $row->key1, "key2" => $row->key2, "stamp" => $row->stamp));
                }
            }

        }

        public static function remove_pending($row_id)
        {
            global $wpdb;
            $table = DB_PENDING;
            $where = array("ID" => $row_id);
            $wpdb->delete($table, $where, array('%d'));
        }

        public static function insert_pending_object_byid($ID, $type, $json_object_string)
        {
            global $wpdb;
            return $wpdb->insert(
                DB_PENDING,
                array(
                    'type' => $type,
                    'json' => self::ensureJSONString($json_object_string),
                    'key1' => $ID,
                    'key2' => self::get_userip()),
                array('%s', '%s', '%s', '%s')
            );
        }

        public static function insert_pending_object($type, $json_object_string)
        {
            global $wpdb;
            return $wpdb->insert(DB_PENDING,
                //=--------------------------
                array('type' => $type, 'json' => self::ensureJSONString($json_object_string), 'key1' => 0, 'key2' => self::get_userip()), array('%s', '%s', '%s', '%s'));
        }

        /**
         * @param $mix
         * @return string
         */
        public static function ensureJSONString($mix)
        {
            if (is_array($mix)) {
                $mix = json_encode($mix, JSON_FORCE_OBJECT);
            }
            return $mix;
        }

        private static function get_userip()
        {
            if (is_array($_SERVER)) {
                return $userip = (in_array('X_FORWARDED_FOR', $_SERVER)) ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
            } else
                return '';
        }

        private static function get_device_info()
        {
            return $_SERVER['HTTP_USER_AGENT'];
        }

        private static function get_mac_classic()
        {
            /*
             * Getting MAC Address using PHP
             * Md. Nazmul Basher
             */
            ob_start();
            // Turn on output buffering
            system('ipconfig/all');
            //Execute external program to display output
            $mycom = ob_get_contents();
            // Capture the output into a variable
            ob_clean();
            // Clean (erase) the output buffer
            $pmac = strpos($mycom, 'Physical');
            // Find the position of Physical text
            $mac = substr($mycom, ($pmac + 36), 17);
            // Get Physical Address
            return $mac;
        }

        private static function get_mac()
        {
            exec("ipconfig /all", $arr, $retval);
            $arr[14];
            $ph = explode(":", $arr[14]);
            return trim($ph[1]);
        }

        public static function gen_order_num()
        {
            function make_seed()
            {
                list($usec, $sec) = explode(' ', microtime());
                return (float)$sec + ((float)$usec * 100000);
            }

            mt_srand(make_seed());
            return $randval = mt_rand();

        }

        public static function gen_order_str()
        {
            /* Generated a unique order number */

            $str = session_id();
            $str .= (string)time();
            $checksum = crc32($str);
            $date = date('Y-m-d');
            $order_number = $date . $checksum;

            return substr($order_number, 0, 19);
        }

        public static function manipulate_row_id_collection_remove($table, $field, $where_id, $remove_id)
        {
            global $wpdb;
            $row = $wpdb->get_var("SELECT $field FROM $table WHERE ID=$where_id");
            //   print_r($set_data);
            $excluded_list = self::exclude_string_element($row, $remove_id);
            $set_data = array();
            $set_data[$field] = $excluded_list;
            // print_r($set_data);
            return $row = $wpdb->update($table, $set_data, array('ID' => $where_id));
        }

        public static function manipulate_row_id_collection_add($table, $field, $where_id, $add_new_id)
        {
            global $wpdb;
            $row = $wpdb->get_var("SELECT $field FROM $table WHERE ID=$where_id");
            if (!empty($row)) {
                $related_collection = self::include_new_string_element($row, $add_new_id);
            } else {
                $related_collection = $add_new_id;
            }
            $set_data = array();
            $set_data[$field] = $related_collection;
            //--------------------
            //  print_r($set_data);
            return $row = $wpdb->update(DB_ORDER, $set_data, array('ID' => $where_id));
        }

        public static function include_new_string_element($string_of_number, $addNew)
        {
            $linked_jobs_unprocessed = array();

            if (!empty($string_of_number)) {
                $linked_jobs_unprocessed = explode(' ', $string_of_number);
            }

            $linked_jobs_unprocessed[] = $addNew;

            if (count($linked_jobs_unprocessed) > 1) {
                $linked_jobs_unprocessed = implode(' ', $linked_jobs_unprocessed);
            }

            return $linked_jobs_unprocessed;
        }

        public static function exclude_string_element($string_of_numbers, $toDelete)
        {
            $list_string = explode(' ', $string_of_numbers);
            $list_string = array_diff($list_string, array($toDelete));
            $list_string = implode(' ', $list_string);
            return $list_string;
        }

        public static function convert_table_order_to_job($r)
        {
            $set_service_time = $r->expect_time;
            $set_service_date = $r->expect_date;
            $service_location = $r->site_location;
            unset($r);
            return get_defined_vars();
        }

        public static function gf_get_entry_value($form_id, $lead_id, $field_id)
        {
            global $wpdb;
            /*       $sql =  $wpdb->prepare("SELECT l.*, d.field_number, d.value
                                          FROM {$wpdb->prefix}rg_lead l
                                          INNER JOIN {$wpdb->prefix}rg_lead_detail d ON l.id = d.lead_id
                                          INNER JOIN {$wpdb->prefix}rg_lead_meta m ON l.id = m.lead_id
                                          WHERE m.meta_key=%s AND m.meta_value=%s", $meta_key, $meta_value);*/
            $sql = $wpdb->prepare("SELECT value
                                   FROM {$wpdb->prefix}rg_lead_detail
                                   WHERE form_id=%d AND lead_id=%d AND field_number=%d", $form_id, $lead_id, $field_id);
            $value = $wpdb->get_var($sql);
            return $value;
        }

        /**
         * get list from gform entries with the form ID
         * @param $form_id
         * @return mixed
         */
        protected static function gf_get_form_entries($form_id)
        {
            global $wpdb;
            $listed = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "rg_lead WHERE form_id=" . $form_id . " AND status='active' ORDER BY date_created DESC");
            return $listed;
        }

        protected static function gf_update_field_value($form_id, $lead_id, $field_id, $value_replacement)
        {
            global $wpdb;

            $sql = "SELECT * FROM {$wpdb->prefix}rg_lead_detail WHERE id=%d AND form_id=%d AND field_number=%d";
            $sql = $wpdb->prepare($sql, $form_id, $lead_id, $field_id);
            $result = $wpdb->get_row($sql);

            $insert = array(
                "form_id" => $form_id,
                "lead_id" => $lead_id,
                "field_number" => $field_id,
                "value" => $value_replacement,
            );

            if (!$result) {
                $rs = $wpdb->insert($wpdb->prefix . "rg_lead_detail", $insert);
            } else {
                $rs = $wpdb->update($wpdb->prefix . "rg_lead_detail", $insert, array('id' => $result->id));
            }
            return $rs;
        }

        /**
         * if the entry row exist or not come to here
         * @param $form_id
         * @param $lead_id
         * @return bool
         */
        protected static function gf_entry_row_exist($form_id, $lead_id)
        {
            global $wpdb;
            $sql = $wpdb->prepare("SELECT COUNT(*)
                                   FROM {$wpdb->prefix}rg_lead
                                   WHERE form_id=%d AND id=%d", $form_id, $lead_id);
            $value = $wpdb->get_var($sql);
            if (intval($value) > 0) return true;
            else return false;

        }
    }

}
?>
