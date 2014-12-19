<?php
// Prevent loading this file directly
defined('ABSPATH') || exit;

/**
 * Created by PhpStorm.
 * User: hesk
 * Date: 1/11/14
 * Time: 10:12 PM
 */
class basemapinfo
{

    /**
     * @param $filename_look_up
     * @return bool|string
     */
    public static function basemapinfo_constructor($filename_look_up)
    {
        $legend_data = array(
            "legend_30_ff0000,Electric Cable Oil Pit,feature,P,oc_red",
            "legend_01_ff0000,Electric Cable Pit,feature,P,oc_red",
            "legend_31_ff0000,ATC Cable Pit,feature,M,oc_red",
            "legend_32_ff0000,Traffic Light,feature,M,oc_red",
            "legend_02_ff0000,Lamppost,feature,L,oc_red",

            "legend_33_ff0000,Illuminating Bollard,feature,M,oc_red",
            "legend_35_ff0000,TCSS Cable Pit,feature,M,oc_red",
            "legend_03_ff0000,Control Box,feature,P,oc_red",
            "legend_34_ff0000,Public Lighting Pit,feature,L,oc_red",
            "legend_36_000000,Earth Pit,feature,U,oc_dark",

            "legend_37_ffbf00,Cable TV Pit,feature,C,oc_yellow_1",
            "legend_38_dda500,PCCW Pit,feature,T,oc_yellow_2",
            "legend_39_dda500,Hutchison Pit,feature,T,oc_yellow_2",
            "legend_40_dda500,NT&T Pit,feature,T,oc_yellow_2",
            "legend_41_dda500,New World Telecom Pit,feature,T,oc_yellow_2",
            "legend_42_dda500,HKBN Pit,feature,T,oc_yellow_2",
            "legend_43_dda500,Easterstar Pit,feature,T,oc_yellow_2",
            "legend_44_dda500,WT&T Pit,feature,T,oc_yellow_2",
            "legend_45_dda500,TGT Pit,feature,T,oc_yellow_2",
            "legend_46_dda500,TRAX Pit,feature,T,oc_yellow_2",
            "legend_47_dda500,Telephone Kiosk,feature,T,oc_yellow_2",

            "legend_49_ff7f00,Gas Value,feature,G,oc_yellow_3",
            "legend_48_ff7f00,Gas Pit,feature,G,oc_yellow_3",

            "legend_50_0000ff,Fire Hydrant Pit,feature,A,oc_blue_1",
            "legend_51_0000ff,Irrigation Water,feature,A,oc_blue_1",


            "legend_04_0000ff,Meter,feature,A,oc_blue_1",
            "legend_05_0000ff,Water Valve,feature,A,oc_blue_1",
            "legend_52_0000ff,Water Valve Pit,feature,A,oc_blue_1",

            "legend_50_0000ff,Fire Hydrant Pit,feature,B,oc_blue_2",
            "legend_51_0000ff,Irrigation Water,feature,B,oc_blue_2",

            "legend_52_0007fff,Water Valve Pit,feature,B,oc_blue_2",
            "legend_04_007fff,Meter,feature,B,oc_blue_2",
            "legend_59_007fff,Water Valve,feature,B,oc_blue_2",

            "legend_53_4a9500,Storm Manhole,feature,S,oc_green_2",
            "legend_54_a5dd00,Foul Manhole,feature,F,oc_green_1",
            "legend_53_4a9500,Catch-Pit,feature,S,oc_green_2",
            "legend_56_4a9500,Gully,feature,S,oc_green_2",
            "legend_60_000000,Cooling Main Value,feature,U,oc_dark",
            "legend_57_000000,Cooling Main Value Pit/Manhole,feature,U,oc_dark",
            "legend_58_000000,Unclsasified Utility manhole,feature,U,oc_dark",


            "legend_12_ff0000,Electric Cable,line,P,oc_red,ELEC",
            "legend_13_ff0000,E&M/ATC Cable,line,M,oc_red,ATC",
            "legend_14_ff0000,Public Lighting Cable,line,L,oc_red,PL",
            "legend_15_ff0000,TCSS Cable,line,M,oc_red,TCSS",

            "legend_06_ffbf00,Cable TV Cable,line,C,oc_yellow_1,CATV",

            "legend_07_dda500,PCCW Cable,line,T,oc_yellow_2,PCCW",
            "legend_08_dda500,Hutchison Cable,line,T,oc_yellow_2,HGC",
            "legend_09_dda500,NT&T Cable,line,T,oc_yellow_2,NT&T",
            "legend_16_dda500,New World Telecom Cable,line,T,oc_yellow_2,NWT",
            "legend_17_dda500,HKBN Cable,line,T,oc_yellow_2,HKBN",
            "legend_18_dda500,Eaststar Cable,line,T,oc_yellow_2,EASTERSTAR",
            "legend_19_dda500,WT&T Cable,line,T,oc_yellow_2,WT&T",
            "legend_20_dda500,TGT Cable,line,T,oc_yellow_2,TGT",
            "legend_21_dda500,TRAX Cable,line,T,oc_yellow_2,TRAX",

            "legend_22_ff7f00,Gas Pipe,line,G,oc_yellow_3,GAS",

            "legend_10_0000ff,Fresh Water Pipe,line,A,oc_blue_1,F WAT",
            "legend_11_007fff,Salt Water Pipe,line,B,oc_blue_2,S WAT",
            "legend_23_0000ff,Irrigation Water Pipe,line,A,oc_blue_1,IR",

            "legend_24_4a9500,Storm Water Pipe,line,S,oc_green_2,STORM",
            "legend_25_a5dd00,Foul Water Pipe,line,F,oc_green_1,FOUL",

            "legend_26_000000,Cooling Main Pipe,line,U,oc_dark,COOLING MAIN",
            "legend_27_000000,Unclassified Utility Line,line,U,oc_dark,UN",
            "legend_28_4a9500,U-Channel,line,S,oc_green_2,U-C",
            "legend_29_4a9500,S-Channel,line,S,oc_green_2,S-C"
        );

        global $wpdb;
        $prepared = $wpdb->prepare("SELECT legend_info FROM onecallapp_basemap WHERE remove = 0 AND filename=%s", $filename_look_up);
        $key_legend_json = $wpdb->get_var($prepared);

        if ($key_legend_json) {
            $key_legend = array_values(json_decode($key_legend_json));
            $format_line = "<div class='line_type %s'><div class='img-box'><img src='%s'/></div><span class='%s colorline'>%s</span></div>";
            $legend_template = "<div id='legend_area' class='legend bl'><span>LEGEND:</span>%s</div>";
            $content = "";
            $content .= sprintf($format_line, 'feature', self::get_image_path_legend('ic_reference_point'), 'oc_dark', 'Reference Point');
            //======================
            $sorted_n = array();
            foreach ($key_legend as $v => $key) {
                $sorted_n[] = $key;
            }
            //======================
            asort($sorted_n);
            //======================
            foreach ($sorted_n as $key) {
                if ($key == 99) {
                    //survey boundary mode
                    $content .= sprintf($format_line, 'line', self::get_image_path_legend('ic_boundary'), 's_pink', 'Survey Boundary');
                } else {
                    $key = intval($key);
                    $row = explode(",", $legend_data[$key]);
                    if ($key < 40) {
                        //that is features
                        $content .= sprintf($format_line, $row[2], self::get_image_path_legend($row[0]), $row[4], $row[1]);
                    } else {
                        //that is line type
                        $content .= sprintf($format_line, $row[2], self::get_image_path_legend($row[0]), $row[4], $row[1]);
                    }
                }
            }
            //======================
            return sprintf($legend_template, $content);
        } else {
            return false;
        }
    }


    public static function new_legend_html($post_attachment_id)
    {
        $legend_data = array(
            "legend_30_ff0000,Electric Cable Oil Pit,feature,P,oc_red",
            "legend_01_ff0000,Electric Cable Pit,feature,P,oc_red",
            "legend_31_ff0000,ATC Cable Pit,feature,M,oc_red",
            "legend_32_ff0000,Traffic Light,feature,M,oc_red",
            "legend_02_ff0000,Lamppost,feature,L,oc_red",

            "legend_33_ff0000,Illuminating Bollard,feature,M,oc_red",
            "legend_35_ff0000,TCSS Cable Pit,feature,M,oc_red",
            "legend_03_ff0000,Control Box,feature,P,oc_red",
            "legend_34_ff0000,Public Lighting Pit,feature,L,oc_red",
            "legend_36_000000,Earth Pit,feature,U,oc_dark",

            "legend_37_ffbf00,Cable TV Pit,feature,C,oc_yellow_1",
            "legend_38_dda500,PCCW Pit,feature,T,oc_yellow_2",
            "legend_39_dda500,Hutchison Pit,feature,T,oc_yellow_2",
            "legend_40_dda500,NT&T Pit,feature,T,oc_yellow_2",
            "legend_41_dda500,New World Telecom Pit,feature,T,oc_yellow_2",
            "legend_42_dda500,HKBN Pit,feature,T,oc_yellow_2",
            "legend_43_dda500,Easterstar Pit,feature,T,oc_yellow_2",
            "legend_44_dda500,WT&T Pit,feature,T,oc_yellow_2",
            "legend_45_dda500,TGT Pit,feature,T,oc_yellow_2",
            "legend_46_dda500,TRAX Pit,feature,T,oc_yellow_2",
            "legend_47_dda500,Telephone Kiosk,feature,T,oc_yellow_2",

            "legend_49_ff7f00,Gas Value,feature,G,oc_yellow_3",
            "legend_48_ff7f00,Gas Pit,feature,G,oc_yellow_3",

            "legend_50_0000ff,Fire Hydrant Pit,feature,A,oc_blue_1",
            "legend_51_0000ff,Irrigation Water,feature,A,oc_blue_1",


            "legend_04_0000ff,Meter,feature,A,oc_blue_1",
            "legend_05_0000ff,Water Valve,feature,A,oc_blue_1",
            "legend_52_0000ff,Water Valve Pit,feature,A,oc_blue_1",

            "legend_50_0000ff,Fire Hydrant Pit,feature,B,oc_blue_2",
            "legend_51_0000ff,Irrigation Water,feature,B,oc_blue_2",

            "legend_52_0007fff,Water Valve Pit,feature,B,oc_blue_2",
            "legend_04_007fff,Meter,feature,B,oc_blue_2",
            "legend_59_007fff,Water Valve,feature,B,oc_blue_2",

            "legend_53_4a9500,Storm Manhole,feature,S,oc_green_2",
            "legend_54_a5dd00,Foul Manhole,feature,F,oc_green_1",
            "legend_53_4a9500,Catch-Pit,feature,S,oc_green_2",
            "legend_56_4a9500,Gully,feature,S,oc_green_2",
            "legend_60_000000,Cooling Main Value,feature,U,oc_dark",
            "legend_57_000000,Cooling Main Value Pit/Manhole,feature,U,oc_dark",
            "legend_58_000000,Unclsasified Utility manhole,feature,U,oc_dark",


            "legend_12_ff0000,Electric Cable,line,P,oc_red,ELEC",
            "legend_13_ff0000,E&M/ATC Cable,line,M,oc_red,ATC",
            "legend_14_ff0000,Public Lighting Cable,line,L,oc_red,PL",
            "legend_15_ff0000,TCSS Cable,line,M,oc_red,TCSS",

            "legend_06_ffbf00,Cable TV Cable,line,C,oc_yellow_1,CATV",

            "legend_07_dda500,PCCW Cable,line,T,oc_yellow_2,PCCW",
            "legend_08_dda500,Hutchison Cable,line,T,oc_yellow_2,HGC",
            "legend_09_dda500,NT&T Cable,line,T,oc_yellow_2,NT&T",
            "legend_16_dda500,New World Telecom Cable,line,T,oc_yellow_2,NWT",
            "legend_17_dda500,HKBN Cable,line,T,oc_yellow_2,HKBN",
            "legend_18_dda500,Eaststar Cable,line,T,oc_yellow_2,EASTERSTAR",
            "legend_19_dda500,WT&T Cable,line,T,oc_yellow_2,WT&T",
            "legend_20_dda500,TGT Cable,line,T,oc_yellow_2,TGT",
            "legend_21_dda500,TRAX Cable,line,T,oc_yellow_2,TRAX",

            "legend_22_ff7f00,Gas Pipe,line,G,oc_yellow_3,GAS",

            "legend_10_0000ff,Fresh Water Pipe,line,A,oc_blue_1,F WAT",
            "legend_11_007fff,Salt Water Pipe,line,B,oc_blue_2,S WAT",
            "legend_23_0000ff,Irrigation Water Pipe,line,A,oc_blue_1,IR",

            "legend_24_4a9500,Storm Water Pipe,line,S,oc_green_2,STORM",
            "legend_25_a5dd00,Foul Water Pipe,line,F,oc_green_1,FOUL",

            "legend_26_000000,Cooling Main Pipe,line,U,oc_dark,COOLING MAIN",
            "legend_27_000000,Unclassified Utility Line,line,U,oc_dark,UN",
            "legend_28_4a9500,U-Channel,line,S,oc_green_2,U-C",
            "legend_29_4a9500,S-Channel,line,S,oc_green_2,S-C"
        );

        global $wpdb;
        $prepared = $wpdb->prepare("SELECT post_content FROM $wpdb->posts WHERE ID=%d", $post_attachment_id);
        $key_legend_json = $wpdb->get_var($prepared);
        //echo $key_legend_json;
        if ($key_legend_json != '') {
            $key_legend = explode(',', $key_legend_json);
            $format_line = "<div class='line_type %s'><div class='img-box'><img src='%s'/></div><span class='%s colorline'>%s</span></div>";
            $legend_template = "<div id='legend_area' class='legend bl'><span>LEGEND:</span>%s</div>";
            $content = "";
            $content .= sprintf($format_line, 'feature', self::get_image_path_legend('ic_reference_point'), 'oc_dark', 'Reference Point');
            //======================
            $sorted_n = array();
            foreach ($key_legend as $v => $key) {
                $sorted_n[] = $key;
            }
            //======================
            asort($sorted_n);
            //======================
            foreach ($sorted_n as $key) {
                if ($key == 99) {
                    //survey boundary mode
                    $content .= sprintf($format_line, 'line', self::get_image_path_legend('ic_boundary'), 's_pink', 'Survey Boundary');
                } else {
                    $key = intval($key);
                    $row = explode(",", $legend_data[$key]);
                    if ($key < 40) {
                        //that is features
                        $content .= sprintf($format_line, $row[2], self::get_image_path_legend($row[0]), $row[4], $row[1]);
                    } else {
                        //that is line type
                        $content .= sprintf($format_line, $row[2], self::get_image_path_legend($row[0]), $row[4], $row[1]);
                    }
                }
            }
            //======================
            return sprintf($legend_template, $content);
        } else {
            return false;
        }
    }

    /**
     * @param $filename
     * @return string
     */
    private static function get_image_path_legend($filename)
    {
        return get_template_directory_uri() . "/images/legend_webuse/" . $filename . ".png";
    }

    private static function get_job_code_meta($job_code)
    {
        return array("job_code" => $job_code, "cp_id" => 425234324);
    }

    public static function wp_insert_new_post_bmap()
    {

    }

    static function random_text($qtd, $mode = "all")
    {
        //Under the string $Caracteres you write all the characters you want to be used to randomly generate the code.
        $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZabcdefghijklmnopqrstuvwxyz0123456789';
        $QuantidadeCaracteres = strlen($Caracteres) - 1;
        $Hash = NULL;
        for ($x = 1; $x <= $qtd; $x++) {
            $Posicao = rand(0, $QuantidadeCaracteres);
            $Hash .= substr($Caracteres, $Posicao, 1);
        }
        return $Hash;
    }

    /**
     *
     * @param $filename
     * @param $legend_info
     * @param $data_entries
     * @return mixed
     * @throws Exception
     */
    public static function db_insert_newupload($filename, $legend_info, $data_entries)
    {
        global $wpdb;
        try {
            $hkjb = json_decode(trim($data_entries));
            debugoc::upload_bmap_log(trim($data_entries), 10);
            $d = new DateTime();
            $name = isset($hkjb->projectid) ? $hkjb->projectid : self::random_text(6) . "(" . isset($hkjb->jobid) ? $hkjb->jobid : self::random_text(2) . ") submission";
            $user_id = isset($hkjb->userid) ? $hkjb->userid : 1;
            $post_data_list = array(
                'post_title' => $name,
                'post_status' => 'publish',
                'post_type' => HKMBASEMAP,
                'comment_status' => 'closed',
                'post_name' => $name . self::random_text(4),
                'post_author' => $user_id,
                'post_content' => $filename
            );

            $post_return_id = wp_insert_post($post_data_list, true);
            if (is_numeric($post_return_id)) {
                if (isset($hkjb->cpname))
                    add_post_meta($post_return_id, 'cpname', $hkjb->cpname, true);
                if (isset($hkjb->projectid))
                    add_post_meta($post_return_id, 'projectid', $hkjb->projectid, true);
                if (isset($hkjb->jobid))
                    add_post_meta($post_return_id, 'jobid', $hkjb->jobid, true);
                if (isset($hkjb->basemap_id_of_job))
                    add_post_meta($post_return_id, 'map_of_j_id', $hkjb->basemap_id_of_job, true);

            } else if (is_wp_error($post_return_id)) {
                //   print_r($post_return_id);
                throw new Exception("WP insert post error", 3007);

            } else {
                throw new Exception("failed to insert and publish new post unknown", 3008);

            };
            /**
             * type: 0 = upload from the user CP
             * remove: 0 = existing
             *         1 = removed
             */
            $column = array(
                'type' => 0,
                'filename' => $filename,
                'user_id_upload' => $user_id,
                'legend_info' => json_encode($legend_info),
                'entries' => $data_entries,
                'hash' => UUID::v4(),
                'job_id' => $post_return_id,
                'basemap_assigned_id' => $basemap_id_of_job,
                'remove' => 0
            );
            return $wpdb->insert(DB_BASEMAP, $column, null);
        } catch (Exception $e) {
            /**
             * process failure
             */
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }


}
