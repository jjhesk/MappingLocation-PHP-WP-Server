<?php

defined('ABSPATH') || exit;
if (!class_exists('oc_job_list')) {
    class oc_job_list
    {
        /**
         *     ajax: "http://onecallapp.imusictech.net/api/appaccess/get_my_jobs_progress/",
         *
         */
        public static function get_options_new()
        {
            $c = array(
                "-1" => "Please select current assigned JOB ID"
            );

            global $current_user, $wpdb;
            try {


                if (is_user_logged_in()) {
                   // $c[-1] = "Please select current assigned JOB ID";

                    // if (!oc_db_account::has_role("cp")) throw new Exception("role is not right");
                    $cp = $current_user->ID;
                    $postmeta = $wpdb->postmeta;
                    $boardcast = DB_BOARDCAST;
                    $project_code = METAPREFIX . 'projectid';
                    $doc_status = METAPREFIX . 'docstatus';

                    $sql = "SELECT

                    A.job_id AS post_id,
                    CC.meta_value AS project_id,
                    D.meta_value AS status

                    FROM $boardcast AS A
                    RIGHT JOIN $postmeta AS B
                    ON A.job_id = B.post_id
                    RIGHT JOIN $postmeta AS CC
                    ON A.job_id = CC.post_id
                    RIGHT JOIN $postmeta AS D
                    ON A.job_id = D.post_id
                    WHERE
                    B.meta_key='offerjbcpid'
                    AND B.meta_value=$cp
                    AND CC.meta_key='$project_code'
                    AND D.meta_key='$doc_status'
                    AND A.cp_id=$cp";
                    $result = $wpdb->get_results($sql);
                    foreach ($result as $row) {
                        $c[$row->post_id] = $row->post_id . " - " . $row->project_id;
                    }
                }
            } catch (Exception $e) {

            }
            return $c;
        }

        public static function data_src_my_job_progress()
        {
            $c = array();
            global $current_user, $wpdb;
            if (is_user_logged_in()) {
                if (isset($current_user->ID)) {
                    $postmeta = $wpdb->postmeta;
                    $boardcast = DB_BOARDCAST;
                    $post = $wpdb->posts;
                    $cpID = $current_user->ID;
                    $project_code = METAPREFIX . 'projectid';
                    $doc_status = METAPREFIX . 'docstatus';
                    $basemap_id_location = METAPREFIX . 'base_map';
                    $address = METAPREFIX . 'address';
                    $sql = "SELECT

                    A.job_id AS post_id,
                    CC.meta_value AS project_id,
                    D.meta_value AS status,

                    F.meta_value AS address_tag

                    FROM $boardcast AS A
                    RIGHT JOIN $postmeta AS B
                    ON A.job_id = B.post_id
                    RIGHT JOIN $postmeta AS CC
                    ON A.job_id = CC.post_id
                    RIGHT JOIN $postmeta AS D
                    ON A.job_id = D.post_id

                    RIGHT JOIN $postmeta AS F
                    ON A.job_id = F.post_id
                    WHERE
                    B.meta_key='offerjbcpid'


                    AND B.meta_value=$cpID
                    AND CC.meta_key='$project_code'
                    AND D.meta_key='$doc_status'

                    AND F.meta_key='$address'
                    AND A.cp_id=$cpID";

                    $sql2 = "SELECT ID, guid FROM $post WHERE post_type='attachment' AND ID=%d";
                    /*  $sql = "SELECT * FROM $postmeta AS A
                      RIGHT JOIN $boardcast AS B ON B.job_id = A.post_id
                      WHERE A.meta_key='offerjbcpid' AND A.meta_value=$cpID
                      GROUP BY A.post_id
                      ";*/
                    $result = $wpdb->get_results($sql);
                    //    debugoc::upload_bmap_log($sql, 10321);

                    foreach ($result as $row) {
                        $id = $row->post_id;
                        $basemap_ids = get_post_meta($id, $basemap_id_location, false);
                        if (count($basemap_ids) > 0) {
                            $arr = array();
                            foreach ($basemap_ids as $id) {
                                $arr[] = $wpdb->get_row($wpdb->prepare($sql2, $id));
                            }
                            $row->basemap_detail = $arr;
                        }

                        $c[] = $row;
                    }
                }
                api_handler::outSuccessDataTable($c);
            } else
                api_handler::outFail(1101, "please login");
        }

        /**
         *
         *   ajax: "http://onecallapp.imusictech.net/api/appaccess/get_my_jobs_market/",
         * retrieve a list of market cp list with the related job offer details
         *
         */
        public static function data_source_cp_list()
        {
            $c = array();
            global $current_user, $wpdb;
            if (is_user_logged_in()) {
                if (isset($current_user->ID)) {
                    //SELECT * FROM `onecallapp_operation_market` AS A LEFT JOIN `oc_postmeta` AS B ON A.job_id = B.post_id WHERE B.meta_key ='odk_reference_loc'
                    $sql = "SELECT A.cp_status AS cp_exp, A.t AS t, A.job_id AS job_id, A.job_status AS jstatus, B.meta_value AS loc, IF(C.meta_value=A.cp_id, 'yes','no') AS offer_you";
                    $sql .= " FROM " . DB_BOARDCAST . " AS A ";
                    $sql .= " LEFT JOIN " . $wpdb->postmeta . " AS B";
                    $sql .= " ON A.job_id = B.post_id ";
                    $sql .= " LEFT JOIN " . $wpdb->postmeta . " AS C";
                    $sql .= " ON A.job_id = C.post_id ";

                    //where clause starts in here
                    $sql .= " WHERE B.meta_key='" . METAPREFIX . "address'";
                    $sql .= " AND C.meta_key='offerjbcpid'";
                    $sql .= " AND A.cp_id = " . $current_user->ID;
                    $result = $wpdb->get_results($sql);
                    foreach ($result as $row) {
                        $c[] = $row;
                    }
                }
                return api_handler::outSuccessDataTable($c);
            } else
                return api_handler::outFail(1101, "please login");
        }

        public static function render_page_list()
        {

            if (!oc_db_account::has_role('cp')) {
                echo "sorry you dont have the permission to access this page . ";
                return;
            }
//            echo get_oc_template('cp_profile');
            echo get_oc_template('admin_page_job_opennings');
        }

        public static function render_page_offer()
        {

            if (!oc_db_account::has_role('cp')) {
                echo "sorry you dont have the permission to access this page . ";
                return;
            }

            echo get_oc_template('job_opennings');
        }

        public static function render_page_task()
        {
            if (!oc_db_account::has_role('cp')) {
                echo "sorry you dont have the permission to access this page . ";
                return;
            }

            echo get_oc_template('admin_page_cp_job_task');
        }
    }

}
