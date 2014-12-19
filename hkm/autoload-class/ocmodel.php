<?php
/**
 * Created by PhpStorm.
 * User: Hesk
 * Date: 14年4月23日
 * Time: 下午5:13
 */


if (!class_exists('ocmodel')) {
    class ocmodel
    {
        static public function _get_one()
        {

        }

        static public function get_tpl($beforehythen, $afterhythen)
        {
            ob_start();
            get_template_part('page-templates/' . $beforehythen, $afterhythen);
            return ob_get_clean();
        }

        public static function list_applicant_job_cp_html($post, $metabox_id)
        {
            $offered_cp = get_post_meta($post->ID, "offerjbcpid", true);
            $ui = new ui_handler();
            $notification_model = new oc_market_notification($post->ID);
            $results = $notification_model->add_clause("")->get_notified_cps();
            $html = "";
            $post_cp_list_result = array(
                "nsent" => $notification_model->get_notifications_sent_times(),
                "response" => $notification_model->get_total_response(),
                "offerjbcpid" => !$notification_model->get_cp_for_job_offered() ? -1 : $notification_model->get_cp_for_job_offered(),
                "sent_cps" => $notification_model->get_total_cp_sent(),
                'html_content_cp_list' => $results ? $ui->ui_radio_create_for_CP("CP List", $results, "cplistresult", "cplistresult", $offered_cp) : ""

            );

            /*  $html .= html_entity_decode(ui_handler::apply_oc_template_with_mustache('admin_metabox_field_cplist', array(
                  'Field_Label' => __("Open position for CPs", HKM_LANGUAGE_PACK),
                  'html_content' => $results ? $ui->ui_radio_create_for_CP("CP List", $results, "cplistresult", "cplistresult", $offered_cp) : ""

              )));*/
            $html .= html_entity_decode(ui_handler::apply_oc_template_with_mustache('admin_metabox_field_boardcast_requirement', $post_cp_list_result));
            $html .= get_oc_template('admin_job_template_dumps');

            //  $html = $ui->ui_radio_create("CP List", $results, "cplistresult", "cplistresult");
            //   $html = $ui->options_ui_from_wp_query($results, "cplistresult", "cplistresult");
            //   echo $html;
            //get_oc_template('admin_job_record_template_table');
            // print_r($results);
            // $html = "";
            /* $content = ui_handler::apply_oc_template_with_mustache("admin_metabox_field_cplist", array(
                 "Field_Label_id" => "coiajc",
                 "Field_Label" => " iajso ijao "
             ));*/

            // Add an nonce field so we can check for it later.


            echo '<div class="rwmb-meta-box" data-autosave="false">' . $html . '</div>';
        }

        public static function ajax_notify_job_offer()
        {
            try {

                if (isset($_POST['job_id']) && isset($_POST['cp_id'])) {
                    oc_market_notification::notify_job_offer($_POST['job_id'], $_POST['cp_id']);
                    api_handler::outSuccess();
                } else throw new Exception("no input", 1102);
            } catch (Exception $e) {
                api_handler::outFail($e->getCode(), $e->getMessage());
            }
        }
        public static function ajax_notify_job_offer_and_complete()
        {
            try {

                if (isset($_POST['job_id']) && isset($_POST['cp_id'])) {
                    oc_market_notification::notify_job_offer_and_complete($_POST['job_id'], $_POST['cp_id']);
                    api_handler::outSuccess();
                } else throw new Exception("no input", 1102);
            } catch (Exception $e) {
                api_handler::outFail($e->getCode(), $e->getMessage());
            }
        }
        /**
         * cp_response_action
         */
        public static function ajax_cp_resp_act()
        {

            try {
                if (is_user_logged_in())
                    if (isset($_POST['action_entry']) && isset($_POST['id'])) {
                        if (!oc_db_account::has_role("cp")) throw new Exception("no permission for your current Role", 1203);
                        $jobID = $_POST['id'];
                        $express = $_POST['action_entry'];
                        self::apply_job($jobID, $express);
                        api_handler::outSuccess();
                    } else throw new Exception("no input", 1102);
                else throw new Exception("please login with proper permission", 1104);
            } catch (Exception $e) {
                api_handler::outFail($e->getCode(), $e->getMessage());
            }
        }

        private static function apply_job($jobID, $action)
        {
            $cp_action = new oc_market_notification($jobID);
            $cp_action->cp_response($action);
        }

        /**
         * display the list of the result for boardcasting
         */
        public static function ajax_get_listed_applicant_job_cp()
        {
            try {
                if (isset($_POST['ui']) && isset($_POST['id'])) {
                    $post_id = $_POST['id'];
                    $uiType = $_POST['ui'];
                    $ui = new ui_handler();
                    $notificatioModel = new oc_market_notification($post_id);
                    $results = $notificatioModel->add_clause("")->get_notified_cps();
                    api_handler::outSuccessData(array("html" =>
                        $ui->ui_radio_create_for_CP("CP List", $results, "cplistresult", "cplistresult")
                    ));
                } else throw new Exception("no input", 1102);
            } catch (Exception $e) {
                api_handler::outFail($e->getCode(), $e->getMessage());
            }
        }

        /**
         * using ajax to boardcast to job notifications to the queried CPs - boardcast_cp
         */
        public static function ajax_action_boardcast()
        {
            try {
                if (isset($_POST['requirement']) && isset($_POST['job_id'])) {
                    $job_post_id = $_POST['job_id'];
                    $requirement = $_POST['requirement'];
//                    $notificatioModel = new oc_market_notification($post_id);
                    $n = new oc_market_notification($job_post_id);
                    $n->add_requirement($requirement)->send_job_notifications();
                    $ui = new ui_handler();
                    $n = new oc_market_notification($job_post_id);
                    $results = $n->get_notified_cps();
                    api_handler::outSuccessData(array(
                        "nsent" => $n->get_notifications_sent_times(),
                        "rsvp" => $n->get_total_response(),
                        //"offerjbcpid" => !$n->get_cp_for_job_offered() ? -1 : $n->get_cp_for_job_offered(),
                        "sent_cps" => $n->get_total_cp_sent(),
                        "html" => $ui->ui_radio_create_for_CP("CP List", $results, "cplistresult", "cplistresult")
                    ));
                } else throw new Exception("no input", 1102);
            } catch (Exception $e) {
                api_handler::outFail($e->getCode(), $e->getMessage());
            }
        }
    }
}