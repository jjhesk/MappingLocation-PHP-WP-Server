<?php



/* AJAX RESPONSE IN JSON */
/*
 * DEVELOPED BY HESKEMO 2012
 * @hkmcrossreference_imglist
 * @id
 * @type
 * @field
 */
if (!function_exists("hkmcrossreference_imglist")) {
    add_action('wp_ajax_hkmcrossreference', 'hkmcrossreference_imglist');
    add_action('wp_ajax_nopriv_hkmcrossreference', 'hkmcrossreference_imglist');
    function hkmcrossreference_imglist()
    {
        $faliure = array("status" => "failure");
        $get_id = $_POST['id'];
        $type = $_POST['type'];
        $customfield = $_POST['field'];
        if (empty($customfield) || empty($get_id) || empty($type)) {
            echo json_encode($faliure);
            exit;
        } else
            //----> $posttype, $id, $customfield
            echo json_encode(hkm_cross_reference::metabox_get_listimgurls($type, $get_id, $customfield, "large"), false);
        exit;
    }

}
/*
 * DEVELOPED BY HESKEMO 2012
 * @hkmcrossreference_imglist
 * @id
 * @type
 * @field
 */
if (!function_exists("hkmcrossreference_cat")) {
    add_action('wp_ajax_hkmcrossref_cat_level_1', 'hkmcrossreference_cat');
    add_action('wp_ajax_nopriv_hkmcrossref_cat_level_1', 'hkmcrossreference_cat');
    function hkmcrossreference_cat()
    {
        $faliure = array("status" => "failure");
        //the plug for the post
        $slug = $_POST['slug'];
        //the taxonomy type for the
        $tax = $_POST['tax'];
        //the post type to be returned
        $type = $_POST['type'];
        if (empty($slug) || empty($tax) || empty($type)) {
            echo json_encode($faliure);
            exit;
        } else
            //----> $posttype, $id, $customfield
            echo json_encode(hkm_cross_reference::list_tax_posts($type, $slug, $tax), false);
        exit;
    }

}


// action = printFormK1
// n = {generated nonce}
// order_id = {the number}
add_action('wp_ajax_printFormK1', 'print_order_form');
add_action('wp_ajax_nopriv_printFormK1', 'print_order_form');

function print_order_form()
{
    $orderID = $_POST['order_id'];
    $noucekey = $_POST['n'];
    if (is_user_logged_in()) {
        $cNonce_v = NONCE_SALT . get_current_user_id() . '_' . str_replace('.', '', gettimeofday(true));
    } else {
        $cNonce_v = NONCE_SALT . '_' . str_replace('.', '', gettimeofday(true));
    }

    if (!wp_verify_nonce(is_user_logged_in, $cNonce_v))
        exit('Sorry!');

    if (empty($orderID) || $orderID == null) {
        exit('order id!');
    }
    // response output
    //  header("Content-Type: application/json");
    // HTTP/1.1
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');

    // IMPORTANT: don't forget to "exit"
    exit;

}

function content_form_order($order_id)
{

}

function zip_download()
{
    //  if you are planing to make a download script like this one:
    $mm_type = "application/octet-stream";
    header("Cache-Control: public, must-revalidate");
    header("Pragma: hack");
    header("Content-Type: " . $mm_type);
    header("Content-Length: " . (string)(filesize($fullpath)));
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header("Content-Transfer-Encoding: binary\n");
    readfile($fullpath);

    //you will notice that the zip files becomes invalid after download, thats because all files downloaded starts with empty line which is a problem for the zip files
    //This can be fixed with adding ob_start() at the beginning of the script and od_end_clean() just before the readfile()
}

function get_oc_template($filename)
{
    $path = locate_template('parts/' . $filename . '.php', false);
    ob_start();
    if (!empty($path))
        load_template($path);
    else
        echo "no path defined::" . $path . " :filename::" . $filename;
    return ob_get_clean();
}


?>