<div id="form_work_approval_panel" class="row-fluid work_approval_panel hide" data-order-id="{{order_ref_id}}" data-row-id="" data-job-reference-id="">
    <div class="control-group">
        <fieldset>
            <legend>
                Project ID Assignment
            </legend>
            <div class="controls input-append">
                <input class="" type="text" id="field_assigned_project_id" placeholder="enter your project number at here">
                <button class="btn" type="button">
                    Search For Previous Projects
                </button>
                <a href="#ocdnewproject" role="button" class="btn" data-toggle="modal"> + Project </a>
            </div>
        </fieldset>
        <fieldset>
            <legend>
                Boardcast CP Rating Criteria
            </legend>
            <div class="row-fluid">
                <div class="span3">
                    <span class="star-cb-group">
                        <input type="radio" id="rating-6" name="rating" value="6" />
                        <label for="rating-6">6</label>
                        <input type="radio" id="rating-5" name="rating" value="5" />
                        <label for="rating-5">5</label>
                        <input type="radio" id="rating-4" name="rating" value="4" />
                        <label for="rating-4">4</label>
                        <input type="radio" id="rating-3" name="rating" value="3" />
                        <label for="rating-3">3</label>
                        <input type="radio" id="rating-2" name="rating" value="2" />
                        <label for="rating-2">2</label>
                        <input type="radio" id="rating-1" name="rating" value="1" />
                        <label for="rating-1">1</label>
                        <input type="radio" id="rating-0" name="rating" value="0" class="star-cb-clear" checked="checked" />
                        <label for="rating-0">0</label> </span>
                </div>
                <div class="span9">
                    <div class="controls input-append" data-toggle="buttons-radio">
                        <button class="btn " type="button">
                            No Stars
                        </button>
                        <button class="btn " type="button">
                            At the Minimum
                        </button>
                        <button class="btn " type="button">
                            At the Maximum
                        </button>
                        <button class=" btn " type="button">
                            Specific Members
                        </button>
                    </div>
                    <input disabled type="text" id="requirement_brief" placeholder="no criteria">
                </div>
            </div>
        </fieldset>
    </div>
    <legend>
        Work Schedule
    </legend>
    <div id="key_calendar_pickers" class="controls input-append">
        <input class="datepicker_el" name="set_date" type="text" value="select a date here">
        </input>
        <input class="timepicker_el" name="set_time" type="text" value="select a time here">
        </input>
    </div>
    <!--<div id="scheduler_here" class="dhx_cal_container">
    <div class="dhx_cal_navline">
    <div class="dhx_cal_prev_button">
    &nbsp;
    </div>
    <div class="dhx_cal_next_button">
    &nbsp;
    </div>
    <div class="dhx_cal_today_button"></div>
    <div class="dhx_cal_date"></div>
    <div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
    <div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
    <div class="dhx_cal_tab" name="timeline_tab" style="right:280px;"></div>
    <div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
    </div>
    <div class="dhx_cal_header"></div>
    <div class="dhx_cal_data"></div>
    </div>-->
    <legend>
        The Available Survey Equipments on <span class="available-on">---</span> <input class="btn" type="button" value="Check Toolings Schdule" id="confirm_datetime"/>工具箱設備列表: 
    </legend>
    <div id="key_equipement_management" class="control-group"></div>
    <legend>
        Record Plans
    </legend>
    <div class="row-fluid datarow">
        <input id="upload_image_button" class="button large-btn" type="button" value="Upload Image" />
    </div>
    <div id="appendimages_record_plan"></div>
    <legend>
        Submission
    </legend>
    <div class="row-fluid datarow">
        <div id="apply_and_save_job_data" class="span3 btn_area">
            <!--<div class="upload_record_plan" style="display:inline">&nbsp;</div>-->
            <span>Save</span>
        </div>
        <div id="job_form_close" class="span3 btn_area">
            <span>Close</span>
        </div>
        <div id="review_progress" class="span3 btn_area">
            <span>Approve</span>
        </div>
        <div id="review_progress" class="span3 btn_area">
            <span>Delete</span>
        </div>
    </div>
</div>
