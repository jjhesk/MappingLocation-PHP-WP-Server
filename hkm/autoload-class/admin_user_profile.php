<?php
/**
 * Created by PhpStorm.
 * User: hesk
 * Date: 3/20/14
 * Time: 2:32 PM
 */
if (!class_exists('admin_user_profile')):
    class admin_user_profile extends oc_db_account
    {

        private $html = "";
        private $user_object;
        private $can_edit;

        public function __construct()
        {

        }

        public function init($user_object)
        {
            $this->user_object = $user_object;
            $this->can_edit = parent::has_role('administrator') || parent::has_role('ocstaff');
            $this->render_start();
        }


        private function render_start()
        {
            $this->html .= '<h3>Extra information</h3><table class="form-table"><tbody>';
        }

        private function render($label, $field_val)
        {
            $this->html .= '
            <tr>
                <th scope="row">' . $label . '</th>
                <td>' . $field_val . '</td>
            </tr>';
        }


        public function add_box($detail = array(), $use_internal_filter = false)
        {
            foreach ($detail as $key => $label) {
                $val = get_user_meta($this->user_object->ID, $key, true);
                $this->render(
                    $label,
                    $this->field_val_filter($key, $val)
                );
            }
        }

        private function input_numeric($key, $field_val)
        {
            return '<input name="' . $key . '" type="number" value="' . $field_val . '"/>';
        }

        private function input_text($key, $field_val)
        {
            return '<input name="' . $key . '" type="text" value="' . $field_val . '"/>';
        }

        private function add_description($desc)
        {
            if ($desc == "") {
                return "";
            } else
                return '<br><span class="description">' . $desc . '</span>';
        }

        private function input_field($field_val, $key)
        {
            return '<input class="regular-text ' . $key . ' field" type="text" name="' . $key . '" value="' . $field_val . '"/>';
        }

        private function display_image($field_val_id, $key)
        {
            if (intval($field_val_id) > 0) {
                $src = wp_get_attachment_url($field_val_id);
                return '<br><img id="' . $key . '" src="' . $src . '"/>';
            } else {
                return '';
            }
        }

        private function list_buttons_for_upload_files($key, $fielval)
        {
            $uploadDir = "http://onecallapp.imusictech.net/wp-content/uploads";
            $lin = "";
            $n = 0;
            foreach ($fielval as $link_partial) {
                $n++;
                $src = $uploadDir . $link_partial;
                $lin .= '<a class="button" id="' . $key . '" target="_BLANK" href="' . $src . '">document ' . $n . '</a>';
            }
            return $lin;
        }

        private function input_field_select($field_val, $key)
        {
            return '<br>' . ui_handler::ui_select_creation(
                array("1" => "1 star",
                    "2" => "2 star",
                    "3" => "3 star",
                    "4" => "4 star",
                    "5" => "5 star"
                ), $field_val, $key);;
        }

        private function field_val_filter($key, $field_val)
        {
            $desc = "";
            switch ($key) {
                case "access_token":
                    $field_val = parent::getVal($this->user_object->ID, $key);
                    break;
                case "mac_id":
                    if (parent::has_role("administrator"))
                        $field_val = $this->input_text($key, $field_val);
                    // print_r($field_val);
                    $desc = "The mac address can be done to ensuring stolen machine to be protected by the system";
                    break;
                case "vcoin":
                    $val = parent::getVal($this->user_object->ID, $key);
                    $field_val = intval($val) . "V";
                    break;
                case "stock_manager_report":
                    $link = admin_url("admin.php?page=innomanager-stock&staff=" . $this->user_object->ID);
                    $field_val = '<a
                    class="button button-primary"
                    href="' . $link . '">Review Report</a>';
                    break;
                case "stock_manager_review_account":
                    $link = admin_url("admin.php?page=store-mge&staff=" . $this->user_object->ID);
                    $field_val = '<a
                    class="button button-primary"
                    href="' . $link . '">Review Account    Report</a>';
                    break;
                case "rate":
                    if ($this->can_edit)
                        $field_val = $this->input_field($field_val, $key);
                    break;
                case "cp_cert":
                    if ($this->can_edit)
                        $field_val = $this->input_field($field_val, $key);
                    break;
                case "company_id":
                    if ($this->can_edit) {
                        $arrcomid = oc_company::get_list_companies_metabox_options();
                        $field_val = ui_handler::ui_select_creation_complete($arrcomid, $key, $key, "Select company", $field_val);
                        //$this->input_field($field_val, $key);
                    }
                    break;
                case "company":
                    if ($this->can_edit)
                        $field_val = $this->input_field($field_val, $key);
                    break;
                case "jobsordered":
                    if ($this->can_edit)
                        $field_val = $this->input_field($field_val, $key);
                    break;
                case "cp_certexp":
                    if ($this->can_edit) {
                        $field_val = $this->input_field($field_val, $key);
                    }
                    break;
                case "portrait":
                    $field_val = $this->display_image($field_val, $key);
                    break;
                case "price":
                    if ($this->can_edit)
                        $field_val = $this->input_field($field_val, $key);
                    break;
                case "jobfixprice":
                    if ($this->can_edit)
                        $field_val = $this->input_field($field_val, $key);
                    break;
                case "email_activation":
                    $indication_n_y = parent::getVal($this->user_object->ID, "email_verified");
                    $link = "http://www.google.com";
                    $button = '(Not verified) <a target="_blank" class="button button-primary" href="' . $link . '">Admin Verify</a>';
                    if ($this->user_object->user_email == "") {
                        $button = "(Not verified)";
                    } else if (parent::check_email_for_double($this->user_object->user_email, $this->user_object->ID)) {
                        $button = "(Not verified this email is doubled)";
                    }
                    $field_val = $indication_n_y == "N" ? $button : "Y - Already verified";
                    break;
                //this will require the plugin WP - Last Login
                case "last_login_lastlogintime":
                    $value = __('Never.', 'wp-last-login');
                    $last_login = (int)parent::getVal($this->user_object->ID, "wp-last-login");
                    if ($last_login) {
                        $format = apply_filters('wpll_date_format', get_option('date_format'));
                        $value = date_i18n($format, $last_login);
                    }
                    $field_val = $value;
                    $desc = "The most recent login time on this portal.";
                    break;
                case "gf_cp_attachments":
                    $field_val = $this->list_buttons_for_upload_files($key, json_decode($field_val));
                    $desc = "List of attachments uploaded by the CP.";
                    break;
            }
            return $field_val . $this->add_description($desc);
        }

        public function render_end()
        {
            $this->html .= '</tbody></table>';
            echo $this->html;
        }

        /**
         * @param $user_id
         * @param $old_user_data
         */
        public static function my_admin_notification_profile_update($user_id, $old_user_data)
        {
            // get the user data into an object
            $user = get_userdata($user_id);
            // get the site administrator's email address
            $admin_email = get_option('admin_email');
            // the email body
            $message = sprintf(__('This user has updated their profile on your site: %s'), get_option('blogname')) . "\r\n\r\n";
            $message .= sprintf(__('Display Name: %s'), $user->display_name) . "\r\n\r\n";
            $message .= sprintf(__('Username: %s'), $user->user_login) . "\r\n\r\n";
            $message .= sprintf(__('Old Email: %s'), $old_user_data->user_email) . "\r\n\r\n";
            $message .= sprintf(__('Email: %s'), $user->user_email);
            // send the email
            wp_mail($admin_email, sprintf(__('[%s] User Updated a Profile'), get_option('blogname')), $message);
        }

        /**
         * @param $user_id
         */
        public static function update($user_id)
        {

            if (parent::has_role("administrator") || parent::has_role("ocstaff")) {
                self::withUpdateField($user_id, 'cp_cert');
                self::withUpdateField($user_id, 'rate');
                self::withUpdateField($user_id, 'company_id');
                self::withUpdateField($user_id, 'jobsordered');
                self::withUpdateField($user_id, 'cp_certexp');
                self::withUpdateField($user_id, 'jobfixprice');
                $user = new WP_User($user_id);
                if (in_array('cp', $user->roles)) {

                }
            }
        }

        private static function withUpdateField($user_id, $name_field)
        {
            if (isset($_POST[$name_field]))
                update_user_meta($user_id, $name_field, $_POST[$name_field], get_user_meta($user_id, $name_field, true));

        }
    }
endif;