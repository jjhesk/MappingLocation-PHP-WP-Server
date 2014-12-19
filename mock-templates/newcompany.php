<?php
/**
 * Template Name: new company approval
 * User: Hesk
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 * ID 446
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */


get_header();
?>
    <div class="small alert alert-block header">
        <h2 class="brightened">New Pending Companies</h2>Please take a look of the currently pending companies for
        review and approval to the system
    </div>
    <div id="approve_com" class="row-fluid well">
        <div class="span4 new_cp_list listpendings">
        </div>
        <div class="span8 single_cp_detail">
        </div>
    </div>

    <script id="tpl_comlist" type="text/x-handlebars-template">
        <div class="row label rightside">
            List of New Pending Companies
        </div>
        {{#each src}}
        <div class="view_detail_application_btn" data-id="{{ID}}">
            <span class="timespan">{{whenago}}</span>
                <span>{{shortname}}
                    <br>
                    Applying with {{total_rep}} reps</span>

            <div class="applicant_buttons btn-group pull-right">
                <div class="btn btn-mini btn-success" data-id="{{ID}}">
                    Approve
                </div>
                <div class="btn btn-mini btn-danger" data-id="{{ID}}">
                    Reject
                </div>
            </div>
        </div>
        {{/each}}
    </script>
    <script id="tpl_comdetail" type="text/x-handlebars-template">

                <div class="row">
                    <span class="span5">Company Full Name: </span><span class="span7">{{company_name}}</span>
                </div>
                <div class="row">
                    <span class="span5">Company Short Name: </span><span class="span7">{{shortname}}</span>
                </div>
                <div class="row">
                    <span class="span5">Contact Name: </span><span class="span7">{{contact_name}}</span>
                </div>
                <div class="row">
                    <span class="span5">Contact Phone Number: </span><span class="span7">{{contact_number}}</span>
                </div>
                <div class="row">
                    <span class="span5">Company Email: </span><span class="span7">{{contact_email}}</span>
                </div>

                <div class="row">
                    <span class="span5">Mailing Address: </span><span class="span7">{{address}}</span>
                </div>
                <div class="row">
                    <span class="span5">Company Fax: </span><span class="span7">{{contact_fax}}</span>
                </div>
                <div class="row">
                    <span class="span5">Hong Kong Business Registration (BR): </span><span class="span7">{{brno}}</span>
                </div>
                <div class="row">
                    <span class="span5">Business Registration Expiry Date: </span><span
                    class="span7">{{reg_date}}</span>
                </div>
                <div class="row">
                    <span class="span5">Total Representatives submitted: </span><span class="span7">{{total_rep}}</span>
                </div>

                <div class="applicant_buttons btn-group pull-right">
                    <div class="btn btn-info reviewcert_br btn-large" data-id="{{ID}}" id="ButtonC"
                         data-location="{{copy_br}}">
                        Doc
                    </div>
                    <div class="btn btn-success approve btn-large" data-id="{{ID}}" id="ButtonA">
                        Approve
                    </div>
                    <div class="btn reject btn-danger btn-large" data-id="{{ID}}" id="ButtonR">
                        Reject
                    </div>
                </div>

                <div class="alert">
                    <button type="button" class="close" data-dismiss="alert">
                        &times;
                    </button>
                    <strong>Note!</strong>Click on the Doc button to review the Certificate of Hong Kong Business
                    Registration
                </div>


    </script>
<?php //get_sidebar('front'); ?>
<?php get_footer(); ?>