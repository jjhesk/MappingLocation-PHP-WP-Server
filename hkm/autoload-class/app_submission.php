<?php

/**
 * Created by PhpStorm.
 * User: Hesk
 * Date: 13年12月5日
 * Time: 下午1:50
 */
class app_submission
{
    static function get_header_info($filename_look_up){
        global $wpdb;
        $prepared = $wpdb->prepare("SELECT legend_info FROM onecallapp_basemap WHERE remove = 0 AND filename=%s", $filename_look_up);
        $key_legend_json = $wpdb->get_var($prepared);

    }
    static function path_print_file()
    {
        echo self::get_rawimage_path_uri($_POST['filename']);
    }

    static function print_legend()
    {
        echo basemapinfo::basemapinfo_constructor($_POST['filename']);
    }


    static function dataEncode($str)
    {
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(OC_UPLOAD_KEY), $str, MCRYPT_MODE_CBC, md5(md5(OC_UPLOAD_KEY))));
    }

    static function dataDecode($encoded)
    {
        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(OC_UPLOAD_KEY), base64_decode($encoded), MCRYPT_MODE_CBC, md5(md5(OC_UPLOAD_KEY))), "\0");
    }

    static function showImg($path)
    {
        $ui = "<img src=\"";
        $ui .= $path;
        $ui .= "\">";
        return $ui;
    }

    static function base64_to_jpeg($base64_string)
    {
        return base64_decode($base64_string);
    }

    static function base64_to_jpeg_write($base64_string, $output_file)
    {
        $ifp = fopen($output_file, "wb");
        fwrite($ifp, base64_decode($base64_string));
        fclose($ifp);
        return ($output_file);
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


    static function decode_array_legend()
    {


    }

    static function process_img($image_map_stream_64, $file_path)
    {
        try {
            $ifp = fopen($file_path, "wb");
            fwrite($ifp, $image_map_stream_64);
            fclose($ifp);
            return true;
        } catch (Exception $e) {
            /**
             * process failure
             */
            //   echo 'Caught exception: ', $e->getMessage(), "\n";
            return false;
        }
    }

    static function graphic_print_file_new($filename)
    {
        $physical_path = self::get_rawimage_path_dir($filename);
        $physical_path_uri = self::get_rawimage_path_uri($filename);
        $frame_src = get_template_directory_uri() . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "frame.jpg";
        $legendpath = get_template_directory_uri() . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "legend_webuse" . DIRECTORY_SEPARATOR . "frame.jpg";
    }

    static function get_rawimage_path_dir($full_filename)
    {
        $uploads = wp_upload_dir();
        return $uploads['basedir'] . DIRECTORY_SEPARATOR . 'returnbasemap' . DIRECTORY_SEPARATOR . $full_filename;
    }

    static function get_rawimage_path_uri($full_filename)
    {
        $uploads = wp_upload_dir();
        return $uploads['baseurl'] . "/returnbasemap/" . $full_filename;
    }


    /**
     * UI - for the print image list
     * connected to the template call
     * @source:  print_list.php
     * each from submission will redirected to graphic_print method
     */
    static function printing_list()
    {
        /**
         * get all image files with a .jpg extension.
         */
        $images = glob(OC_RETURNBASEMAP_UPLOADPATH . "*.jpg");
        $uploads = wp_upload_dir();

        $big_ui_list = '<div class="ui_container">';
        /**
         * print each file name
         */
        foreach ($images as $image) {

            $filename = self::filename_with_path_to_filename($image);
            $file_date = self::filename_with_path_to_date_str_with_underscore($image);
            $display_data_time = self::filename_with_path_to_date_pretty($image);
            // $dateOnly = self::filename_with_path_to_date($image);
            //     $myString = Date_Difference::getStringResolved(new DateTime($date2));
            $full_filename = $file_date . "_" . $filename; //the actual raw file name


            $ui = '<div class="ui_print_item">';
            $pointer = get_permalink(OC_PRINT_SINGLE_BASEMAP);

            $date_reference_image = self::filename_with_path_to_date_str($image);

            $filename_for_process = self::filename_with_path_to_filename($image);

            $ui .= "<form method=POST action=\"$pointer\">";
            $ui .= "<input type=submit value=Review>";
            $ui .= "<input type=hidden id=filename name=filename value=" . $full_filename . " >";
            //$ui .= "<input type=hidden id=filename name=filename value=\"".$image."\" >";


            $ui .= $display_data_time . " uploaded.";
            $ui .= "</form>";
            $ui .= "</div>";
            // echo $ui;

            $big_ui_list .= $ui;

        }
        $big_ui_list .= "</div>";
        echo $big_ui_list;
    }

    static function filename_with_path_to_filename($filename_with_path)
    {
        $path = explode("/", $filename_with_path);
        $filename = explode("_", $path[(sizeof($path) - 1)]);

        return $filename[2];
    }

    static function filename_with_path_to_date_str($filename_with_path)
    {
        $path = explode("/", $filename_with_path);
        $filename = explode("_", $path[(sizeof($path) - 1)]);
        $date = $filename[0];
        $time = self::convert_date_format($filename[1], '-', ':');

        return $date . " " . $time;
    }

    static function filename_with_path_to_date_str_with_underscore($filename_with_path)
    {
        $path = explode("/", $filename_with_path);
        $filename = explode("_", $path[(sizeof($path) - 1)]);
        $date = $filename[0];
        $time = self::convert_date_format($filename[1], '-', '-');

        return $date . "_" . $time;
    }

    static function filename_with_path_to_date_pretty($filename_with_path)
    {
        $path = explode("/", $filename_with_path);
        $filename = explode("_", $path[(sizeof($path) - 1)]);
        $date = $filename[0];
        $time = self::convert_date_format($filename[1], '-', ':');
        return $date . " " . $time;
    }

    static function filename_with_path_to_date($filename_with_path)
    {
        $path = explode("/", $filename_with_path);
        $filename = explode("_", $path[(sizeof($path) - 1)]);
        $date = $filename[0];
        return $date;
    }

    static function convert_date_format($time_str, $ori_symbol, $new_symbol)
    {
        $time_str = explode($ori_symbol, $time_str);
        $result = $time_str[0] . $new_symbol . $time_str[1] . $new_symbol . $time_str[2];
        return $result;
    }

}

?>