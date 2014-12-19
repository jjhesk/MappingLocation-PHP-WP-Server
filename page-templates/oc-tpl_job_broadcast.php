<section id="tpl_profile_boardcast" type="text/x-handlebars-template">
    <ul class="nav nav-tabs" id="myTab">
        <li>
            <a data-target="tab_boardcastjob" data-toggle="tab">Broadcast Job Review</a>
        </li>
        <li>
            <a data-target="tab_recordplan" data-toggle="tab">The Record Plan</a>
        </li>
        <li>
            <a data-target="tab_qualifiedapplicants" data-toggle="tab">Qualified Applicants (CP)</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" id="tab_boardcastjob">
            <h3 class="title">Broadcast Job Review</h3>
            <table class="commontable">
                <tbody>
                    <tr>
                        <td>JOB ID</td>
                        <td>{{jobid}}</td>
                    </tr>
                    <tr>
                        <td>Assigned to the Project ID</td>
                        <td>{{projectid}}</td>
                    </tr>
                    <tr>
                        <td>Job Starting Date</td>
                        <td>{{jobstart_date}}</td>
                    </tr>
                    <tr>
                        <td>Job Starting Time</td>
                        <td>{{jobstart_time}}</td>
                    </tr>
                    <tr>
                        <td>Job Start Location</td>
                        <td>{{jobstart_loc}}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><span class="label label-info">{{status}}</span></td>
                    </tr>
                    <tr>
                        <td>The Last Broadcast Time</td>
                        <td><span class="label label-inverse">{{sendtime}}</span></td>
                    </tr>
                    <tr>
                        <td>Job Application Deadline</td>
                        <td><span class="label label-inverse">{{job_application_deadline}}</span></td>
                    </tr>
                    <tr>
                        <td>Total Number of qualifed CPs at the point of broadcast time</td>
                        <td>{{sendtotal}}</td>
                    </tr>
                    <tr>
                        <td>Total Number of CPs that are interested in this Job</td>
                        <td>{{interested}}</td>
                    </tr>
                    <tr>
                        <td>Remark by staff</td>
                        <td><span class="editable">{{remarks}}</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="tab_recordplan">
            <div class="row-fluid">
                <div class="pull-right btn btn-primary">
                    Upload a Newer Record Plan
                </div>
            </div>
            <div id="illustrateRecordPlan" class="carousel slide" data-interval="5000" data-slide-to="0">
                <ol class="carousel-indicators">
                    <li data-target="#illustrateRecordPlan" data-slide-to="0" class="active"></li>
                    <li data-target="#illustrateRecordPlan" data-slide-to="1"></li>
                    <li data-target="#illustrateRecordPlan" data-slide-to="2"></li>
                </ol>
                <!-- Carousel items -->
                <div class="carousel-inner">
                    <div class="active item">
                        <img src="http://onecallapp.imusictech.net/wp-content/uploads/2013/06/temp-e1370254935115.jpg"/>
                        <div class="carousel-caption">
                            <h4>The lastest record plan V3</h4>
                            <p class="time">
                                12/3/2013
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="http://onecallapp.imusictech.net/wp-content/uploads/2013/06/temp-e1370254935115.jpg"/>
                        <div class="carousel-caption">
                            <h4>Version 2</h4>
                            <p class="time">
                                12/2/2013
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="http://onecallapp.imusictech.net/wp-content/uploads/2013/06/temp-e1370254935115.jpg"/>
                        <div class="carousel-caption">
                            <h4>Version 1</h4>
                            <p class="time">
                                12/1/2013
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Carousel nav -->
                <a class="carousel-control left" href="#illustrateRecordPlan" data-slide="prev">&lsaquo;</a>
                <a class="carousel-control right" href="#illustrateRecordPlan" data-slide="next">&rsaquo;</a>
            </div>
        </div>
        <div class="tab-pane" id="tab_qualifiedapplicants">
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
                <div class="span4 pull-right">
                    Action
                </div>
            </div>
            {{#each applicants}}
            <div class="row-fluid datarow">
                <div class="span1">
                    {{this.cpid}}
                </div>
                <div class="span1">
                    {{this.cpstar_level}}
                </div>
                <div class="span4">
                    {{this.cpstatus}}
                </div>
                <div class="span4 pull-right">
                    <div class="btn-group dropup">
                        <button class="btn btn-small action"  data-toggle="modal" data-target="#cpProfile">
                            View CP Profile
                        </button>
                        <button class="btn btn-small action" data-toggle="modal" data-target="#offerjobCP">
                            Offer Job
                        </button>
                        <button class="btn btn-small dropdown-toggle" data-toggle="dropdown">
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