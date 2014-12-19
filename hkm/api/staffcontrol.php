<?php
/*
 Controller name: Staff api
 Controller description: Data manipulation methods for login staffs to get the related data using Slug: api/staffcontrol/{method} . <br>Author: Heskemo Kam
 */
if (!class_exists('JSON_API_Staffcontrol_Controller')) {
    class JSON_API_Staffcontrol_Controller
    {
        public static function unitTest()
        {
            global $json_api;
            $n1 = $json_api->query->n1;
            $n2 = $json_api->query->n2;
            $op = $json_api->query->op;
            $status = 'failure';
            if ($op == 'addition') {
                $result = $n1 + $n2;
                $status = 'success';
            } else {
                $op = 'no input';
                $result = '';
            }

            return array('status' => $status, 'operation' => $op, 'result' => $result);
        }

        public static function enter_CR_List()
        {
            $id = $_POST["package_id"];
            $data = str_replace('\"', '"', $_POST["packages"]);
            $data = json_decode($data, TRUE);
            gfExt::post_registration_complementary_cr($id, $data);
            return array('datatoshow' => $data, 'result' => "1");
            //echo $json_api -> query -> data;
            //echo "yes";
            //echo $_POST["data"];
            //print_r($data);
            //echo
            //print_r($json_api -> query -> package_id);
        }

        public static function getPendingCP()
        {
            $obj = oc_db::get_pending_by_type('newcp');
            $data = array();
            if ($obj) {
                foreach ($obj as $key => $value) {
                    $list = json_decode($value->json, TRUE);
                    unset($value->json);
                    $data[] = (object)array_merge((array)$value, (array)$list);
                }
                $data = array_values($data);
                $total = count($obj);
            } else {
                $total = 0;
            }

            return array('total' => $total, 'src' => $data);
        }

        public static function getPendingCOM()
        {
            $obj = oc_db::get_pending_by_type('newcom');
            $data = array();
            if ($obj) {
                foreach ($obj as $key => $value) {
                    $list = json_decode($value->json, TRUE);
                    $list['copy_br'] = site_url() . "/wp-content/uploads" . $list['copy_br'];
                    $id = intval($value->ID);
                    $related_to = intval($value->key1);
                    $pending_cr = oc_db::get_pending_cr_from_newcom_byKeyid($related_to);
                    $total = array("total_rep" => (!$pending_cr) ? 0 : count($pending_cr));
                    // $total = array("total_rep" => (!$pending_cr) ? 0 : count($pending_cr));
                    unset($value->json);
                    $data[] = (object)array_merge((array)$total, (array)$value, (array)$list);
                }
                $data = array_values($data);
                $total = count($obj);
            } else {
                $total = 0;
            }

            return array('total' => $total, 'src' => $data);
        }

        /**
         * data table js use
         * @return array
         */
        public static function get_pending_company_list_V2()
        {
            $results = oc_company::get_pending_company_list_db();
            return array('result' => 'success', 'data' => $results);
        }

        /**
         * Module: report bank cms
         * Triggered: javascript ajax request for the dataTable JS
         * @return array
         */
        public static function get_report_templates_list_cms()
        {
            $results = oc_report::get_templates();
            return array('result' => 'success', 'data' => $results);
        }


        /**
         * Module: report bank cms
         * Triggered: javascript ajax request for the submission dataTable JS
         */
        public static function get_report_list_for_job_cms()
        {
            global $json_api;
            $jid = $json_api->query->jobid;
            $results = oc_report::get_report($jid);
            return array('result' => 'success', 'data' => $results);
        }

        /**
         * Module: report bank cms
         * Triggered: javascript ajax request for the submission dataTable JS
         */
        public static function get_submission_list_cms()
        {
            global $json_api;
            $j = $json_api->query->jobid;
            $result = oc_report::get_submission_list($j);
            return array('result' => 'success', 'data' => $result);
        }

        /**
         * Module: report bank cms
         * Triggered: javascript ajax request for the submission dataTable JS
         */
        public static function get_submission_data()
        {
            global $json_api;
            $j = $json_api->query->jobid;
            $s = $json_api->query->sub_id;
            $result = oc_report::get_submission_sub($j, $s);
            return array('result' => 'success', 'data' => $result);
        }

        /**
         * data table js use
         * @return array
         */
        public static function get_pending_cr_indie()
        {
            $results = oc_cr::get_pending_cr_db();
            return array('result' => 'success', 'data' => $results);
        }
        /**
         * data table js use
         * @return array
         */
        public static function get_pending_cp_pending_list()
        {
            $results = oc_cp::get_pending_cp_db();
            return array('result' => 'success', 'data' => $results);
        }

        /**
         * data table js use
         * @return array
         */
        public static function get_ordered_cps()
        {
            oc_db_order::api_get_order_data_package();
        }

        public static function acceptPending()
        {
            global $json_api;
            $id = $json_api->query->id;
            $type = $json_api->query->type;
            return array('result' => oc_db::action_pending_process('accept', $id, $type));
        }

        public static function rejectPending()
        {
            global $json_api;
            $id = $json_api->query->id;
            $type = $json_api->query->type;
            return array('result' => oc_db::action_pending_process('reject', $id, $type));
        }

        public static function get_new_service_order()
        {
            // oc_db_order::get_pendings();
            $content_detail = oc_db_order::get_pendings();
            $number = count($content_detail);
            return array('result' => $content_detail, 'total' => $number);
        }

        /*

         public static function add_tools() {
         global $json_api;
         $date = $json_api -> query -> date;
         $time = $json_api -> query -> time;
         return array('result' => oc_tools_management::add_reserve($date, $time, $tool_id, $job_id));
         }
         */
        public static function get_tool_set_by_job()
        {
            global $json_api;
            $jobid = $json_api->query->jobid;
            return array('result' => oc_tools_management::get_toolset_by_job($jobid));
        }

        public static function get_tools()
        {
            global $json_api;
            $_date = $json_api->query->date;
            $_time = $json_api->query->time;
            // echo $_date; echo $_time;
            return array('result' => oc_tools_management::get_available($_date, $_time));
        }

        public static function add_new_project()
        {
            global $json_api;
            $id = $json_api->query->project_id;
            return array('result' => oc_project::add_new_project($id));
        }

        public static function add_new_job()
        {
            global $json_api;
            $order_id = $json_api->query->order_id;
            return array('result' => oc_db_order::create_new_job_from_order_id($order_id));
        }

        public static function get_job_data()
        {
            global $json_api;
            $order_id = $json_api->query->order_id;
            return array('result' => oc_db_order::get_jobs_from_order_id($order_id));
        }

        public static function save_editing_data_from_job()
        {
            global $json_api;
            $order_id = $json_api->query->order_ref_no;
            $job_id = $json_api->query->ID;
            $toolset = $json_api->query->toolset;
            $time = $json_api->query->timeset;
            $date = $json_api->query->dateset;
            $star = $json_api->query->star_rate;
            //$time_in_24_hour_format = date("H:i:s", strtotime($time));
            // print_r($time_in_24_hour_format);
            // 24-hour time to 12-hour time
            // $time_in_12_hour_format = date("g:i a", strtotime("13:30"));
            //  echo $order_id;
            //  echo $job_id;
            //  echo $toolset;
            if (empty($order_id) || empty($job_id) || empty($toolset) || empty($time) || empty($date) || empty($star)) {
                // 12-hour time to 24-hour time
                $time_in_24_hour_format = date("H:i:s", strtotime($time));
                $system_date = date("H:i", strtotime($date));
                $result_tool_set = oc_tools_management::add_reserve($date, $time_in_24_hour_format, $toolset, $job_id);
                // $result_tool_set = false;
            } else {
                $result_tool_set = false;
            }
            $g = "";
            return array('result_tool_set' => $result_tool_set, 'result_workingschedule_set' => $g);
        }

        public static function remove_job_approve()
        {
            global $json_api;
            $order_id = $json_api->query->order_id;
            $job_id = $json_api->query->job_id;
            if ($order_id == NULL || $job_id == NULL) {
                return array('result' => "missing order_id or job_id");
            } else {
                return array('result' => oc_db_order::remove_approve_job_process($order_id, $job_id));
            }

        }

    }

}
?>