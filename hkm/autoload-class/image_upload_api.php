<?php
/**
 * Created by PhpStorm.
 * User: Hesk
 * Date: 14年5月19日
 * Time: 下午5:00
 */
defined('ABSPATH') || exit;

class image_upload_api
{
    private $uploaded_return;

    function __construct()
    {

    }


    function my_upload_dir($upload)
    {

        $upload['subdir'] = '/sub-dir-to-use' . $upload['subdir'];
        $upload['path'] = $upload['basedir'] . $upload['subdir'];
        $upload['url'] = $upload['baseurl'] . $upload['subdir'];
        return $upload;

    }

    function trnew()
    {

        add_filter('upload_dir', 'my_upload_dir');

        $upload = wp_upload_dir();

        remove_filter('upload_dir', 'my_upload_dir');


    }

    function actnew_basemap_return()
    {
        try {

            if (!isset($_POST["action"]) || !isset($_POST["legend"]) || !isset($_POST["image"]) || !isset($_POST["basicdata"])) {
                throw new Exception("incomplete params", 1103);
            }
            $file_type = ".jpg";
            $now = date("Y-m-d_H-i-s");
            /**
             * check for name with the existing file
             */
            do {
                //waiting in here while uploading the data into the server
                $file_name = $now . "_" . app_submission::random_text(10) . $file_type;
            } while (file_exists(OC_RETURNBASEMAP_UPLOADPATH . $file_name));

            /**
             * process done and success
             */
            $length_array = json_decode($_POST['legend']);
            $post_image_64_data_stream = app_submission::base64_to_jpeg($_POST["image"]);
            $upload_status = app_submission::process_img($post_image_64_data_stream, OC_RETURNBASEMAP_UPLOADPATH . $file_name);
            //waiting for completion task
            $db_status = basemapinfo::db_insert_newupload($file_name, $length_array, $_POST["basicdata"]);

            if ($upload_status || $db_status) {
                api_handler::outSuccess();
            } else {
                throw new Exception("upload failed or interrupted", 1104);
            }
            api_handler::outSuccess();
        } catch (Exception $e) {
            /**
             * process failure
             */
            api_handler::outFail($e->getCode(), $e->getMessage());
        }
    }

    function actnow_site_pictures()
    {
        try {
            if (isset($_FILES)) {
                foreach ($_FILES as $file => $array) {
                    if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                        throw new Exception("upload error : " . $_FILES[$file]['error'], 1101);
                    }
                    //todo: need to fix the problem from the files posting form using $_FILES
                    $id = media_handle_upload($file, null);
                    $text = app_submission::random_text(9);
                    $renew_post = array(
                        'ID' => $id,
                        'post_content' => $text
                    );
                    wp_update_post($renew_post);
                    $this->uploaded_return[] = array(
                        'post_id' => $id,
                        'time_stamp' => $blogtime = current_time('mysql')
                    );

                }
                api_handler::outSuccessData($this->uploaded_return);
            }
        } catch (Exception $e) {
            api_handler::outFail($e->getCode(), $e->getMessage());
        }
    }

} 