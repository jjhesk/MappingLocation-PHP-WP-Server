<section id="tpl_profile_order" type="text/x-handlebars-template">
    <ul class="nav nav-tabs" id="t_pending_order">
        <li>
            <a data-target="tab_briefinfo" data-toggle="tab">Brief Information</a>
        </li>
        <li>
            <a data-target="tab_content_order" data-toggle="tab">The Content of Order</a>
        </li>
        <li>
            <a data-target="tab_approve_order" data-toggle="tab">Job Assignment</a>
        </li>
        <li>
            <a data-target="tab_content_committed" data-toggle="tab">Approved and Broadcasted Jobs</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" id="tab_briefinfo">
            <h3 class="title">Brief Information for the Pending Order</h3>
            <table class="commontable">
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
                        <td>Order Reference ID</td>
                        <td>{{order_ref_id}}</td>
                    </tr>
                    <tr>
                        <td>CR Name</td>
                        <td>{{crname}}</td>
                    </tr>
                    <tr>
                        <td>Client Company</td>
                        <td>{{company}}</td>
                    </tr>
                    <tr>
                        <td>Total Service Orders</td>
                        <td>{{total}}</td>
                    </tr>
                </tbody>
            </table>
            <div class="btn-group row-fluid">
                <button class="btn printfunction action icon icon4" data-print-id="{{order_ref_id}}">
                    Print Doc
                </button>
                <button class="btn sendfunction icon icon28">
                    Send Copy
                </button>
            </div>
        </div>
        <div class="tab-pane" id="tab_content_order">
            <h3 class="title">Content of Order from CR</h3>
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert">
                    &times;
                </button>
                <strong>Note!</strong> This is the content of the CR requirements..
            </div>
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
            <div class="row-fluid datarow">
                <div class="span1">
                    {{this.item}}
                </div>
                <div class="span2">
                    {{this.type}}
                </div>
                <div class="span7">
                    {{#each this.content.list}}
                    {{this}}
                    <br>
                    {{/each}}
                    {{paymentmethod}}
                </div>
            </div>
            {{/each}}
        </div>
        <div class="tab-pane" id="tab_approve_order">
            <div class="ifload"></div>
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert">
                    &times;
                </button>
                <strong>Note!</strong> Press the plus sign to adding new job and click on the job stack to edit the job assignment detail.
            </div>
            <?php
            echo ocmodel::get_tpl('oc', 'ocstaff_order_editing');
            echo ocmodel::get_tpl('oc', 'processing_jobs');
            ?>
        </div>
        <div class="tab-pane" id="tab_content_committed">
            <?php  echo ocmodel::get_tpl('oc', 'approved_jobs'); ?>
        </div>
    </div>
</section>