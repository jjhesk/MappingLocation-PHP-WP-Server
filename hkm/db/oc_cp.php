<?php

defined('ABSPATH') || exit;
if (!class_exists('oc_cp')) {
    class  oc_cp extends oc_db_account
    {
        /**
         * @param null $rating
         * @return WP_User_Query
         */
        public static function get_all($rating = null)
        {
            $sql_requirement = array(
                'role' => 'cp',
                'orderby' => 'registered',
                'order' => 'ASC');
            if ($rating != null && $rating != 'no_req') {
                //array( 'meta_key' => 'country', 'meta_value' => 'Israel' )
                $sql_requirement['meta_key'] = 'rate';
                $sql_requirement['meta_value'] = $rating;
            }
            $query = new WP_User_Query($sql_requirement);
            return $query;
        }

        /**
         * @param $q_results
         * @return string
         */
        public static function query_result_ids_string($q_results)
        {
            return parent::query_result_ids_string($q_results);
        }

        /**
         * @param WP_User_Query $q_results
         * @param array $default
         * @return array
         */
        public static function query_result_options_metabox(WP_User_Query $q_results, $default = array("0" => "select a CP"))
        {
            return parent::query_result_options_metabox($q_results, $default);
        }

        public static function ui_select_option_render()
        {
            $query = self::get_all();
            if (empty($query->results))
                return __("no CP found.", HKM_LANGUAGE_PACK);
            else
                return parent::ui_query_select($query, "cp_select_id", "Choose a CP", "cp_select_id");
        }

        public static function trashCPApp($entry_id)
        {

        }

        public static function addCP($entry_id)
        {
            try {

                $data = array(
                    "price" => 0,
                    "rate" => 1,
                    "first_name" => oc_db::gf_get_entry_value(GF_CP_REG_FORM, $entry_id, gf_cp_name_first),
                    "last_name" => oc_db::gf_get_entry_value(GF_CP_REG_FORM, $entry_id, gf_cp_name_last),
                    "display_name" => oc_db::gf_get_entry_value(GF_CP_REG_FORM, $entry_id, gf_cp_title) . " " . oc_db::gf_get_entry_value(GF_CP_REG_FORM, $entry_id, gf_cp_name_chn),
                    "address" => oc_db::gf_get_entry_value(GF_CP_REG_FORM, $entry_id, gf_cp_address),
                    "company" => oc_db::gf_get_entry_value(GF_CP_REG_FORM, $entry_id, gf_cp_company),
                    "phone1" => oc_db::gf_get_entry_value(GF_CP_REG_FORM, $entry_id, gf_cp_contact_1st),
                    "phone2" => oc_db::gf_get_entry_value(GF_CP_REG_FORM, $entry_id, gf_cp_contact_2nd),
                    "cp_cert" => oc_db::gf_get_entry_value(GF_CP_REG_FORM, $entry_id, gf_cp_license_no),
                    "cp_certexp" => oc_db::gf_get_entry_value(GF_CP_REG_FORM, $entry_id, gf_cp_exp),
                    "portrait" => oc_db::gf_get_entry_value(GF_CP_REG_FORM, $entry_id, gf_cp_photo),
                    "gf_cp_attachments" => oc_db::gf_get_entry_value(GF_CP_REG_FORM, $entry_id, gf_cp_attachments),
                );

                $name = oc_db::gf_get_entry_value(GF_CP_REG_FORM, $entry_id, gf_cp_login_name);
                $email = oc_db::gf_get_entry_value(GF_CP_REG_FORM, $entry_id, gf_cp_login_email);

                $user = self::create_user_account($name, $email, 'cp', $data);
            } catch (Exception $e) {
                throw $e;
            }

        }

        public static function add_new_from_pending($rowKey)
        {
            $pending_type = 'newcp';
            $data = oc_db::get_row_pending($rowKey, $pending_type, TRUE);
            // extract($data, EXTR_OVERWRITE);
            //TODO: $index_id is the row id, pending_id
            if (is_array($data)) {
                $random_password = wp_generate_password(12, TRUE);

                $user_data = array('ID' => '', //
                    'user_pass' => $random_password, //
                    'user_login' => parent::get_unique_new_username($data['user_name']), //
                    'display_name' => $data['user_name'], //
                    'first_name' => $data['english_name'], //
                    'last_name' => $data['title_name'], //
                    'user_email' => $data['user_email'], //
                    'role' => 'cp' //
                    //'role' => get_option('default_role') // Use default role or another role, e.g. 'editor'
                );

                //echo $random_password;

                $extended_keys = array_merge($data, array('level' => 0));
                $user_id = wp_insert_user($user_data);

                // echo $user_id;
                //wp_set_password($lastName, $user_id);
                //$user = new WP_User($user_id);
                //$user -> remove_role('subscriber');
                //update user ID and the role of the company representative
                // wp_insert_user(array('ID' => $newUserId, 'role' => 'cr'));
                //===========================
                // $extended_keys = $data;
                parent::AddUserMeta($user_id, $extended_keys);
                parent::retrieve_password($user_id);
                return true;
            } else {
                return "variable data is not array";
            }
        }

        public static function render_admin_page_approve_cp()
        {
            global $wpdb, $action_url, $approve_list_content, $notified_action;
            $approve_list_content = "";
            $action_url = admin_url('edit.php?post_type=occompany&page=approvals');
            echo get_oc_template('admin_page_approve_cp');
        }

        public static function get_pending_cp_db()
        {

            $data = array();
            $L = parent::gf_get_form_entries(GF_CP_REG_FORM);
            if ($L) {
                foreach ($L as $row) {

                    $company_id = parent::gf_get_entry_value(GF_CP_REG_FORM, $row->id, gf_cr_company);
                    $email = parent::gf_get_entry_value(GF_CP_REG_FORM, $row->id, gf_cp_login_email);
                    if (!email_exists($email)) {
                        $data[] = array(
                            "login_name" => parent::gf_get_entry_value(GF_CP_REG_FORM, $row->id, gf_cp_login_name),
                            "license" => parent::gf_get_entry_value(GF_CP_REG_FORM, $row->id, gf_cp_license_no),
                            "login_email" => $email,
                            "person_phone" => parent::gf_get_entry_value(GF_CP_REG_FORM, $row->id, gf_cp_contact_1st),
                            "person_name" => parent::gf_get_entry_value(GF_CP_REG_FORM, $row->id, gf_cp_login_name),
                            "company" => parent::gf_get_entry_value(GF_CP_REG_FORM, $row->id, gf_cp_company),
                            "gf_cp_attachments" => json_decode(parent::gf_get_entry_value(GF_CP_REG_FORM, $row->id, gf_cp_attachments), false),
                            "lid" => $row->id,
                        );
                    }

                }
            }
            return $data;

        }

    }

}
?>
