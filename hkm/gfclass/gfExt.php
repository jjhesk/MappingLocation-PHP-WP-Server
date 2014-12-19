<?php
//developed by Heskeyo Kam
//2013 @ imusictech
// Prevent loading this file directly
defined('ABSPATH') || exit;
include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (!class_exists('gfExt')) {
    class gfExt extends gformBase
    {
        //TODO: this piece is initialized fron the ini.php
        public function init()
        {
            if (self::is_gform_activated()) {
                add_filter("gform_pre_submission_filter_" . GF_REP_REGISTRATION_FORM, array(__CLASS__, "user_registration_cr"));
                //add_filter("gform_pre_submission_filter_6", array(__CLASS__, "registration_com"));
                add_filter("gform_confirmation_" . GF_CP_REG_FORM, array(__CLASS__, "post_registration_cp"), 10, 4);
                add_filter("gform_confirmation_" . GF_NEW_COM_FORM, array(__CLASS__, "post_registration_com_confirm"), 10, 4);
                add_filter("gform_confirmation_" . GF_SERVICE_ORDER_FORM, array(__CLASS__, "post_cp_service_order"), 10, 4);
                add_filter("gform_confirmation_" . GF_SERVICE_ORDER_FORM_INTERNAL, array(__CLASS__, "post_cp_service_order"), 10, 4);
                //adding selection drop down menu
                add_filter("gform_pre_render", array(__CLASS__, "gform_content_modify"));
                //change the upload filter
                add_filter("gform_upload_path", array(__CLASS__, "post_upload_path_extend"), 10, 2);
                // add_action("gform_after_submission_6", array(__CLASS__, "post_registration_com"), 10, 2);
                // add_filter("gform_before_resend_notifications_8", array(__CLASS__, "change_subject"), 10, 2);
                add_action("gform_enqueue_scripts", array(__CLASS__, "enqueue_custom_script"), 10, 2);

                //the email form check
                add_filter("gform_validation", array(__CLASS__, "check_form"));
                //   add_filter("gform_ajax_spinner_url", array(__CLASS__, "spinner_url"), 10, 2);

            } else {
                if (class_exists('hkmdebug\core\log_entry')) {
                }
                echo "gravity form is not activated please make sure that the GForm is activated.";
            }
        }

        public static function spinner_url($image_src, $form)
        {
            return "http://www.somedomain.com/spinner.png";
        }

        public static function enqueue_custom_script($form, $is_ajax)
        {
            if (($form["id"] == GF_SERVICE_ORDER_FORM || $form["id"] == GF_SERVICE_ORDER_FORM_INTERNAL) && $is_ajax
            ) {
                wp_enqueue_script("gfordersupport");
                $object_setting = parent::getSettingParams($form["id"]);
                wp_localize_script("gfordersupport", 'gfsetting', $object_setting);
            }
            if ($form["id"] == GF_NEW_COM_FORM && $is_ajax) {
                wp_enqueue_script("gfnewcomsupport");
                $object_setting = parent::getSettingParams($form["id"]);
                wp_localize_script("gfnewcomsupport", 'gfsetting', $object_setting);
            }


            wp_enqueue_style("gfcsssupport");
        }

        public static function gform_content_modify($form)
        {
            global $wpdb;
            //only populating drop down for form id 5

            // if ($form["id"] != 8)
            //    return $form;

            foreach ($form["fields"] as &$field)
                if ($form["id"] == GF_REP_REGISTRATION_FORM && $field["id"] == fieldid_companyname) {
                    //populate_dropdown
                    $field["choices"] = oc_company::get_list_drop_down_selection();
                }
            return $form;

        }

        public function change_subject($form, $lead_ids)
        {
            $original_subject = $form["notification"]["subject"];
            $form["notification"]["subject"] = "Resending - " . $original_subject;
            return $form;
        }

        private static function is_gform_activated()
        {
            return is_plugin_active('gravityforms/gravityforms.php');
        }

        /*

         public static function registration_com($form) {
         $type = 'newcom';
         $field_data = self::get_newcom_formfields();
         oc_db::insert_pending_object($type, json_encode($field_data, JSON_FORCE_OBJECT));
         return $form;
         }

         */
        public static function post_cp_service_order($confirmation, $form, $lead, $ajax)
        {
            //insert_pending_object_byid_cr
            $data = self::convert_neworder($lead);
            unset($data['entry']);
            //the user needs to login the system and then make it work
            $current_user = wp_get_current_user();
            $rolelist = $current_user->roles;
            $success = false;
            if (in_array('cr', $rolelist)) {
                $companyid = get_user_meta($current_user->ID, 'company_id', TRUE);
                if ($companyid > 0) {
                    //to ensure that all data entry is ordered by a CR
                    oc_db_order::addOrder($lead['id'], $data, $current_user->ID, $companyid);
                    $success = true;
                    return 'Order success, the order Reference ID is ' . $lead['id'];
                }
            }
            return 'Order submission success, CR company info is not presented. Please notify onecall for further info.';
        }

        public static function post_registration_com_confirm($confirmation, $form, $lead, $ajax)
        {
            $data = self::convert_newcom($lead);
            $pending_type = 'newcom';
            oc_db::insert_pending_object_byid($lead['id'], $pending_type, $data);
            return parent::confirm_msg($lead['id']);
        }

        public static function post_upload_path_extend($path_info, $form_id)
        {
            if ($form_id == GF_NEW_COM_FORM) {
                $path_info["path"] = OC_BR_UPLOADPATH;
                $path_info["url"] = "/br/";
            }
            if ($form_id == GF_CP_REG_FORM) {
                $path_info["path"] = OC_CERT_UPLOADPATH;
                $path_info["url"] = "/certification/";
            }
            return $path_info;
        }

        public static function post_registration_cp($confirmation, $form, $lead, $ajax)
        {
            $data = self::convert_newcp($lead);
            unset($data['entry']);
            $pending_type = 'newcp';
            $user_id = username_exists($data['user_name']);
            if ($user_id == null) {
                //$confirmation = __('Success.');
                oc_db::insert_pending_object_byid($lead['id'], $pending_type, $data);
            } else {
                $confirmation = __('User already exists.  Please try again.');
            }
            return $confirmation;
        }

        public static function user_registration_cr($form)
        {
            $nicename = parent::getPostVal(fieldid_nicename);
            $displayname = parent::getPostVal(fieldid_displayname);
            $user_email = parent::getPostVal(fieldid_useremail);
            $phonenumber = parent::getPostVal(fieldid_phonenumber);
            //process the registered user name for login purposes
            $proc_name = str_replace(' ', '_', parent::getPostVal(fieldid_name));
            $user_id = username_exists($proc_name);
            if (!$user_id and email_exists($user_email) == false) {
                $random_password = wp_generate_password($length = 12, $include_standard_special_chars = TRUE);
                $user_id = wp_create_user($proc_name, $random_password, $user_email);
                //      wp_insert_user(array('ID' => $user_id, 'role' => 'cr'));
                $user = new WP_User($user_id);
                //     $user_points = method_to_get_user_points();
                $user->remove_role('subscriber');
                $user->add_role('cr');
                // if ($user_points > 100) {
                //     $user -> remove_role('subscriber');
                //     $user -> add_role('cr');
                // }
                add_user_meta($user_id, 'company_id', 1);
                add_user_meta($user_id, 'temp_password', $random_password);
                //pass this value to the java script
                $passed = TRUE;
            } else {
                $random_password = __('User already exists.  Password inherited.');
                //pass this value to the java script
                $passed = FALSE;
            }
            // code
            // here
            if ($passed == true) {
                // this will send the autoresponder which is already set up
                return $form;
            } else {
                // clear out any autoresponder values
                $form['autoResponder'] = array( //=========
                    'toField' => '', //=========
                    'bcc' => '', //=========
                    'fromName' => '', //=========
                    'from' => '', //=========
                    'replyTo' => '', //=========
                    'subject' => '', //=========
                    'message' => '', //=========
                    'disableAutoformat' => '');
                return $form;
            }

        }

        public static function post_registration_complementary_cr($id, $jsondata)
        {
            foreach ($jsondata as $array) {
                //oc_db::insert_pending_object_byid($id, 'newcr', $array);
                oc_db::insert_pending_object_byid($id, 'newcr', $array);
            }
        }

        private static function convert_neworder($entry)
        {
            $site_location = $entry['1'];
            $expect_date = $entry['2'];
            $expect_time = $entry['3'];
            $json = $entry['4'];
            return get_defined_vars();
        }

        public static function check_form($validation_result)
        {
            $result = false;
            $form = $validation_result["form"];
            $formID = $form['id'];
            $current_page = rgpost('gform_source_page_number_' . $formID) ? rgpost('gform_source_page_number_' . $formID) : 1;
            if ($formID == GF_CR_REG_FORM && $current_page == 2) {
                $result = gfchecking::check_field_user_account($form['fields'], gf_cr_login_name, gf_cr_login_email);
            }
            if ($formID == GF_CP_REG_FORM && $current_page == 2) {
                $result = gfchecking::check_field_user_account($form['fields'], gf_cp_login_name, gf_cp_login_email);
            }
            if ($formID == GF_NEW_COM_FORM && $current_page == 3) {
               // $result = gfchecking::check_field_exist_brNO($form['fields'], nc_brnumber);
               $result = gfchecking::check_issue_dates($form['fields'], nc_brissuedate, nc_exp_date);
                //nc_exp_date
                //nc_brissuedate
               // $result = $result_a && $result_b;
            }
            if ($result) {
                $validation_result["form"]["fields"][$result["watch_order"]]["failed_validation"] = true;
                $validation_result["form"]["fields"][$result["watch_order"]]["validation_message"] = $result["message"];
                $validation_result["is_valid"] = false;
            }
            return $validation_result;
        }


        private static function convert_newcom($entry)
        {
            $company_name = $entry[nc_comfullname];
            $shortname = $entry[nc_conshortname];
            $contact_name = $entry[nc_contactname];
            $contact_number = $entry[nc_contactnumber];
            $contact_email = $entry[nc_contactemail];
            $contact_fax = $entry[nc_contactfax];
            $brno = $entry[nc_brnumber];
            $copy_br = $entry[nc_brfile];
            $reg_date = $entry[nc_brissuedate];
            $remark = $entry[nc_remark];
            unset($entry);
            return get_defined_vars();
        }

        private static function get_newcom_formfields()
        {
            $company_name = $_POST['input_1'];
            $shortname = $_POST['input_2'];
            $contact_name = $_POST['input_3'];
            $contact_number = $_POST['input_4'];
            $contact_email = $_POST['input_5'];
            $contact_fax = $_POST['input_7'];
            $brno = $_POST['input_8'];
            $copy_br = $_POST['input_9'];
            $reg_date = $_POST['input_10'];
            $referal = $_POST['input_11'];
            $remark = $_POST['input_12'];
            return get_defined_vars();
        }

        private static function get_cr_complementary()
        {

        }

        private static function get_newcr_formfields()
        {

        }

        private static function convert_newcp($entry)
        {
            //login user name
            $user_name = $entry["4"];
            //email registration

            $user_email = $entry["10"];

            $chinese = $entry["5"];
            $surname = $entry["2"];
            $english_name = $entry["3"];
            $title_name = $entry["13"];

            $company = $entry["6"];
            $homeaddress = $entry["7"];
            $expirydate = $entry["12"];
            $approvalno = $entry["11"];

            $phonenumber1 = $entry["8"];
            $phonenumber2 = $entry["9"];

            $status = 'pending';
            $star_level = 0;
            $displayname = $surname . $english_name;
            return get_defined_vars();
        }

        private static function get_newcp_formfields()
        {
            //login user name
            $user_name = $_POST["input_4"];
            //email registration

            $user_email = $_POST["input_10"];

            $chinese = $_POST["input_5"];
            $surname = $_POST["input_2"];
            $english_name = $_POST["input_3"];
            $title_name = $_POST["input_13"];

            $company = $_POST["input_6"];
            $homeaddress = $_POST["input_7"];
            $expirydate = $_POST["input_12"];
            $approvalno = $_POST["input_11"];

            $phonenumber1 = $_POST["input_8"];
            $phonenumber2 = $_POST["input_9"];

            $status = 'pending';
            $star_level = 0;
            $displayname = $surname . $english_name;
            return get_defined_vars();
        }

    }

}
?>