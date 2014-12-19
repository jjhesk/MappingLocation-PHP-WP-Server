<?php
/**
 * Created by PhpStorm.
 * User: Hesk
 * Date: 14年5月15日
 * Time: 下午5:01
 */
defined('ABSPATH') || exit;
if (!class_exists('oc_market_notification')):
    class oc_market_notification
    {
        private $job_post_id, $requirement, $where;

        function __construct($post_id)
        {
            $this->job_post_id = $post_id;
        }

        /**
         * FLOW 1
         * @param null $arr
         * @return $this
         */
        public function add_requirement($arr = null)
        {
            $this->requirement = $arr;
            return $this;
        }

        /**
         * FLOW 1
         */
        public function send_job_notifications()
        {
            global $wpdb;
            if (!empty($this->requirement)) {
                $q_results = oc_cp::get_all($this->requirement);
            } else {
                $q_results = oc_cp::get_all();
            }
            if (!empty($q_results->results)) {
                foreach ($q_results->results as $user) {
                    $user_id = $user->ID;
                    $job_id = $this->job_post_id;
                    $result = $wpdb->get_row("SELECT * FROM " . DB_BOARDCAST . " WHERE cp_id=" . $user_id . " AND job_id=" . $job_id);
                    if ($result) {
                        $n = intval($result->n) + 1;
                        $wpdb->update(DB_BOARDCAST, array("n" => $n), array("ID" => $result->ID));
                    } else {
                        $column = array(
                            'cp_id' => $user_id,
                            'job_id' => $job_id,
                            'job_status' => "OPEN",
                            'cp_status' => "RES_NONE"
                        );
                        $wpdb->insert(DB_BOARDCAST, $column, null);
                    }
                }
            }
        }

        /**
         *
         * @return integer
         */
        public function get_notifications_sent_times()
        {
            global $wpdb;
            return $wpdb->get_var("SELECT MAX(n) AS N FROM " . DB_BOARDCAST . " WHERE job_id=" . $this->job_post_id);
        }

        /**
         *
         * @return integer
         */
        public function get_total_cp_sent()
        {
            global $wpdb;
            return $wpdb->get_var("SELECT COUNT(*) AS N FROM " . DB_BOARDCAST . " WHERE job_id=" . $this->job_post_id);
        }

        /**
         * @return integer
         */
        public function get_total_response()
        {
            global $wpdb;
            return $wpdb->get_var("SELECT COUNT(*) AS N FROM " . DB_BOARDCAST . " WHERE cp_status NOT LIKE 'RES_NONE' AND job_id=" . $this->job_post_id);
        }

        /**
         * @return CP user id or false
         */
        public function get_cp_for_job_offered()
        {
            global $wpdb;

            return $wpdb->get_var("SELECT cp_id AS CPID FROM " . DB_BOARDCAST . " WHERE cp_status NOT LIKE 'RES_NONE' AND job_id=" . $this->job_post_id);
        }

        /**
         * FLOW 2
         * @param $where_clause
         * @return $this
         */
        public function add_clause($where_clause)
        {
            $this->where = $where_clause;
            return $this;
        }

        /**
         * FLOW 2
         * list all cp related to board cast market
         * @return mixed
         */
        public function get_notified_cps()
        {
            global $wpdb;
            //  $where_clause = "job_id=" . $this->job_post_id;
            //. " " . !empty($this->where) ? "AND" . $this->where : "";
            //  $sql = "SELECT A.cp_id AS K, CONCAT(B.user_nicename,' [',A.cp_status,']') AS V, A.cp_status AS V2 FROM ";
            //SELECT MAX(points) FROM tmp

            $sql = "SELECT A.cp_id AS K, B.user_nicename AS V, A.cp_status AS V2 FROM ";
            $sql .= DB_BOARDCAST . " AS A LEFT JOIN " . $wpdb->users . " AS B ON A.cp_id=B.ID
            WHERE A.job_id=" . $this->job_post_id . " ORDER BY A.t DESC, A.cp_status DESC";
            // return $sql;
            $results = $wpdb->get_results($sql);
            return empty($results) ? false : $results;
        }

        public static function get_all_cps()
        {
            global $wpdb;
            $tb = DB_BOARDCAST;
            $tbuser = $wpdb->users;
            $result = array();
            $args = array('role' => 'cp');
            $user_query = new WP_User_Query($args);
            if (!empty($user_query->results)) {
                foreach ($user_query->results as $user) {
                    $result[] = array(
                        "status" => "NEW",
                        "cp_id" => $user->id,
                        "cpname" => $user->display_name . "(" . $user->user_login . ")"
                    );
                }
                return $result;
            } else return false;
        }

        public function get_notified_cps_db()
        {
            global $wpdb;
            $tb = DB_BOARDCAST;
            $tbuser = $wpdb->users;
            $job_pid = $this->job_post_id;
            $tbusermeta = $wpdb->usermeta;
            /*    $sql = "SELECT A.*, M.meta_value FROM $tb AS A
                RIGHT JOIN $tbuser AS B ON A.cp_id=B.ID
                RIGHT JOIN $tbusermeta AS M ON A.cp_id=M.ID
                WHERE
                A.job_id=$job_post_id
                AND M.meta_key='rating'
                ORDER BY A.t DESC, A.cp_status DESC";*/
            $sql = "SELECT A.cp_id AS cp_id, B.user_nicename AS cpname, A.cp_status AS status FROM $tb AS A
            RIGHT JOIN $tbuser AS B ON A.cp_id=B.ID

            WHERE
            A.job_id=$job_pid

            ORDER BY A.t DESC, A.cp_status DESC";

            $results = $wpdb->get_results($sql);
            return empty($results) ? false : $results;
        }

        /**
         * FLOW 3
         * list all cp related to board cast market
         * @param $response
         * @return mixed
         */
        public function cp_response($response)
        {
            global $current_user, $wpdb;
            $lock_on_row = array(
                "cp_id" => $current_user->ID,
                "job_id" => $this->job_post_id,
            );
            if ($response == "apply") {
                $wpdb->update(DB_BOARDCAST, array(
                    "cp_status" => 'RES_YES',
                ), $lock_on_row);
            }

            if ($response == "reject") {
                $wpdb->update(DB_BOARDCAST, array(
                    "cp_status" => 'RES_NO',
                ), $lock_on_row);
            }

            if ($response == "accept_offer") {
                $wpdb->update(DB_BOARDCAST, array(
                    "cp_status" => 'RES_YES',
                ), $lock_on_row);
            }
        }

        /**
         * FLOW 4
         *
         * @param $post_id
         * @param $cp_id
         */
        public static function notify_job_offer($post_id, $cp_id)
        {
            global $wpdb;
            $cp_id = get_post_meta($post_id, 'offerjbcpid', true);
            $cp = new WP_User($cp_id);
            $user_rating = get_user_meta($cp_id, 'rate', true);
            $c_rating = get_post_meta($post_id, METAPREFIX . 'cp_rating', true);
            update_post_meta($post_id, METAPREFIX . 'jobstatus', 'closed');
            update_post_meta($post_id, 'odk_cp_name', $cp->display_name);
            update_post_meta($post_id, 'odk_cp_cert', get_user_meta($cp_id, 'cp_cert', true));
            if (empty($c_rating)) {
                add_post_meta($post_id, METAPREFIX . 'cp_rating', $user_rating, true);
            } else
                update_post_meta($post_id, METAPREFIX . 'cp_rating', $user_rating);

            $wpdb->update(DB_BOARDCAST, array(
                "job_status" => "OFFERED",
            ), array(
                "job_id" => $post_id
            ));
        }

        /**
         * send request to the CP and the status is also completed. android device will show immediately
         * @param $post_id
         * @param $cp_id
         */
        public static function notify_job_offer_and_complete($post_id, $cp_id)
        {
            global $wpdb;
            //$cp_id = get_post_meta($post_id, 'offerjbcpid', true);
            $cp = new WP_User($cp_id);
            $user_rating = get_user_meta($cp_id, 'rate', true);
            $c_rating = get_post_meta($post_id, METAPREFIX . 'cp_rating', true);
            update_post_meta($post_id, METAPREFIX . 'jobstatus', 'hired');
            update_post_meta($post_id, 'odk_cp_name', $cp->display_name);
            update_post_meta($post_id, 'odk_cp_cert', get_user_meta($cp_id, 'cp_cert', true));
            if (empty($c_rating)) {
                add_post_meta($post_id, METAPREFIX . 'cp_rating', $user_rating, true);
            } else
                update_post_meta($post_id, METAPREFIX . 'cp_rating', $user_rating);


            $result = $wpdb->get_row("SELECT * FROM " . DB_BOARDCAST . " WHERE cp_id=" . $cp_id . " AND job_id=" . $post_id);

            if ($result) {
                $n = intval($result->n) + 1;
                $wpdb->update(DB_BOARDCAST, array(
                    "n" => $n,
                    "job_status" => "OFFERED",
                    "cp_status" => "RES_YES",
                ), array("ID" => $result->ID));
            } else {
                $column = array(
                    'cp_id' => $cp_id,
                    'job_id' => $post_id,
                    'job_status' => "OFFERED",
                    'cp_status' => "RES_YES"
                );
                $wpdb->insert(DB_BOARDCAST, $column, null);
            }

        }

        /**
         *
         * @return string
         */
        public static function init_table()
        {
            $sql = "
            CREATE TABLE IF NOT EXISTS onecallapp_operation_market (
             cp_id bigint(20) NOT NULL,
             job_id bigint(20) NOT NULL,
             job_status enum('OPEN','CLOSE','OFFERED') CHARACTER SET utf8 NOT NULL,
             cp_status enum('RES_NONE','RES_YES','RES_NO') NOT NULL,
             ID bigint(20) NOT NULL AUTO_INCREMENT,
             t timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
             n smallint(6) NOT NULL DEFAULT '1' COMMENT 'notify N times',
             PRIMARY KEY (ID)
            ) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=ucs2";
            return $sql;
        }
    }
endif;