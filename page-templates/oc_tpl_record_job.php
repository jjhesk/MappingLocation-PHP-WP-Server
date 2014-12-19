<div id="tpl_job_flow" type="text/x-handlebars-template">
    <ul class="nav nav-tabs" id="jobflowtab">
        <li>
            <a data-target="tab_info" data-toggle="tab">Job Meta Info</a>
        </li>
        <li>
            <a data-target="tab_siteimages" data-toggle="tab">Work Site Images</a>
        </li>
        <li>
            <a data-target="tab_graphics" data-toggle="tab">Plots and Graphics</a>
        </li>
        <li>
            <a data-target="tab_reports" data-toggle="tab">Reports Generated</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" id="tab_info">
            <h3 class="title">Job Meta Information</h3>
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
                        <td>Starting Date</td>
                        <td>{{jobstart_date}}</td>
                    </tr>
                    <tr>
                        <td>Starting Time</td>
                        <td>{{jobstart_time}}</td>
                    </tr>
                    <tr>
                        <td>End Time 調查結束時間</td>
                        <td>{{assistantnames}}</td>
                    </tr>
                    <tr>
                        <td>Start Location</td>
                        <td>{{jobstart_loc}}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>{{status}}</td>
                    </tr>
                    <tr>
                        <td>Total running time</td>
                        <td>{{total_running_time}}</td>
                    </tr>
                    <tr>
                        <td>Total Generated Reports by the appointed CP</td>
                        <td>{{reports}}</td>
                    </tr>
                    <tr>
                        <td>Remark by staff</td>
                        <td>{{remarks}}</td>
                    </tr>
                    <tr>
                        <td> Assistant Names 助手名字</td>
                        <td>{{assistantnames}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="tab_siteimages">
            <h3 class="title">Work Site Images</h3>
            <div id="box_siteimages" class="carousel slide" data-interval="5000"  data-slide-to="0">
                <ol class="carousel-indicators">
                    {{#each siteimages}}
                    <li data-target="#box_siteimages" data-slide-to="{{this.order}}"></li>
                    {{/each}}
                </ol>
                <!-- Carousel items -->
                <div class="carousel-inner">
                    {{#each siteimages}}
                    <div class="item">
                        <img src="{{this.url}}"/>
                    </div>
                    {{/each}}
                </div>
                <!-- Carousel nav -->
                <a class="carousel-control left" href="#box_siteimages" data-slide="prev">&lsaquo;</a>
                <a class="carousel-control right" href="#box_siteimages" data-slide="next">&rsaquo;</a>
            </div>
        </div>
        <div class="tab-pane" id="tab_graphics">
            <h3 class="title">Plots and Graphics</h3>
            <fieldset id="" class="setrow">
                <div class="btn-group">
                    <button class="btn btn-small action">
                        Show Image
                    </button>
                    <button class="btn btn-small action">
                        Show Imported Data
                    </button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-small action">
                        Previous (8/5/2013 23:11pm)
                    </button>
                    <button class="btn btn-small action">
                        Next (3/6/2013 4:11pm)
                    </button>
                </div>
            </fieldset>
            <div class="row-fluid indexrow">
                <div class="span1">
                    Ref. X
                </div>
                <div class="span1">
                    Ref. Y
                </div>
                <div class="span3">
                    Width
                    <br>
                    (mm if known)
                </div>
                <div class="span1">
                    Est. Depth
                </div>
                <div class="span2">
                    From X (m)
                </div>
                <div class="span2">
                    From Y (m)
                </div>
            </div>
            {{#each plotdata}}
            <div class="datarow row-fluid">
                <div class="span1">
                    {{this.rx}}
                </div>
                <div class="span1">
                    {{this.ry}}
                </div>
                <div class="span3">
                    {{this.w}}
                </div>
                <div class="span1">
                    {{this.e}}
                </div>
                <div class="span2">
                    {{this.fx}}
                </div>
                <div class="span2">
                    {{this.fy}}
                </div>
            </div>
            {{/each}}
        </div>
        <div class="tab-pane" id="tab_reports">
            <h3 class="title">Reports Generated</h3>
            <div class="row-fluid indexrow">
                <div class="span2">
                    Date
                </div>
                <div class="span2">
                    Time
                </div>
                <div class="span4">
                    Report Template
                </div>
                <div class="span4 pull-right">
                    Action
                </div>
            </div>
            {{#each reports_archive}}
            <div class="row-fluid datarow">
                <div class="span2">
                    {{this.date}}
                </div>
                <div class="span2">
                    {{this.time}}
                </div>
                <div class="span4">
                    {{this.template}}
                </div>
                <div class="span4 pull-right">
                    <div class="btn-group dropup">
                        <button class="btn btn-small action">
                            View PDF
                        </button>
                        <button class="btn btn-small action">
                            Print PDF
                        </button>
                        <button class="btn btn-small dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <!-- dropdown menu links -->
                            <li>
                                Mark Star
                            </li>
                            <li>
                                Unmark
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {{/each}}
        </div>
    </div>
</div>