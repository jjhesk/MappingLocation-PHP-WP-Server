<!--<article id="post-0" class="panel">
<div class="entry-content row-fluid"><h5>Please select your working place</h5><div class="btn-group well" data-toggle="buttons-radio"><button class="btn btn-large" id="view_pending"> View New Orders<br><small>the new order</small><span class="badge badge-important">2</span> </button><button class="btn btn-large " id="view_project">Project Board Cast<br><small>Successfully broadcast</small><span class="badge badge-success">2</span></button><button class="btn btn-large " id="view_job">Job Records<br><small>more job records</small><span class="badge badge-info">2</span></button></div></div>
</article>--><!-- #post-0 -->
<article class="panel row-fluid">
    <div id="Profilearea" class="hide span12 well">
        <!--  <div  class="well">
        <h3 class="title">Recent Orders</h3>
        <table><thead><tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr></thead></table>
        </div>
        </div>-->
</article>
<article id="stage" class="">
    <!-- the real content of the block -->
</article>
<section id="project_board_cast" class="hide">
    <div class="entry-content row-fluid">
        <div class="span12 well">
            <h2>Broadcast Market</h2>
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert">
                    &times;
                </button>
                <strong>Note!</strong>Here is the place for the managing all the broadcasted jobs and the CP will express whether they interested in the job opportunities. Click on the review applicant button to start making decisions.
            </div>
            <table class="commontable">
                <thead>
                    <tr>
                        <td>JobID</td>
                        <td>Job Name</td>
                        <td>Order by CR</td>
                        <td>Apply Rate</td>
                        <td>Deadline</td>
                        <td>ActionBar</td>
                    </tr>
                </thead>
                <tfoot id="tpl_order_bc" class="hide">
                    <tr>
                        <td><span class="label label-info">{{jobid}}</span></td>
                        <td><span class="label label-info">{{job_location}}</span></td>
                        <td>{{order_ref_id}}</td>
                        <td>{{rate}}</td>
                        <td><span class="label label-warning">{{job_application_deadline}}</span></td>
                        <td>
                        <div class="btn-group dropup">
                            <button class="btn action">
                                Review Applicants
                            </button>
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <!-- dropdown menu links -->
                                <li>
                                    Job Detail
                                </li>
                                <li>
                                    Record Plan
                                </li>
                                <li class="button_sms">
                                    Boardcast SMS
                                </li>
                                <li>
                                    Remove Job
                                </li>
                            </ul>
                        </div></td>
                    </tr>
                </tfoot>
                <tbody id="rez_boardcastjobs"></tbody>
            </table>
        </div>
    </div>
</section>
<section id="job_record" class="hide">
    <div class="entry-content row-fluid">
        <div class="span12 well">
            <h2>Jobs Status</h2>
            <small>Jobs is the management page for the staff to manage posted jobs starting from that the progress of the job successfully assigned to the CP.</small>
            <div id="dashcontainer">
                <ul class="nav nav-tabs" id="t_pending_order">
                    <li class="active">
                        <a data-target="tab_workday" data-toggle="tab">Working Days</a>
                    </li>
                    <li class="">
                        <a data-target="tab_jobsearch" data-toggle="tab">Job Search</a>
                    </li>
                    <li class="">
                        <a data-target="tab_cpsearch" data-toggle="tab">CP Search</a>
                    </li>
                    <li class="">
                        <a data-target="tab_pastrecords" data-toggle="tab">Past Records</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_workday">
                        <?php echo ocmodel::get_tpl('oc', 'ocstaff_workschedule'); ?>
                    </div>
                    <div class="tab-pane" id="tab_pastrecords">
                        <?php echo ocmodel::get_tpl('oc', 'ocstaff_record_status'); ?>
                    </div>
                    <div class="tab-pane" id="tab_cpsearch">

                    </div>
                    <div class="tab-pane" id="tab_jobsearch">
                        <legend>
                            Search Requirement
                        </legend>
                        <fieldset id="" class="setrow">
                            <div class="btn-group dropup">
                                <button class="btn action" id="viewby_time">
                                    view by time
                                </button>
                                <button class="btn action" id="searchby_project">
                                    search project
                                </button>
                                <button class="btn action" id="searchby_cp">
                                    search CP id
                                </button>
                            </div>
                        </fieldset>
                        <legend>
                            Search Result
                        </legend>
                        <table class="commontable">
                            <thead>
                                <tr>
                                    <td>Project ID</td>
                                    <td>JOD ID</td>
                                    <td>Assigned to CP</td>
                                    <td>Status</td>
                                    <td>ActionBar</td>
                                </tr>
                            </thead>
                            <tfoot id="tpl_job_pool" class="hide">
                                <tr>
                                    <td><span class="label label-important">{{projectid}}</span></td>
                                    <td>{{jobid}}</td>
                                    <td>{{cpid}} Location: {{loc}}</td>
                                    <td><span class="label label-info">{{status}}</span></td>
                                    <td>
                                    <div class="btn-group dropup">
                                        <button class="btn action">
                                            Progress Detail
                                        </button>
                                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <!-- dropdown menu links -->
                                            <li>
                                                Notification to CP
                                            </li>
                                            <li>
                                                Modify
                                            </li>
                                            <li>
                                                SMS
                                            </li>
                                        </ul>
                                    </div></td>
                                </tr>
                            </tfoot>
                            <tbody id="rez_jobpool"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="approvecp" class="hide">
    <div class="small alert alert-block header">
        <h2 class="brightened">Approve New CP</h2>
        This is the CP check list where you can check mark the newly applied CP to the system
    </div>
    <div class="row-fluid well">
        <div class="span4 new_cp_list listpendings"></div>
        <div class="span8 single_cp_detail"></div>
    </div>
    <div class="hide">
        <div id="tpl_cplist">
            <div class="row label rightside">
                New Applicant Names List
            </div>
            {{#each src}}
            <div class="view_detail_application_btn" data-id="{{ID}}">
                <span>{{user_name}}</span>
                <div class="applicant_buttons btn-group pull-right">
                    <div class="btn approve btn-mini btn-success" data-id="{{ID}}">
                        Approve
                    </div>
                    <div class="btn reject btn-mini btn-danger" data-id="{{ID}}">
                        Reject
                    </div>
                </div>
            </div>
            {{/each}}
        </div>
        <div id="tpl_cpdetail">
            <div class="row">
                <span class="span3">Name: </span><span class="span9">{{title_name}} {{english_name}}</span>
            </div>
            <div class="row">
                <span class="span3">Other Name: </span><span class="span9">{{othername}}</span>
            </div>
            <div class="row">
                <span class="span3">Chinese  Name: </span><span class="span9">{{chinese}}</span>
            </div>
            <div class="row">
                <span class="span3">Organization: </span><span class="span9">{{company}}</span>
            </div>

            <div class="row">
                <span class="span3">Address: </span><span class="span9">{{homeaddress}}</span>
            </div>
            <div class="row">
                <span class="span3">Phone Number: </span><span class="span9">{{phonenumber1}}
                    <br>
                    {{phonenumber2}}</span>
            </div>
            <div class="row">
                <span class="span3">Email: </span><span class="span9">{{user_email}}</span>
            </div>

            <div class="row">
                <span class="span3">CP License No: </span><span class="span9">{{approvalno}}</span>
            </div>
            <div class="row">
                <span class="span3">License Copy: </span><span class="span9">{{copy}}</span>
            </div>
            <div class="row">
                <span class="span3">License Expiry Date: </span><span class="span9">{{expirydate}}</span>
            </div>
            <div class="applicant_buttons btn-group pull-right">
                <div class="btn btn-info btn-large reviewcert_cp" data-id="{{ID}}" id="ButtonC" data-location="{{copy_br}}">
                    Doc
                </div>
                <div class="btn btn-success btn-large approve" data-id="{{ID}}" id="ButtonA">
                    Approve
                </div>
                <div class="btn reject btn-large btn-danger" data-id="{{ID}}" id='ButtonR'>
                    Reject
                </div>
            </div>
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert">
                    &times;
                </button>
                <strong>Note!</strong>Click on the Doc button to review the Certificate Copy Attachment
            </div>
        </div>
    </div>
</section>
<section id="approvecompany" class="hide">
    <div class="small alert alert-block header">
        <h2 class="brightened">New Pending Companies</h2>Please take a look of the currently pending companies for review and approval to the system
    </div>
    <div class="row-fluid well">
        <div class="span4 new_com_list listpendings"></div>
        <div class="span8 single_com_detail"></div>
    </div>
    <div class="hide">
        <div id="tpl_comlist">
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
        </div>
        <div id="tpl_comdetail">
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
                <span class="span5">Business Registration Expiry Date: </span><span class="span7">{{reg_date}}</span>
            </div>
            <div class="row">
                <span class="span5">Total Representatives submitted: </span><span class="span7">{{total_rep}}</span>
            </div>

            <div class="applicant_buttons btn-group pull-right">
                <div class="btn btn-info reviewcert_br btn-large" data-id="{{ID}}" id="ButtonC" data-location="{{copy_br}}">
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
                <strong>Note!</strong>Click on the Doc button to review the Certificate of Hong Kong Business Registration
            </div>
        </div>
    </div>
</section>
<section id="order_list" class="hide">
    <div class="entry-content row-fluid">
        <div class="span12 well">
            <h2>Incoming Orders</h2>
            <table class="commontable">
                <thead>
                    <tr>
                        <td><span>Service Location</span></td>
                        <td><span>Service Date</span></td>
                        <td><span>Service Time</span></td>
                        <td><span>Order Submission Date</span></td>
                        <td><span>Follow Up</span></td>
                        <td><span class="pull-right">ActionBar</span></td>
                    </tr>
                </thead>
                <tfoot id="tpl_review_order" class="hide">
                    <tr class="datarow new_{{new_order_zero_jobs}}">
                        <td><span class="label label-important">{{location}}</span></td>
                        <td><span>{{service_date}}</span></td>
                        <td><span>{{service_time}}</span></td>
                        <td><span>{{submission_date}}</span></td>
                        <td><span>{{followup}}</span></td>
                        <td>
                        <div class="pull-right btn-group dropup">
                            <button class="btn btn-mini action">
                                Review Processing Order
                            </button>
                        </div></td>
                    </tr>
                </tfoot>
                <tbody id="rez_area_pending_order"></tbody>
            </table>
        </div>
    </div>
</section>
<article id="template" class="hide">
    <?php echo ocmodel::get_tpl('oc', 'tpl_job_broadcast'); ?>
    <?php echo ocmodel::get_tpl('oc', 'tpl_tooling_selection'); ?>
    <?php echo ocmodel::get_tpl('oc', 'tpl_record_job'); ?>
    <?php echo ocmodel::get_tpl('oc', 'tpl_pending_orders'); ?>
</article>
<?php
echo ocmodel::get_tpl('oc', 'tpl_job_view');
echo ocmodel::get_tpl('oc', 'tpl_modals');
?>