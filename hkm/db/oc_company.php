<?php

defined('ABSPATH') || exit;
if (!class_exists('oc_company')) {
    class  oc_company extends oc_db
    {
        public static function add_new_from_pending($rID)
        {
            global $wpdb;
            // extract(oc_db::get_row_pending($rID, 'newcom'),EXTR_OVERWRITE);
            $data = oc_db::get_row_pending($rID, 'newcom');
            self::add_new_post($data);
            if (is_array($data)) {
                $table = DB_COM;
                //passing 11 columns as string
                $format = array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d');
                $enterdata = array('del' => 0);
                return $wpdb->insert($table, array_merge($data, $enterdata), $format);
            } else {
                return "variable data is not array";
            }
        }

        public static function get_pending_company_list()
        {
            global $wpdb;
            $row = $wpdb->get_results("SELECT * FROM " . DB_PENDING . " WHERE type='newcom' ORDER BY stamp DESC");
            return $row;
        }

        /**
         * find if the pending company row exist or not
         * @param $lid
         * @return array
         * @throws Exception
         */
        public static function get_pending_company_row($lid)
        {
            try {
                if (!parent::gf_entry_row_exist(GF_NEW_COM_FORM, $lid)) throw new Exception ("key row is not existed in GForm", 1901);
                $brdoc = parent::gf_get_entry_value(GF_NEW_COM_FORM, $lid, nc_brfile);
                $brdoc = empty($brdoc) ? "#" : $brdoc;

                $gpcr = array(
                    "contact_email" => parent::gf_get_entry_value(GF_NEW_COM_FORM, $lid, nc_contactemail),
                    "contact_fax" => parent::gf_get_entry_value(GF_NEW_COM_FORM, $lid, nc_contactfax),
                    "shortname" => parent::gf_get_entry_value(GF_NEW_COM_FORM, $lid, nc_conshortname),
                    "copy_br" => $brdoc,
                    "reg_date" => parent::gf_get_entry_value(GF_NEW_COM_FORM, $lid, nc_brissuedate),

                    "company_name" => parent::gf_get_entry_value(GF_NEW_COM_FORM, $lid, nc_comfullname),
                    "contact_name" => parent::gf_get_entry_value(GF_NEW_COM_FORM, $lid, nc_contactname),
                    "contact_number" => parent::gf_get_entry_value(GF_NEW_COM_FORM, $lid, nc_contactemail),
                    "brno" => parent::gf_get_entry_value(GF_NEW_COM_FORM, $lid, nc_brnumber),
                    "remark" => parent::gf_get_entry_value(GF_NEW_COM_FORM, $lid, nc_remark),
                    "lid" => $lid,
                );
                return $gpcr;
            } catch (Exception $e) {
                throw $e;
            }
        }

        public static function get_pending_cr_from_row($lid)
        {
            $cr = parent::gf_get_entry_value(GF_NEW_COM_FORM, $lid, nc_cr_reg_info_json);
            $cr = json_decode($cr);
            return $cr;
        }

        public static function bind_gf_entry_id_to_post_id($lid, $post_id)
        {
            $parent = parent::gf_update_field_value(GF_NEW_COM_FORM, $lid, nc_bind_post_company, $post_id);
            return true;
        }

        public static function get_pending_company_list_db()
        {

            $data = array();
            $L = parent::gf_get_form_entries(GF_NEW_COM_FORM);
            if ($L) {
                foreach ($L as $row) {
                    if (intval(parent::gf_get_entry_value(GF_NEW_COM_FORM, $row->id, nc_bind_post_company)) == 0) {
                        $cr = parent::gf_get_entry_value(GF_NEW_COM_FORM, $row->id, nc_cr_reg_info_json);
                        $cr = json_decode($cr);
                        $data[] = array(
                            "name" => parent::gf_get_entry_value(GF_NEW_COM_FORM, $row->id, nc_comfullname),
                            "cname" => parent::gf_get_entry_value(GF_NEW_COM_FORM, $row->id, nc_contactname),
                            "cemail" => parent::gf_get_entry_value(GF_NEW_COM_FORM, $row->id, nc_contactemail),
                            "brno" => parent::gf_get_entry_value(GF_NEW_COM_FORM, $row->id, nc_brnumber),
                            "repc" => count($cr),
                            "remark" => parent::gf_get_entry_value(GF_NEW_COM_FORM, $row->id, nc_remark),
                            "lid" => $row->id,
                            "brpath" => parent::gf_get_entry_value(GF_NEW_COM_FORM, $row->id, nc_brfile),
                        );
                    }
                }
            }
            return $data;

        } //getting the row by the pending ID
        public static function get_pending_by_type($pending_type)
        {
            global $wpdb;
            $table = DB_PENDING;
            $row = $wpdb->get_results("
                                    SELECT * FROM $table
                                    WHERE type='$pending_type'
                                    ORDER BY stamp DESC");
            return $row;
        }

        public static function remove_pending_company($id)
        {
            global $wpdb;
            oc_cr::remove_pendings_from_com($id);
            $query = array('ID' => $id, 'type' => 'newcom');
            $n = $wpdb->delete(DB_PENDING, $query, NULL);
        }

        public static function getComById($key, $byID)
        {
            global $wpdb;
            $table = DB_COM;
            if (is_null($byID) || !is_int($byID)) {
                die("company id is not specfied - oc_company:: line 24");
            } else {
                return $wpdb->get_var("SELECT $key FROM $table WHERE ID=$byID");
            }
        }

        public static function get_one($query, $by = 'ID')
        {

        }

        public static function get_list($limit = 10, $by_col = 'creation_timestamp')
        {
        }

        private static function list_all_com($limit = null)
        {
            global $wpdb;
            return $rows = $wpdb->get_results("
                  SELECT * FROM " . DB_COM . "
                  WHERE del=0 
                  ORDER BY creation_timestamp DESC");
        }

        public static function get_list_companies_metabox_options()
        {
            global $wpdb;
            $arr = array();
            $qu = new WP_Query(array(
                "post_type" => HKM_COM,
                "status" => "publish",
                "orderby" => "date",
                "posts_per_page" => -1
            ));

            if ($qu->have_posts()) :
                while ($qu->have_posts()) : $qu->the_post();
                    $arr[$qu->post->ID] = "[" . $qu->post->ID . "] " . $qu->post->post_title;
                endwhile;
            endif;
            return $arr;
        }

        public static function get_list_drop_down_selection()
        {
            $list = array();
            foreach (self::list_all_com() as $r) {
                $list[] = array("value" => $r->ID, "text" => $r->company_name . " (" . $r->shortname . ")");
            }
            return $list;
        }

        private static function add_new_post($rowdata)
        {
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
                add_post_meta($post_return_id, 'dbid', $rowdata['ID'], true);
                //     add_post_meta($post_return_id, 'platform_id', $rowdata['referal'], true);
                add_post_meta($post_return_id, 'com_remark', $rowdata['remark'], true);
            }
        }

        public static function render_admin_page_approve_company()
        {
            global $wpdb, $action_url, $approve_list_content, $notified_action;
            $approve_list_content = "";
            $action_url = admin_url('edit.php?post_type=occompany&page=approvals');

            /*  if (isset($_POST['acceptid'])) {
                  $id = $_POST['acceptid'];
                  $notified_action = "Company " . $id . " has accepted";
                  $success = self::add_new_from_pending($id);
                  oc_cr::add_new_from_pendingcompany($id);
                  $query = array('ID' => $id, 'type' => 'newcom');
                  $n = $wpdb->delete(DB_PENDING, $query, NULL);
                  $query = array('ID' => $id, 'type' => 'newcr');
                  $n = $wpdb->delete(DB_PENDING, $query, NULL);
              }

              if (isset($_POST['reject'])) {
                  $id = $_POST['reject'];
                  $notified_action = "Company " . $id . " has rejected";
                  $key = oc_db::get_depending_key_from_row_pending($id);
                  $query = array('key1' => $key, 'type' => 'newcr');
                  $n = $wpdb->delete(DB_PENDING, $query, NULL);
                  $query = array('ID' => $id, 'type' => 'newcom');
                  $n = $wpdb->delete(DB_PENDING, $query, NULL);
              }*/
            /*
                       $objs = self::get_pending_company_list();

                       if ($objs) {
                           $data = array();
                           foreach ($objs as $result) {
                               $list = json_decode($result->json, TRUE);
                               if (empty($list['copy_br'])) {
                                   $list['copy_br'] = '<span class="required update-plugins">(missing)</span>';
                               } else {
                                   $link = site_url() . "/wp-content/uploads" . $list['copy_br'];
                                   $list['copy_br'] = sprintf('<a href="%s" target="_BLANK">Check BR</a>', $link);
                               }

                               $id = intval($result->ID);
                               $related_to = intval($result->key1);
                               $pending_cr = oc_db::get_pending_cr_from_newcom_byKeyid($related_to);
                               $total = array("total_rep" => (!$pending_cr) ? 0 : count($pending_cr));
                               // $total = array("total_rep" => (!$pending_cr) ? 0 : count($pending_cr));
                               unset($result->json);
                               $data[] = (object)array_merge((array)$total, (array)$result, (array)$list);
                           }
                           $data = array_values($data);
                           $total = count($objs);
                       } else {
                           $total = 0;
                       }
                       $approve_list_content = array('total' => $total, 'src' => $data);
                       get_template_part('admin-approvecom');*/
            echo get_oc_template('admin_page_approve_com');
        }
    }

}
?>