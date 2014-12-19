<?php
defined('ABSPATH') || exit;

/**
 * Created by PhpStorm.
 * User: hesk
 * Date: 4/23/14
 * Time: 10:36 PM
 */
class gformBase extends oc_db_account
{


    /**
     * @param $field_id
     * @return mixed
     */
    protected static function getPostJson($field_id)
    {
        return json_decode(trim(rgpost("input_" . $field_id)));
    }

    /**
     * @param $field_id
     * @return string
     */
    protected static function getPostVal($field_id)
    {
        return trim(rgpost("input_" . $field_id));
    }

    /**
     * confirmation message template
     * @param $lead_id
     * @param null $format
     * @return string
     */
    protected static function confirm_msg($lead_id, $format = null)
    {
        if ($format == null) {
            $msg_format = __("Thank you for you registeration and we will process your application soon. ref. no # %d", HKM_LANGUAGE_PACK);
        } else $msg_format = $format;
        return sprintf($msg_format, $lead_id);
    }

    protected static function getSettingParams($forms_id)
    {
        $forms = array(
            "service_order_cr" => GF_SERVICE_ORDER_FORM,
            "service_order_internal" => GF_SERVICE_ORDER_FORM_INTERNAL,
        );
        $head = "#input_" . $forms_id . "_";
        switch ($forms_id) {
            case GF_SERVICE_ORDER_FORM:

                if (is_user_logged_in() && parent::has_role("cr")) {
                    $memberid = get_current_user_id();
                } else {
                    $memberid = "";
                }
                return array(
                    "head" => $head,
                    "ff_geoloc" => $head . ff_geoloc,
                    "ff_expectdate" => $head . ff_expectdate,
                    "ff_expectedtime" => $head . ff_expectedtime,
                    "ff_cr_id" => $head . ff_cr_id,
                    "field_value_cr_id" => $memberid,
                    "form_id" => $forms_id,
                    "form_type" => $forms,
                    "ff_order_service_detail" => $head . ff_table_service
                );
            case GF_SERVICE_ORDER_FORM_INTERNAL:
                if (is_user_logged_in() && parent::has_role("ocstaff")) {
                    $memberid = get_current_user_id();
                } else {
                    $memberid = "";
                }
                return array(
                    "head" => $head,
                    "ff_geoloc" => $head . ff_geoloc,
                    "ff_expectdate" => $head . ff_expectdate,
                    "ff_expectedtime" => $head . ff_expectedtime,
                    "ff_staff_id" => $head . ff_staff_id,
                    "ff_client_id" => $head . ff_client_company,
                    "field_value_staff_id" => $memberid,
                    "form_id" => $forms_id,
                    "form_type" => $forms,
                    "ff_order_service_detail" => $head . ff_table_service,
                    "company_selection_html" => oc_project::select_ui()
                );
            case GF_REP_REGISTRATION_FORM:
                $head = "#input_" . GF_REP_REGISTRATION_FORM . "_";
                return array(
                    "head" => $head,
                    "ff_nicename" => $head . fieldid_nicename,
                    "ff_displayname" => $head . fieldid_displayname,
                    "ff_expectedtime" => $head . fieldid_useremail,
                    "ff_phonenumber" => $head . fieldid_phonenumber,
                    "ff_name" => $head . fieldid_name,
                    "ff_companyname" => $head . fieldid_companyname,

                );
            case GF_NEW_COM_FORM:
                $head = "#input_" . GF_NEW_COM_FORM . "_";
                return array(
                    "head" => $head,
                    "nc_comfullname" => $head . nc_comfullname,
                    "nc_conshortname" => $head . nc_conshortname,
                    "nc_contactemail" => $head . nc_contactemail,
                    "nc_contactfax" => $head . nc_contactfax,
                    "nc_contactnumber" => $head . nc_contactnumber,
                    "nc_contactname" => $head . nc_contactname,

                    "nc_cr_reg_info_json" => $head . nc_cr_reg_info_json,


                    "nc_brfile" => $head . nc_brfile,
                    "nc_brissuedate" => $head . nc_brissuedate,
                    "nc_brnumber" => $head . nc_brnumber,

                    "form_id" => $forms_id,
                    "form_type" => $forms,
                );

            default:
                return array();
        }
    }
} 