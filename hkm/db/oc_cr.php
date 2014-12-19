<?php

defined('ABSPATH') || exit;
if (!class_exists('oc_cr')) {
    class oc_cr extends oc_db_account
    {
        public static function remove_pendings_from_com($rowKey)
        {
            global $wpdb;
            $key = oc_db::get_depending_key_from_row_pending($rowKey);
            $query = array('key1' => $key, 'type' => 'newcr');
            $n = $wpdb->delete(DB_PENDING, $query, NULL);
            return $n;
        }

        public static function add_cr_from_cr_list($json_cr_list_from_gf_entries, $sendpassword = false)
        {
            if (is_array($json_cr_list_from_gf_entries))
                foreach ($json_cr_list_from_gf_entries as $jsonCR) {
                    $User = self::create_user_account($jsonCR->name, $jsonCR->email, 'cr', array(
                        'phone' => $jsonCR->phone
                    ));
                    if ($sendpassword) parent::retrieve_password($User->ID);
                } else {
                return FALSE;
            }
            return TRUE;
        }

        public static function addCR($entry_id)
        {
            try {
                $data = array(
                    "price" => 0,
                    "first_name" => oc_db::gf_get_entry_value(GF_CR_REG_FORM, $entry_id, gf_cr_person_name),
                    "display_name" => oc_db::gf_get_entry_value(GF_CR_REG_FORM, $entry_id, gf_cr_person_name),
                    "company" => oc_db::gf_get_entry_value(GF_CR_REG_FORM, $entry_id, gf_cr_company),
                    "phone1" => oc_db::gf_get_entry_value(GF_CR_REG_FORM, $entry_id, gf_cr_person_phone)
                );

                $name = oc_db::gf_get_entry_value(GF_CR_REG_FORM, $entry_id, gf_cr_login_name);
                $email = oc_db::gf_get_entry_value(GF_CR_REG_FORM, $entry_id, gf_cr_login_email);

                $user = self::create_user_account($name, $email, 'cr', $data);
            } catch (Exception $e) {
                throw $e;
            }

        }

        public static function add_new_from_pendingcompany($rowKey)
        {
            //this is the row key of the new pending company
            $key = oc_db::get_depending_key_from_row_pending($rowKey);
            //   print_r($key);
            if ($key == -1)
                die("key row is not found");
            $data_crs = oc_db::get_rows_pending($key, 'newcr');

            if (is_array($data_crs))
                foreach ($data_crs as $rowObject) {
                    $json_array = json_decode($rowObject->json, TRUE);
                    extract($json_array, EXTR_OVERWRITE);
                    $meta_data_array = array("phone" => $tmp_phone, "company_id" => $key);
                    // print_r(oc_db_account::get_unique_new_username($tmp_name));
                    $random_password = wp_generate_password(12, TRUE);
                    $user_data = array('ID' => '', //
                        'user_pass' => $random_password, //
                        'user_login' => parent::get_unique_new_username($tmp_name), //
                        'display_name' => $tmp_name, //
                        'first_name' => "", //
                        'last_name' => "", //
                        'user_email' => $tmp_email,
                        'role' => 'cr' //
                    );

                    $user_id = wp_insert_user($user_data);
                    parent::AddUserMeta($user_id, $meta_data_array);
                    parent::retrieve_password($user_id);
                } else {
                return FALSE;
            }
            return TRUE;
        }

        public static function get_pending_cr_db()
        {

            $data = array();
            $L = parent::gf_get_form_entries(GF_CR_REG_FORM);
            if ($L) {
                foreach ($L as $row) {
                    if (intval(parent::gf_get_entry_value(GF_CR_REG_FORM, $row->id, gf_bind_cr_user_id)) == 0) {
                        $email = parent::gf_get_entry_value(GF_CR_REG_FORM, $row->id, gf_cr_login_email);
                        if (!email_exists($email)) {
                            $data[] = array(
                                "login_name" => parent::gf_get_entry_value(GF_CR_REG_FORM, $row->id, gf_cr_login_name),
                                "login_email" =>$email,
                                "person_name" => parent::gf_get_entry_value(GF_CR_REG_FORM, $row->id, gf_cr_person_name),
                                "person_phone" => parent::gf_get_entry_value(GF_CR_REG_FORM, $row->id, gf_cr_person_phone),
                                "company" =>  parent::gf_get_entry_value(GF_CR_REG_FORM, $row->id, gf_cr_company),
                                //get_the_title($company_id),
                                "lid" => $row->id,
                            );
                        }
                    }
                }
            }
            return $data;

        }


        public static function render_admin_page_approve_cr()
        {
            global $wpdb, $action_url, $approve_list_content, $notified_action;
            $approve_list_content = "";
            $action_url = admin_url('edit.php?post_type=occompany&page=approvals');
            echo get_oc_template('admin_page_approve_cr');
        }
    }

}
?>