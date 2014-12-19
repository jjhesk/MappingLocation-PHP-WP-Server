<?php
/**
 * Created by PhpStorm.
 * User: Hesk
 * Date: 14年5月26日
 * Time: 上午10:46
 */
defined('ABSPATH') || exit;
if (!class_exists('oc_db_pending')) {
    class oc_db_pending
    {
        public static function actiontakencr()
        {
            global $wpdb;
            try {
                if (isset($_POST['action_entry']) && isset($_POST['id'])) {

                    $id = $_POST['id'];
                    $action_entry = $_POST['action_entry'];
                    /*
                                        $query = array('ID' => $id, 'type' => 'newcr');
                                        $n = $wpdb->delete(DB_PENDING, $query, NULL);
                                        if ($action_entry == 'approve') {
                                            $query = array('ID' => $id, 'type' => 'newcr');
                                            $n = $wpdb->delete(DB_PENDING, $query, NULL);
                                        } else if ($action_entry == 'reject') {
                                            $query = array('ID' => $id, 'type' => 'newcr');
                                            $n = $wpdb->delete(DB_PENDING, $query, NULL);
                                        }*/
                    if ($action_entry == 'approve') {
                        oc_cr::addCR($id);
                    }
                    //========================
                    api_handler::outSuccess();
                } else throw new Exception("no input", 1102);
            } catch (Exception $e) {
                api_handler::outFail($e->getCode(), $e->getMessage());
            }

            //========================
        }


        public static function actiontakencp()
        {
            global $wpdb;
            $table = DB_PENDING;

            try {
                if (isset($_POST['action_entry']) && isset($_POST['id'])) {
                    $entry_id = $_POST['id'];
                    $action_entry = $_POST['action_entry'];
                    // define("gf_cp_title", 13);
                    /*  define("gf_cp_login_name", 4);
                      define("gf_cp_login_email", 10);
                      define("gf_cp_name_first", 2);
                      define("gf_cp_name_last", 3);
                      define("gf_cp_name_chn", 5);
                      define("gf_cp_address", 7);
                      define("gf_cp_company", 6);
                      define("gf_cp_contact_1st", 8);
                      define("gf_cp_contact_2nd", 9);
                      define("gf_cp_exp", 12);
                      define("gf_cp_license_no", 11);
                      define("gf_cp_attachments", 21);
                      define("gf_cp_photo", 25);*/
                    if ($action_entry == 'approve') {
                        $success = oc_cp::addCP($entry_id);
                    } else if ($action_entry == 'reject') {
                        $success = oc_cp::trashCPApp($entry_id);
                    }
                    api_handler::outSuccess();
                } else throw new Exception("no input", 1102);
            } catch (Exception $e) {
                api_handler::outFail($e->getCode(), $e->getMessage());
            }


        }

        /**
         *
         */
        public static function actiontakencompany()
        {
            global $wpdb;
//========================
            try {
                if (isset($_POST['action_entry']) && isset($_POST['id'])) {

                    $id = $_POST['id'];
                    $action_entry = $_POST['action_entry'];
//========================


                    if ($action_entry == 'approve') {
                        //this is for the CP company
                        //get all the CRs in json

                        //get the company data aligned
                        $rowdata = oc_company::get_pending_company_row($id);

                        global $current_user;
                        $post_data_list = array(
                            'post_title' => $rowdata['shortname'],
                            'post_status' => 'publish',
                            'post_type' => HKM_COM,
                            'comment_status' => 'closed',
                            'post_name' => $rowdata['shortname'],
                            'post_author' => $current_user->ID,
                            'post_content' => ''
                        );
                        $post_return_id = wp_insert_post($post_data_list, true);
                        if (is_numeric($post_return_id)) {
                            add_post_meta($post_return_id, 'comnamefull', $rowdata['company_name'], true);
                            add_post_meta($post_return_id, 'comnameshort', $rowdata['shortname'], true);
                            add_post_meta($post_return_id, 'com_contact_person', $rowdata['contact_name'], true);
                            add_post_meta($post_return_id, 'comphoneno', $rowdata['contact_number'], true);
                            add_post_meta($post_return_id, 'comfaxno', $rowdata['contact_fax'], true);
                            add_post_meta($post_return_id, 'com_email', $rowdata['contact_email'], true);
                            add_post_meta($post_return_id, 'combrno', $rowdata['brno'], true);
                            add_post_meta($post_return_id, 'combrpdf', $rowdata['copy_br'], true);
                            //      add_post_meta($post_return_id, 'platform_id', $rowdata['file_path'], true);
                            add_post_meta($post_return_id, 'combrregistration', $rowdata['reg_date'], true);
                            //   add_post_meta($post_return_id, 'dbid', $rowdata['ID'], true);
                            //     add_post_meta($post_return_id, 'platform_id', $rowdata['referal'], true);
                            add_post_meta($post_return_id, 'com_remark', $rowdata['remark'], true);
                        }
                        $crs = oc_company::get_pending_cr_from_row($id);
                        //   $add_cr_result = oc_cr::add_cr_from_cr_list($crs);
                        $result_binding = oc_company::bind_gf_entry_id_to_post_id($id, $post_return_id);
                    } else if ($action_entry == 'reject') {
                        //this is for the CP company
                        $result_binding = oc_company::bind_gf_entry_id_to_post_id($id, -1);
                    }
                    //========================
                    api_handler::outSuccess();
                } else throw new Exception("no input", 1102);
            } catch (Exception $e) {
                api_handler::outFail($e->getCode(), $e->getMessage());
            }
            //========================
        }
    }
}