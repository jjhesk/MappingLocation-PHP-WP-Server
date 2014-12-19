<article id="post-0" class="panel">
    <header class="entry-header">
        <h1 class="entry-title">Staff Login Page (Login Name: 326173 at system time 21/32/2013 17:22)</h1>
    </header>
    <!--  <div class="entry-content row-fluid">
    <h5>Please select your working place</h5>
    <div class="btn-group well" data-toggle="buttons-radio">
    <button class="btn btn-large" id="view_pending">
    View New Orders
    <br>
    <small>the new order</small><span class="badge badge-important">2</span>
    </button>
    <button class="btn btn-large " id="view_project">
    Project Board Cast
    <br>
    <small>Successfully boardcasted</small><span class="badge badge-success">2</span>
    </button>
    <button class="btn btn-large " id="view_job">
    Job Records
    <br>
    <small>more job records</small><span class="badge badge-info">2</span>
    </button>
    </div>

    </div>-->
</article><!-- #post-0 -->

<article id="stage" class="">
    <!-- the real content of the block -->
</article>
<section id="project_board_cast" class="hide">
    <div class="entry-content row-fluid">
        <div class="span12 well">
            <h2>BoardCast Market</h2>
            <table>
                <thead>
                    <tr>
                        <td>JobID</td>
                        <td>Job Name</td>
                        <td>Order by CR</td>
                        <td>Reference</td>
                        <td>ActionBar</td>
                    </tr>
                </thead>
                <tfoot id="tpl_order_bc" class="hide">
                    <tr>
                        <td><span class="label label-important">{{jobid}}</span></td>
                        <td><span class="label label-important">{{job_location}}</span></td>
                        <td>{{crid}}</td>
                        <td>{{reference}}</td>
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
                                <li>
                                    send SMS
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
            <h2>Jobs</h2><small>Jobs is the management page for the staff to manage posted jobs starting from that the progress of the job successfully assigned to the CP.</small>
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
            <table>
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
</section>
<section id="order_list" class="hide">
    <div class="entry-content row-fluid">
        <div class="span12 well">
            <h2>Incoming Orders</h2>
            <table>
                <thead>
                    <tr>
                        <td>Service Location</td>
                        <td>Service Date</td>
                        <td>Service Time</td>
                        <td>Submission Date</td>
                        <td>ActionBar</td>
                    </tr>
                </thead>
                <tfoot id="tpl_review_order" class="hide">
                    <tr>
                        <td><span class="label label-important">{{location}}</span></td>
                        <td>{{service_date}}</td>
                        <td>{{service_time}}</td>
                        <td>{{submission_date}}</td>
                        <td>
                        <div class="btn-group dropup">
                            <button class="btn action">
                                Review Order
                            </button>
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <!-- dropdown menu links -->
                                <li>
                                    Reassign
                                </li>
                                <li>
                                    Email
                                </li>
                                <li>
                                    SMS
                                </li>
                            </ul>
                        </div></td>
                    </tr>
                </tfoot>
                <tbody id="rez_area_pending_order"></tbody>
            </table>
        </div>
    </div>
</section>
<article id="template" class="hide">
    <section id="tpl_profile_boardcast">
       <!-- <ul class="nav nav-tabs" id="myTab">
            <li>
                <a data-target="tab_boardcastjob" data-toggle="tab">Boardcasted Job Review</a>
            </li>
            <li>
                <a data-target="tab_recordplan" data-toggle="tab">The Record Plan</a>
            </li>
            <li>
                <a data-target="tab_qualifiedapplicants" data-toggle="tab">Qualified Applicants (CP)</a>
            </li>
        </ul>-->
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane_fade" id="tab_boardcastjob">
                <h3 class="title">Boardcasted Job Review</h3>
                <table>
                    <tbody>
                        <tr>
                            <td>JOB ID</td>
                            <td>{{jobid}}</td>
                        </tr>
                        <tr>
                            <td>Assigned to Project ID</td>
                            <td>{{projectid}}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{status}}</td>
                        </tr>
                        <tr>
                            <td>The Last Boardcast Time</td>
                            <td>{{sendtime}}</td>
                        </tr>
                        <tr>
                            <td>Total Number of Boardcasted CPs</td>
                            <td>{{sendtotal}}</td>
                        </tr>
                        <tr>
                            <td>Total Number of CPs that are interested in this Job</td>
                            <td>{{interested}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane_fade" id="tab_recordplan">
                <h3 class="title"> The Record Plan</h3>
                <div id="illustrateRecordPlan" class="carousel slide" data-interval="5000">
                    <ol class="carousel-indicators">
                        <li data-target="#illustrateRecordPlan" data-slide-to="0" class="active"></li>
                        <li data-target="#illustrateRecordPlan" data-slide-to="1"></li>
                        <li data-target="#illustrateRecordPlan" data-slide-to="2"></li>
                    </ol>
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="active item">
                            <img src="http://onecallapp.imusictech.net/wp-content/uploads/2013/06/temp-e1370254935115.jpg"/>
                        </div>
                        <div class="item">
                            <img src="http://onecallapp.imusictech.net/wp-content/uploads/2013/06/temp-e1370254935115.jpg"/>
                        </div>
                        <div class="item">
                            <img src="http://onecallapp.imusictech.net/wp-content/uploads/2013/06/temp-e1370254935115.jpg"/>
                        </div>
                    </div>
                    <!-- Carousel nav -->
                    <a class="carousel-control left" href="#illustrateRecordPlan" data-slide="prev">&lsaquo;</a>
                    <a class="carousel-control right" href="#illustrateRecordPlan" data-slide="next">&rsaquo;</a>
                </div>
            </div>
            <div class="tab-pane_fade" id="tab_qualifiedapplicants">
                <h3 class="title">Qualified Applicants (CP)</h3>
                <div class="row-fluid indexrow">
                    <div class="span1">
                        CP
                    </div>
                    <div class="span1">
                        Stars
                    </div>
                    <div class="span4">
                        Status
                    </div>
                </div>
                {{#each applicants}}
                <div class="row-fluid">
                    <div class="span1">
                        {{this.cpid}}
                    </div>
                    <div class="span1">
                        {{this.cpstar_level}}
                    </div>
                    <div class="span4">
                        {{this.cpstatus}}
                    </div>
                    <div class="span2">
                        <div class="btn-group dropup">
                            <button class="btn action">
                                Offer Job
                            </button>
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <!-- dropdown menu links -->
                                <li>
                                    Resend Notification Via Email
                                </li>
                                <li>
                                    Resend Notification Via  SMS
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{/each}}
            </div>
        </div>
    </section>
    <section id="tpl_profile_order">
        <h3 class="title">Brief Information for the Pending Order</h3>
        <table>
            <tbody>
                <tr>
                    <td>Service Location</td>
                    <td>{{location}}</td>
                </tr>
                <tr>
                    <td>Service Date</td>
                    <td>{{service_date}}</td>
                </tr>
                <tr>
                    <td>Service Time</td>
                    <td>{{service_time}}</td>
                </tr>
                <tr>
                    <td>Submission Date</td>
                    <td>{{submission_date}}</td>
                </tr>
                <tr>
                    <td>CR ID</td>
                    <td>{{crid}}</td>
                </tr>
                <tr>
                    <td>Client Company</td>
                    <td>{{clientcompany}}</td>
                </tr>
            </tbody>
        </table>
        <h3 class="title">Content of Order</h3>
        <div class="row-fluid indexrow">
            <div class="span1">
                Item
            </div>
            <div class="span2">
                Content
            </div>
            <div class="span7">
                Service Options
            </div>
        </div>
        {{#each content_of_service}}
        <div class="row-fluid">
            <div class="span1">
                {{this.serialno}}
            </div>
            <div class="span2">
                {{this.typeorder}}
            </div>
            <div class="span7">
                {{this.options}}
            </div>
        </div>
        {{/each}}
        <div class="row-fluid work_approval_panel hide">
            <h3 class="title">Project Assignment and Boardcast</h3>
            <div class="control-group">
                <label class="control-label" for="inputEmail">Assign Project Number</label>
                <div class="controls">
                    <input type="text" id="inputEmail" placeholder="info1">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail">Selection of member Ratings</label>
                <div class="controls">
                    <input type="text" id="inputEmail" placeholder="inf2">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail">Call Center customer to confirm orders</label>
                <div class="controls">
                    <input type="text" id="inputEmail" placeholder="info3">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail">Record Plans Uploading</label>
                <div class="controls">
                    <input type="text" id="inputEmail" placeholder="info4">
                </div>
            </div>
        </div>
        {{_order_button_}}
    </section>
</article>
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