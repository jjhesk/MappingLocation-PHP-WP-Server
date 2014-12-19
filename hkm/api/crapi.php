<?php
/*
 Controller name: CR api
 Controller description: Data manipulation methods for login staffs to get the related data using Slug: api/crapi/{method} . <br>Author: Heskemo Kam
 */
if (!class_exists('JSON_API_Crapi_Controller')) {
    class JSON_API_Crapi_Controller
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

        /**
         * get the listed info on the queued job requests
         * @return array
         */
        public static function getqueuedorderslist()
        {
            global $json_api;
            try {
                if (isset($json_api->query->type)) {
                    $t = $json_api->query->type;
                    $data = array();
                    if ($t == 'processed') {

                    } else if ($t == 'all') {


                    } else {
                        throw new Exception("invalid param", 1337);
                    }
                };
                api_handler::outSuccessDataTable($data);
            } catch (Exception $e) {
                api_handler::outFail($e->getCode(), $e->getMessage());
            }


        }

        public static function get_new_service_order()
        {
            //oc_db_order
        }


        public static function form_cr_check()
        {
            global $json_api;
            try {
                if (empty($json_api->query->email)) throw new Exception("email cannot be empty", 1336);
                if (empty($json_api->query->username)) throw new Exception("user name cannot be empty", 1334);
                if (email_exists($json_api->query->email)) throw new Exception("email is in use", 1339);
                if (username_exists($json_api->query->username)) throw new Exception("user name is in use", 1337);
                api_handler::outSuccess();
            } catch (Exception $e) {
                api_handler::outFail($e->getCode(), $e->getMessage());
            }
        }
    }

}
?>