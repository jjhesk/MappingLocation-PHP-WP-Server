<?php
/**
 * Customized Extra Fields Tool
 * Created by PhpStorm.
 * User: Hesk
 * Date: 14年8月6日
 * Time: 上午10:24
 */
if (!class_exists('user_profile_editor')):
    class user_profile_editor
    {
        private $html = "";
        private $user_object;
        private $can_edit;
        private $editor_right;
        private $box_title;
        private $field_ids;

        public function __construct()
        {
            $this->editor_right = array('administrator');
        }

        /**
         * @param WP_User $user_object
         * @param string $extra_field_title
         * @param array $editor_roles
         * @param array $editing_field_ids
         * @internal param array $editing_fields
         */
        public function init(
            WP_User $user_object,
            $extra_field_title = "Extra Field",
            $editor_roles = array(),
            $editing_field_ids = array()
        )
        {
            $this->user_object = $user_object;
            $roles = $this->user_object->roles;
            $this->editor_right = array_merge($this->editor_right, $editor_roles);
            $found = array_intersect($this->editor_right, $roles);
            $this->can_edit = count($found) > 0;
            $this->box_title = $extra_field_title;
            $this->field_ids = $editing_field_ids;
            add_action('edit_user_profile_update', array(&$this, 'update'), 10, 1);
            add_action('personal_options_update', array(&$this, 'update'), 10, 1);
            $this->render_start();
        }

        private function render_start()
        {
            $this->html .= '<h3>' . $this->box_title . '</h3><table class="form-table"><tbody>';
        }

        /**
         * @param $label
         * @param $field_val
         */
        private function render($label, $field_val)
        {
            $this->html .= '
            <tr>
                <th scope="row">' . $label . '</th>
                <td>' . $field_val . '</td>
            </tr>';
        }

        /**
         * @param array $detail
         * @param bool $Use_User_Field_Render_Filter
         */
        public function add_box($detail = array(), $Use_User_Field_Render_Filter = false)
        {
            foreach ($detail as $key => $label) {
                $val = get_user_meta($this->user_object->ID, $key, true);
                $this->render($label,
                    $Use_User_Field_Render_Filter ?
                        apply_filters("UserFieldRender", $this, $key, $val) :
                        $this->field_val_filter($key, $val));
            }
        }

        /**
         * @param $key
         * @param $field_val
         * @return string
         */
        public function input_numeric($key, $field_val)
        {
            return '<input name="' . $key . '" type="number" value="' . $field_val . '"/>';
        }

        /**
         * @param $key
         * @param $field_val
         * @return string
         */
        public function input_text($key, $field_val)
        {
            return '<input name="' . $key . '" type="text" value="' . $field_val . '"/>';
        }

        /**
         * @param $desc
         * @return string
         */
        public function add_description($desc)
        {
            if ($desc == "") {
                return "";
            } else
                return '<br><span class="description">' . $desc . '</span>';
        }

        /**
         * @param $field_val
         * @param $key
         * @return string
         */
        public function input_field($field_val, $key)
        {
            return '<br><input class="regular-text ' . $key . ' field" type="text" name="' . $key . '" value="' . $field_val . '"/>';
        }

        /**
         * @param $field_val_id
         * @param $key
         * @return string
         */
        public function display_image($field_val_id, $key)
        {
            if (intval($field_val_id) > 0) {
                $src = wp_get_attachment_url($field_val_id);
                return '<br><img id="' . $key . '" src="' . $src . '"/>';
            } else {
                return '';
            }
        }

        /**
         * @param $key
         * @param $field_val
         * @internal param $fielval
         * @return string
         */
        public function list_buttons_for_upload_files($key, $field_val)
        {
            $uploadDir = "http://onecallapp.imusictech.net/wp-content/uploads";
            $lin = "";
            $n = 0;
            foreach ($field_val as $link_partial) {
                $n++;
                $src = $uploadDir . $link_partial;
                $lin .= '<a class="button" id="' . $key . '" target="_BLANK" href="' . $src . '">document ' . $n . '</a>';
            }
            return $lin;
        }

        /**
         * @param $field_val
         * @param $key
         * @param $list_options
         * @return string
         */
        public function input_field_select($field_val, $key, $list_options)
        {
            /*return '<br>' . ui_handler::ui_select_creation(
                array("1" => "1 star",
                    "2" => "2 star",
                    "3" => "3 star",
                    "4" => "4 star",
                    "5" => "5 star"
                ), $field_val, $key);*/
            return '<br>' . ui_handler::ui_select_creation($list_options, $field_val, $key);
        }

        /**
         * @param $key
         * @param $field_val
         * @return string
         */
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
                    href="' . $link . '">Review Account Report</a>';
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
                    if ($this->can_edit)
                        $field_val = $this->input_field($field_val, $key);
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
        public function update($user_id)
        {
            if ($this->can_edit) {
                foreach ($this->field_ids as $field_id) {
                    self::withUpdateField($user_id, $field_id);
                }
                /*   self::withUpdateField($user_id, 'cp_cert');
                     self::withUpdateField($user_id, 'rate');
                     self::withUpdateField($user_id, 'company');
                     self::withUpdateField($user_id, 'jobsordered');
                     self::withUpdateField($user_id, 'cp_certexp');
                     self::withUpdateField($user_id, 'jobfixprice');
                     $user = new WP_User($user_id);
                     if (in_array('cp', $user->roles)) {
                     }*/
            }
        }

        /**
         * @param $user_id
         * @param $name_field
         */
        private static function withUpdateField($user_id, $name_field)
        {
            if (isset($_POST[$name_field]))
                update_user_meta($user_id, $name_field, $_POST[$name_field], get_user_meta($user_id, $name_field, true));

        }
    }
endif;


//demo code
/*
function add_profile_options($user_object)
{
    $user_profile_render = new user_profile_editor();
    if (in_array('cp', $user_object->roles)) {
        $user_profile_render->init($user_object, "cp box", array('rolecp'), array("price", "company_id"));
        $user_profile_render->add_box(array(
            "rate" => "Rating",
            "price" => "Price Range",
            "cp_cert" => "Certification No.",
            "cp_certexp" => "Certification Expiration",
            "portrait" => "Cert Photo",
            "gf_cp_attachments" => "CP Documents",
            "company_id" => "Company",
            "phone1" => "Contact Number 1St",
            "phone2" => "Contact Number 2nd",
            "address" => "Address",
            "mac_id" => "Recent mac address",
            "access_token" => "Login Token",
            "email_activation" => "Email Verified",
            "status" => "Current Activity",
            "last_login_lastlogintime" => "Last Login"
        ), false);
    } else if (in_array('cr', $user_object->roles)) {
        $user_profile_render->init($user_object, "cp box", array('rolecp'), array("price", "company_id"));
        $user_profile_render->add_box(array(
            "price" => "Set Fix Price for Projects",
            "jobsordered" => "Ordered Jobs",
            "company_id" => "Company ID",
            "phone1" => "Contact Number",
            "email_activation" => "Email Verified",
            "status" => "Current Activity",
            "last_login_lastlogintime" => "Last Login"
        ), false);
    } else {
        $user_profile_render->add_box(array(
            "last_login_lastlogintime" => "Last Login"
        ), false);
    }
    $user_profile_render->render_end();
}

add_action('show_user_profile', 'add_profile_options');
add_action('edit_user_profile', 'add_profile_options');
*/
