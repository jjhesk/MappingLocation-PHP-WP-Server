<?php
/*
 Controller name: Android api
 Controller description: Data manipulation methods for login staffs to get the related data using Slug: api/crapi/{method} . <br>Author: Heskemo Kam
 */
if (!class_exists('JSON_API_Appaccess_Controller')) {
    class JSON_API_Appaccess_Controller
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

        public static function get_cp_info()
        {
            //oc_db_order
        }

        public static function get_pending_projects()
        {
            //oc_db_order
        }

        //OLD UPLOAD BASEMAP FOR UNIT TESTING
        public static function submission_basemap()
        {
            try {
                $app_upload = new image_upload_api();
                $app_upload->actnew_basemap_return();
                api_handler::outSuccess();
            } catch (Exception $e) {
                /**
                 * process failure
                 */
                api_handler::outFail($e->getCode(), $e->getMessage());
            }
        }

        /**
         * upload and submit the app data into the system.
         * the return of the submission data only form the android application
         */
        public static function submission_report()
        {
            //oc_db_order
            $host_upload = new submission('machine_data');
            $result_id = $host_upload->uploadcpdata();
            $status = intval($result_id) > 0 ? "success" : "failure";
            $message = intval($result_id) > 0 ? "success, please read the upload system log with 552169. return ID:" . $result_id : "data upload failure";
            debugoc::upload_bmap_log('submission_report return: ' . $message, 552169);
            return array('status' => $status, 'result' => $result_id, 'message' => $message);
        }

        public static function submission_signatures()
        {
            global $json_api;
            try {
                $target = $json_api->query->target;
                $jobid = $json_api->query->pid;
                $host_upload = new submission($target, $jobid, 'sign');
                $done = $host_upload->return_image_list_submission();
                debugoc::upload_bmap_log('submission_signatures return:' . $done, 552169);
                return api_handler::outSuccess(true);
            } catch (Exception $e) {
                /**
                 * process failure
                 */
                return api_handler::outFail($e->getCode(), $e->getMessage(), true);
            }
        }

        public static function submission_site_pictures()
        {
            global $json_api;
            //   $app_upload_pictures = new image_upload_api();
            //  $app_upload_pictures->actnow();
            try {
                $target = $json_api->query->target;
                $jobid = $json_api->query->pid;
                debugoc::upload_bmap_log('submission_site_pictures start:', 552169);
                /*    $app_upload = new image_upload_api();
                    $app_upload->actnew_basemap_return();*/
                $host_upload = new submission($target, $jobid, 'sitephoto');
                $done = $host_upload->return_image_list_submission();
                debugoc::upload_bmap_log('submission_site_pictures return:' . $done, 552169);
                return api_handler::outSuccess(true);
            } catch (Exception $e) {
                /**
                 * process failure
                 */
                return api_handler::outFail($e->getCode(), $e->getMessage(), true);
            }
        }

        public static function submission_return_base_maps()
        {
            global $json_api;

            try {
                $target = $json_api->query->target;
                $jobid = $json_api->query->pid;
                $legend_info = $json_api->query->legendinfo;
                $host_upload = new submission($target, $jobid, 'basemap');
                $done = $host_upload->return_image_list_submission();
                debugoc::upload_bmap_log('submission_return_base_maps return:' . $done, 552169);
                return api_handler::outSuccess(true);
            } catch (Exception $e) {
                /**
                 * process failure
                 */
                return api_handler::outFail($e->getCode(), $e->getMessage(), true);
            }
        }

        public static function get_my_jobs_market()
        {
            oc_job_list::data_source_cp_list();
        }

        public static function get_my_jobs_progress()
        {
            if (!is_user_logged_in()) do_action('json_api_auth_external');
            oc_job_list::data_src_my_job_progress();
        }

    }

}