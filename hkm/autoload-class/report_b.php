<?php

/**
 * Created by PhpStorm.
 * User: hesk
 * Date: 1/12/14
 * Time: 4:42 PM
 */
class report_b extends reportmodel
{
    private $filename_key;
    private $current_row;

    function __construct()
    {

        add_action('report_sketch_draw_head', array(__CLASS__, 'report_sketch_draw_head'), 10, 1);
        add_action('report_table_cable_detection', array(__CLASS__, 'report_table_cable_detection'), 10, 1);
        add_action('report_sketch_draw_head_new', array(__CLASS__, 'report_sketch_draw_head_new'), 10, 1);
        parent::__construct();
    }


    public static function report_table_cable_detection()
    {
        global $wpdb;
        //hash code of the file name
        if (isset($_GET['h'])) {
            //   $g = new report_b();
            //   echo $g->get_report_b_table_content($_GET['h']);
            $prepared = $wpdb->prepare("SELECT * FROM onecallapp_basemap WHERE remove = 0 AND hash=%s", $_GET['h']);
            $file_data = $wpdb->get_row($prepared);
            $key_legend_json = $wpdb->get_row($prepared);
            $template_row = get_oc_template('report_tablecabledetection');
            if ($key_legend_json) {
                //$key_legend = json_decode($key_legend_json);
                $content_html = "";
                /**
                 * isset($series['label']) ? $series['label'] : "",
                 * isset($series['width']) ? $series['width'] : "",
                 * isset($series['estdepth']) ? $series['estdepth'] : "",
                 * isset($series['pta']) ? $series['pta'] : "",
                 * isset($series['ptb']) ? $series['ptb'] : "",
                 * isset($series['remark']) ? $series['remark'] : "",
                 * isset($series['remark_a']) ? $series['remark_a'] : ""
                 */
                //  print_r($key_legend_json);
                //  print_r($key_legend_json->entries);
                $btag = str_replace('[\"', "", $key_legend_json->entries);
                $btag = str_replace('\"]', "", $btag);
                $elel = explode('\",\"', $btag);
                //  $kas = json_decode("{" . $key_legend_json->entries . "}", true);

                $block_rows = "";
                foreach ($elel as $series) {
                    $ele = explode(",", $series);
                    $context = array(
                        'labelposition' => $ele[4],
                        'width' => __("N/A", HKM_LANGUAGE_PACK),
                        'est_depth' => $ele[2],
                        'd_point_a' => $ele[0],
                        'd_point_b' => $ele[1],
                        'remark' => __("N/A", HKM_LANGUAGE_PACK),
                        'after_remark' => __("N/A", HKM_LANGUAGE_PACK),
                    );

                    $block_rows .= parent::apply($template_row, $context);
                }
                echo $block_rows;
            } else "[json is empty]";
        } else {
            echo "[h is empty]";
        }

    }

    public static function report_sketch_draw_head_new($job_id)
    {
        $context = array(
            "jobs" => get_post_meta($job_id, "single", true),
            "project_no" => get_post_meta($job_id, "odk_projectid", true),
            "location" => get_post_meta($job_id, "odk_address", true),
            "survey_date" => "",
            "cp_name" => get_post_meta($job_id, "odk_cp_name", true),
            "cp_no" => get_post_meta($job_id, "offerjbcpid", true),
            //  "cp_no"=>get_post_meta($job_id, "offerjbcpid", true),
        );
        $after = parent::apply(get_oc_template('report_sketchdrawhead'), $context);
        echo $after;
    }

    public static function report_sketch_draw_head($filename)
    {
        $before = get_oc_template('report_sketchdrawhead');
        $job_id = parent::get_jobid_by_filename($filename)->job_id;
        $context = array(
            "jobs" => get_post_meta($job_id, "single", true),
        );
        $after = parent::apply($before, $context);
        echo $after;
    }


    /**
     * Json object is returned
     * @param $filename
     * @return mixed
     */
    public static function get_hash_by_filename($filename)
    {
        global $wpdb;
        $prepared = $wpdb->prepare("SELECT * FROM onecallapp_basemap WHERE remove = 0 AND filename=%s", $filename);
        $key_legend_json = $wpdb->get_row($prepared);
        return emtpy($key_legend_json->hash) ? false : $key_legend_json->hash;
    }


    public function update_report_b_entries()
    {

    }


}
