<?php
//developed by Heskeyo Kam
//2013 @ imusictech
defined('ABSPATH') || exit;
if (!class_exists('oc_project')) {
    class  oc_project
    {
        public $table = DB_PROJECT;

        function __construct()
        {


        }

        public function search()
        {
        }

        /**
         * @param $result
         * @param array $default
         * @return array
         */
        private function seralize($result, $default = array())
        {
            $ar = array();
            if (!empty($default)) $ar = $default;
            foreach ($result as $res) {
                $ar[$res->K] = $res->V;
            }
            return $ar;
        }


        /**
         * @return array
         */
        function find_existing_ids_by_post_job_for_select_option()
        {
            global $wpdb;
            $sql = "SELECT post_id K, meta_value V FROM " . $wpdb->postmeta . "
            WHERE meta_key='" . METAPREFIX . "projectid'
            GROUP BY meta_value ORDER BY post_id DESC";
            $result = $wpdb->get_results($sql) or die(mysql_error());
            return $this->seralize($result);
        }

        public static function select_ui_metabox()
        {
            $instance = new oc_project();
            $data = $instance->find_existing_ids_by_post_job_for_select_option();
            $data = array_merge(array("", "select projec id"), $data);
            return $data;
        }

        public static function select_ui()
        {
            $instance = new oc_project();
            $data = $instance->find_existing_ids_by_post_job_for_select_option();
            //$data = array_merge(array("", "select projec id"), $data);
            $ui = new ui_handler();
            return $ui->options_ui_from_series($data, "input_project_selected_id", "select project ID");
        }

        public static function add_new_project($new_id)
        {
            global $wpdb;
            $column = array('project_code' => $new_id,);
            return $wpdb->insert(DB_PROJECT, $column, null);
        }

        public static function get_jobs_by($key, $value)
        {
        }

        public static function get_jobs_focus($isFocus)
        {
            global $wpdb;
            $table = DB_JOB;
            if (is_numeric($isFocus)) {
                if ($isFocus === 1) {
                    return $wpdb->get_var("SELECT $key FROM $table WHERE del=$byID");
                } else {
                    return $wpdb->get_var("SELECT $key FROM $table WHERE ID=$byID");
                }

            } else {

            }
        }

        public static function get_projects_select()
        {
            global $wpdb;
            $table_name = DB_DISTRICT;
            $instance = new self();
            $sql = "SELECT p.project_code K, CONCAT(p.project_code,' - ',p.district) V
            FROM $instance->table AS p
            RIGHT JOIN $table_name AS d ON p.district=d.ID
            GROUP BY p.project_code
            ORDER BY p.tupdate DESC";
            $result = $wpdb->get_results($sql) or die(mysql_error());
            return $instance->seralize($result, array("select a district", "-1"));
        }

        public static function get_loc_by_project($project_code)
        {

        }

        public static function get_districts_select()
        {
            global $wpdb;
            $table_name = DB_DISTRICT;
            $instance = new self();
            $sql = "SELECT ID K, CONCAT(eng,' - ',hk) V FROM $table_name ORDER BY area DESC";
            $result = $wpdb->get_results($sql) or die(mysql_error());
            return $instance->seralize($result, array("select a district", "-1"));
        }

        public static function insert_ref_row($project, $jobid, $district)
        {
            global $wpdb;
            $table = DB_PROJECT;
            $data_bind = array("job_id" => $jobid, "project_code" => $project, "district" => $district);
            $sqlr = $wpdb->get_row("SELECT * FROM $table WHERE job_id=$jobid");
            if (!$sqlr) {
                $dt = new DateTime();
                $sql = $wpdb->insert(DB_PROJECT, array_merge($data_bind, array(
                    "tcreate" => $dt->getTimestamp()
                )));
            } else {
                $sqlr1 = $wpdb->update(DB_PROJECT, $data_bind, array("job_id" => $jobid));
            }
        }

        public static function init_table()
        {
            $sql = "
           CREATE TABLE IF NOT EXISTS onecallapp_project (
             ID bigint(20) unsigned NOT NULL AUTO_INCREMENT,
             job_id bigint(20) NOT NULL,
             project_code varchar(36) COLLATE utf8_unicode_ci NOT NULL,
             del tinyint(4) NOT NULL DEFAULT '0',
             tupdate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
             tcreate timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
             PRIMARY KEY (ID),
             UNIQUE KEY project_code (project_code)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
            return $sql;

        }

        public static function init_table_district()
        {
            $sql = "CREATE TABLE IF NOT EXISTS onecallapp_district (
             ID bigint(20) NOT NULL AUTO_INCREMENT,
             eng varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
             hk varchar(20) COLLATE utf8_unicode_ci NOT NULL,
             area enum('NT','HK','KLN') COLLATE utf8_unicode_ci NOT NULL,
             PRIMARY KEY (ID)
            ) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Hong Kong District Table'
            ";
            return $sql;
        }
    }

}
?>
