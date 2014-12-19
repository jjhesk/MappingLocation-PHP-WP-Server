var $ = jQuery, as;
var view_order_list = $("#order_list"), view_board_cast_jobs = $("#project_board_cast"), view_jr = $("#job_record");
var rprocess = {
    cb_edit_existing_panel: function (db) {
        /* restore the data and continue for editings */
        var field_project_id = $('#field_assigned_project_id');
        var rating_cp = $(".star-cb-group");
        var rating_summery = $("#requirement_brief");
        var date = $('input[name="set_date"]');
        var time = $('input[name="set_time"]');
        //time.val();
        console.log("/* start init all the objects */");
        if (typeof conponent_init == 'object') {
            //calender picker initialization
            conponent_init.timepickers();
            if (typeof wp == 'object') {
                //wp file uploader initialization
                conponent_init.mUploader();
            } else {
                console.log('/* object wp is not loaded, upload module is disabled. */');
            }
        } else {
            console.log('/* cal_picker is not initiated */');
        }
        console.log(db);
        field_project_id.val(db.project_ref_id);
        date.val(db.set_service_date);
        time.val(db.set_service_time);
        if (db.get_toolset.length > 0) {
            console.log('restore the toolset ref id');
            console.log(db.get_toolset);
            //ocdata.get_equipment_list(db.ID);
            rprocess.render_tools_set(db.get_toolset);
            oc_JB.cb_oc_tool();
        }
        $("#confirm_datetime").unbind(interactions).on(interactions, button_confirm_order_date_checking);
        $('#apply_and_save_job_data').unbind(interactions).on(interactions, {
            action: "save"
        }, button_processing_order_close_area);
        $("#job_form_close").unbind(interactions).on(interactions, button_processing_order_close_area);
        $('#form_work_approval_panel').removeClass('hide');
        $('#jobs_container').addClass('hide');
    },
    cb_processing_order_close_area: function (db) {
        $('#jobs_container').addClass('hide');
        //only take one item from the input
        //testing data http://onecallapp.imusictech.net/api/staffcontrol/get_job_data/?dev=1&order_id=12
        //in the object data
        var tpl = $("#tpl_single_processing_job").html();
        var template = Handlebars.compile(tpl);
        var output;
        try {
            output = template(db);
        } catch (e) {
            console.log("returned db");
            console.log(db);
            console.log(e);
        }
        $('#jobs_container ul.grid').html(output);
        $('#jobs_container').fadeIn(transition_time_span, function () {
            oc_JB.tab_approve_order_interactions();
        });
    },
    cb_processing_order_close_area_empty: function () {
        console.log("cb_processing_order_close_area_empty");
        $('#jobs_container').addClass('hide');
        $('#jobs_container ul.grid').html($("#tpl_single_processing_job_empty").html());
        $('#jobs_container').fadeIn(transition_time_span, function () {
            console.log("jobs_container fadeIn");
            $('#jobs_container').removeClass('hide');
            oc_JB.tab_approve_order_interactions();
        });
    },
    render_selected_pictures: function (db) {
        var tpl = $("#tpl_images_selected_record_plan").html();
        var template = Handlebars.compile(tpl);
        var output;
        try {
            output = template(db);
        } catch (e) {
            console.log(e);
        }
        $("#appendimages_record_plan").append(output);
    },
    render_tools_set: function (db) {
        /* this tool setting will be starting from zero once the inventory reserve time or date has been changed */
        ocdata.db_current_editing_job_form.toolset = "";
        var tpl = $("#tpl_toolings_options").html();
        var template = Handlebars.compile(tpl);
        var output;
        try {
            output = template(db);
        } catch (e) {
            console.log(e);
        }
        $("#key_equipement_management").html(output);
    },
    pre_render_panels: function (template, data, appendview, callback) {
        var s = this;
        //clean the view
        appendview.html("");
        //find the existing template format in string format
        var tpl = $(template).html();
        //read the json data
        _.each(data, function (i) {
            var output = Mustache.render(tpl, i);
            appendview.append(output);
        });
        callback();
    },
    render_templates: function (import_data, tpl, target) {
        //tempid
        var d_template_html = $(tpl).html();
        // console.log("render_templates count now 1");
        var template = Handlebars.compile(d_template_html);
        //console.log("render_templates count now 2");
        //log(import_data);
        var output;
        try {
            output = template(import_data);
        } catch (e) {
            console.log(e);
        }
        //console.log("render_templates count now 3");
        target.html(output);
        //console.log('total items are ' + import_data.total);
        // console.log("render_templates count now 4");
    },
    displayView: function ($view_id) {
        as.current_view = $view_id;
        if (as.hole.view_profile.hasClass("view_rendered")) {
            as.hole.view_profile.slideUp(transition_time_span, function () {
                as.hole.view_profile.removeClass("view_rendered").addClass("hide");
            });
        }
        $.each(as.views, function (index, i) {
            if (i != $view_id) {
                //console.log("view id is not displayed");
                $(i).slideUp();
                //.removeClass("flipOutX");
            }
        });
        $view_id.removeClass("hide").removeClass("flipOutX").slideDown();
    }
}
var tab_control = {
    dash_tab_control: function (tab_id, the_first_tab) {
        //----------------------tab control
        var ck = $('#dashcontainer #' + tab_id).tab();
        $('#dashcontainer a[data-toggle="tab"]').on('shown', function (e) {
            var t = $('#dashcontainer').find(e.target).attr("data-target");
            // activated tab
            if (e.relatedTarget != "undefined") {
                var prev = $('#dashcontainer').find(e.relatedTarget).attr("data-target");
                $('#dashcontainer').find("#" + prev).removeClass("active");
                //.addClass("fade");
            }
            $('#dashcontainer').find("#" + t).addClass("active");
            //.removeClass("fade");
        });
        var vcc = $('#dashcontainer a[data-target="' + the_first_tab + '"]').trigger('click');
        //	$('#dashcontainer .carousel').carousel({interval : 5000});
        //	$('#dashcontainer .carousel').carousel(0);
    },
    _tab_control: function (tab_id, the_first_tab) {
        //----------------------tab group control
        var ck = $('#Profilearea #' + tab_id).tab();
        var interactive_tab = $('#Profilearea a[data-toggle="tab"]');
        interactive_tab.unbind(interactions).on(interactions, function (e) {
            try {
                // call up the custom functions the given text callback_fn
                var callback_fn = "init_" + $(this).attr("data-target");
                console.log("call function :" + callback_fn);
                eval(callback_fn + "();");
            } catch (e) {
                var txt = "There was an error on this page.";
                txt += "Error description: " + e.message + "  ";
                txt += "Click OK to continue.\n\n";
                //console.log(txt);
            } finally {

            }
        });
        interactive_tab.on('shown', function (e) {
            var t = $('#Profilearea').find(e.target).attr("data-target");
            // activated tab
            if (e.relatedTarget != "undefined") {
                var prev = $('#Profilearea').find(e.relatedTarget).attr("data-target");
                $('#Profilearea').find("#" + prev).removeClass("active");
            }
            $('#Profilearea').find("#" + t).addClass("active");
            //.removeClass("fade");
            return false;
        });
        var vcc = $('#Profilearea a[data-target="' + the_first_tab + '"]').trigger('click');
        $('#Profilearea .carousel').carousel({
            interval: 5000
        });
        $('#Profilearea .carousel').carousel(0);
    }
}

var oc_staff = {
    init: function () {
        Handlebars.registerHelper('tool_set_selection_bool_active', function () {
            if (typeof this.isActive == "boolean") {
                if (this.isActive)
                    return "active";
                return "";
            } else {
                return "";
            }
        });
        Handlebars.registerHelper('_order_button_', function () {
            var _class_ = "", label = "start";
            if (this.approved == "pending") {
                _class_ = "btn-info";
                label = "Approve and Assign This Order";
            }
            if (this.approved == "already_for_approve") {
                _class_ = "btn-info";
                label = "Submit This Assignment";
            }
            return new Handlebars.SafeString('<button id="big_top_bt" class="btn-block btn-large ' + _class_ + '">' + label + '</button>');
        });
        //_order_button_second_
        Handlebars.registerHelper('_order_button_second_', function () {
            var _class_ = "", label = "start";
            if (this.approved == "pending") {
                _class_ = "btn-primary";
                label = "Edit";
            }
            if (this.approved == "already_for_approve") {
                _class_ = "btn-primary";
                label = "Commit and Boardcast Job Posting";
            }
            return new Handlebars.SafeString('<button id="big_top_bt2" class="btn-block btn-large ' + _class_ + '">' + label + '</button>');
        });
        // _time_recogition_ require oc_time object
        Handlebars.registerHelper('whenago', function () {
            var timenow;
            if (typeof oc_time != 'object') {
                console.log("_time_recogition_ require oc_time object");
                return "";
            }
            if (typeof this.stamp == 'string') {
                timenow = this.stamp;
            }
            if (typeof this.submission_date == 'string') {
                timenow = this.submission_date;
            }
            return new Handlebars.SafeString(oc_time.oneDate(timenow));
        });
        Handlebars.registerHelper('paymentmethod', function () {
            var output = "";
            if (typeof this.content.method == 'string') {
                //console.log(this.content.method);
                switch (parseInt(this.content.method)) {
                    case 2:
                        output = " Payment with credit card.";
                        break
                    case 1:
                        output = " Payment with cash.";
                        break
                    default:
                        output = " No payment method.";
                }
            }
            return new Handlebars.SafeString(output);
        });

        initialization_modal_controller();
        ocdata.action_incoming_order();
        ocdata.get(oc_obj.api_getpending_cp, ocReload.importdata_pendingcplist);
        ocdata.get(oc_obj.api_getpending_com, ocReload.importdata_pendingcomlist);
        var s = this;
        //console.log("demo_new_cp_data");
        //demo_new_cp_data
        $("#page").removeClass('white');
        $("#main>article>.entry-content").addClass("threed");
        //this is the view new orders button
        as.buttons.view_approve_com.unbind(interactions).on(interactions, function (e) {
            ocReload.data.type = "approvecompany";
            ocReload.pending_cb();
            console.log("---------------");
            console.log(ocdata.new_com);
            rprocess.displayView(as.views.view_approve_com);
            s.button_interactions.review_application_interactions("#tpl_comdetail", as.hole.comdetail, ocdata.new_com);
            s.button_interactions.topmenubar_active_change($(this));
        });
        as.buttons.view_approve_cp.unbind(interactions).on(interactions, function (e) {
            ocReload.data.type = "approvecp";
            ocReload.pending_cb();
            rprocess.displayView(as.views.view_approve_cp);
            s.button_interactions.review_application_interactions("#tpl_cpdetail", as.hole.cpdetail, ocdata.new_cp);
            s.button_interactions.topmenubar_active_change($(this));
        });
        //------------------------------------------
        //	view new orders
        as.buttons.view_pending_btn.unbind(interactions).on(interactions, function (e) {
            rprocess.pre_render_panels("#tpl_review_order", ocdata.db_pendingorder, as.hole.view_list_pendingorder_rez, s.button_interactions.pendingorder);
            rprocess.displayView(as.views.view_order_list);
            s.button_interactions.topmenubar_active_change($(this));
        });
        as.buttons.view_project_btn.unbind(interactions).on(interactions, function (e) {
            rprocess.pre_render_panels("#tpl_order_bc", demo_boardcast_data, as.hole.view_list_boardcast_rez, s.button_interactions.boardcast);
            rprocess.displayView(as.views.view_board_cast_jobs);
            s.button_interactions.topmenubar_active_change($(this));
        });
        as.buttons.view_job_btn.unbind(interactions).on(interactions, function (e) {
            rprocess.pre_render_panels("#tpl_job_pool", demo_jobpool_data.data, as.hole.view_list_jobpool_rez, s.button_interactions.jobpool_actions);
            rprocess.displayView(as.views.view_jobpool);
            s.button_interactions.topmenubar_active_change($(this));
            console.log("try here 131");
            schedulerinit('scheduledashboard', oc_obj.api_job_data);
            console.log("try here 134");
            tab_control.dash_tab_control("t_pending_order", "tab_workday");
        });
        $(".colorboxsetting1").colorbox({transition:"fade", width:"75%", height:"75%"});
        as.buttons.view_job_btn.trigger("click");
        $("#returnbasemappeek").on(interactions, function (e) {
            $.colorbox({href: oc_obj.returnbasemap_url});
            return false;
        });
    },
    testcallback: function () {
        console.log("this is one call");
    },
    button_interactions: {
        topmenubar_active_change: function (obj) {
            $("ul.nav>li").removeClass('active');
            obj.addClass("active");
        },
        //interactions for new cp and the new company registrations
        review_application_interactions: function (template_string, target_place, db) {
            //console.log("action review_application_interactions start");
            // console.log(target_place);
            var listview = target_place.parent().find(".listpendings");
            // console.log(listview);
            //list section
            var button_bar = listview.find(".view_detail_application_btn");
            //list button
            var button_list_accept = listview.find(".applicant_buttons .btn.btn-success");
            var button_list_reject = listview.find(".applicant_buttons .btn.btn-danger");
            //-------------------------------------
            var big_accept_button = target_place.find(".applicant_buttons .btn.approve");
            var big_reject_button = target_place.find(".applicant_buttons .btn.reject");
            var big_viewdoc_button = target_place.find(".applicant_buttons #ButtonC");

            //binding actions for the button list
            button_list_accept.unbind(interactions).on(interactions, button_accept_byid);
            button_list_reject.unbind(interactions).on(interactions, button_reject_byid);
            big_accept_button.unbind(interactions).on(interactions, button_accept_byid);
            big_reject_button.unbind(interactions).on(interactions, button_reject_byid);
            big_viewdoc_button.unbind(interactions).on(interactions, button_view_doc);
            //button bar interactions for getting the list view into the detail view
            button_bar.unbind(interactions).on(interactions, function (event) {
                var _id_ = $(this).attr("data-id").toString();
                var _name = $(this).find("span").html();
                var data_render = {};
                data_render.src = _.where(db.src, {
                    ID: _id_
                });
                button_bar.removeClass("active");
                $(this).addClass("active");
                rprocess.render_templates(data_render.src[0], template_string, target_place);
                // console.log("complete rending html, now mapping keys");
                // console.log(big_viewdoc_button);
                button_bar.unbind(interactions);
                button_list_accept.unbind(interactions);
                button_list_reject.unbind(interactions);
                oc_staff.button_interactions.review_application_interactions(template_string, target_place, db);
            });
        },
        //TODO: interaction for the callback() under pre_render_process()
        boardcast: function () {
            //var s = this;
            //	as.current_view.addClass("flipOutX");
            as.buttons.action_btn = $("button.btn.action");
            as.buttons.action_btn.unbind(interactions).on(interactions, function (event) {
                var order = table_select_interaction($(this));
                //TODO: need to do db request and return with data in json format : please see the object: demo_cp_from_boardcast
                oc_staff.profile_bc_jobs(demo_cp_from_boardcast);
            });
            as.buttons.action_boardcastbutton = $(".button_sms");
        },
        pendingorder: function () {
            //		as.current_view.addClass("flipOutX");
            as.buttons.action_btn = $("button.btn.action");
            as.buttons.action_btn.unbind(interactions).on(interactions, function (event) {
                var order = table_select_interaction($(this));
                oc_staff.profile_order(ocdata.db_pendingorder[order]);
                //				console.log("oc pending orders break");
                as.current_view.removeAttr("style").addClass("flipOutX");
            });
        },
        jobpool_actions: function () {
            //	as.current_view.addClass("flipOutX");
            var action1 = $("#viewby_time");
            var action2 = $("#searchby_project");
            var action3 = $("#searchby_cp");
            action1.unbind(interactions).on(interactions, function (event) {
                console.log("part 1");
                return false;
            });
            action2.unbind(interactions).on(interactions, function (event) {
                console.log("part 2");
                return false;
            });
            action3.unbind(interactions).on(interactions, function (event) {
                console.log("part 3");
                return false;
            });
            as.buttons.action_btn = $("button.btn.action");
            as.buttons.action_btn.unbind(interactions).on(interactions, function (event) {
                var order = table_select_interaction($(this));
                oc_staff.profile_job_records(demo_datamodel_individual_jobrecord);
                as.current_view.removeAttr("style").addClass("flipOutX");
                //console.log("-----------------------------");
                //console.log(demo_datamodel_individual_jobrecord);
                //console.log(order);
                //TODO: need to do db request and return with data in json format : please see the object: demo_cp_from_boardcast
                //oc_staff.profile_bc_jobs(demo_cp_from_boardcast);
            });
        }
    },
    profile_bc_jobs: function (import_data) {
        //i : individual json order of the tab
        var tpl = $("#tpl_profile_boardcast").html();
        as.hole.view_profile.html("").addClass("view_rendered").removeClass('hide');
        var template = Handlebars.compile(tpl);
        var output;
        try {
            output = template(import_data);
        } catch (e) {
            console.log(e);
        }
        //		console.log(output);
        var e = this;
        as.hole.view_profile.html(output).slideDown(transition_time_span, function () {
            tab_control._tab_control("myTab", "tab_qualifiedapplicants");
        });
        //-------------------------
        /*
         $('#Profilearea #tablist_boardcast a').unbind(interactions).on(interactions, function(event) {;
         //TODO: need to do db request and return with data in json format : please see the object: demo_cp_from_boardcast
         event.preventDefault();
         console.log("log tab is touched");
         $(this).tab('show');
         });
         */
    },
    profile_job_records: function (import_data) {
        //console.log("start inter");
        //$('#job_record_brief_info .label').tooltip('toggle');
        $('#job_record_brief_info .label').popover({
            animation: true,
            placement: 'top'
        });
        var template = Handlebars.compile($("#tpl_job_flow").html());
        console.log(import_data);
        var output;
        try {
            output = template(import_data);
        } catch (e) {
            console.log(e);
        }
        //--------------------------------------
        as.hole.view_profile.html("").addClass("view_rendered").removeClass('hide');
        as.hole.view_profile.html(output).slideDown();
        //as.buttons.work_on_btn = $("#big_top_bt");
        //----------------------tab control------
        tab_control._tab_control("jobflowtab", "tab_info");
    },
    profile_order: function (import_data) {
        /*append the view of the pending order panel for the staff to work on the order further*/
        var tpl = $("#tpl_profile_order").html();
        as.hole.view_profile.html("").addClass("view_rendered").removeClass('hide');
        //console.log("this is one of profile_order");
        //var output = Mustache.to_html(tpl, i);
        //Start rendering the template of the control panel for....
        var template = Handlebars.compile(tpl);
        var output;
        ocdata.db_current_cr_order = import_data;
        try {
            output = template(import_data);
        } catch (e) {
            console.log(e);
        }
        //console.log(import_data);
        //console.log("current on click data from the CR orders");
        as.hole.view_profile.html(output).slideDown();
        //------------buttons on some tab---
        as.buttons.work_on_btn = $("#big_top_bt");
        as.buttons.work_on_btn2 = $("#big_top_bt2");
        as.buttons.work_on_btn2.unbind(interactions).on(interactions, function () {
            $(this).html("Commit and Boardcast Job Posting");
        });
        as.buttons.work_on_btn.unbind(interactions).on(interactions, function () {
            $(this).html("Save and Submit to the Moderators");
            as.hole.view_profile.find(".work_approval_panel").remove('hide').slideDown();
            console.log("---try here 295");
            schedulerinit('scheduler_here');
            console.log("---try here 297");
            $(this).unbind(interactions).on(interactions, function () {
                $(this).html("Make Changes on th Pending Boardcasting Thread");
                as.hole.view_profile.find(".work_approval_panel").remove('hide').slideUp();
            });
        });
        //-----------tab control---
        tab_control._tab_control("t_pending_order", "tab_briefinfo");
    }
}

jQuery(function ($) {
    as = {
        text: {
            edit: "edit"
        },
        hole: {
            view_list_jobpool_rez: $("#rez_jobpool"),
            view_list_boardcast_rez: $("#rez_boardcastjobs"),
            view_list_pendingorder_rez: $("#rez_area_pending_order"),
            view_profile: $("#Profilearea"),
            cplist: $("#approvecp .new_cp_list"),
            cpdetail: $("#approvecp .single_cp_detail"),
            comlist: $("#approvecompany .new_com_list"),
            comdetail: $("#approvecompany .single_com_detail")
        },
        current_view: "",
        views: {
            view_order_list: $("#order_list"),
            view_board_cast_jobs: $("#project_board_cast"),
            view_jobpool: $("#job_record"),
            view_approve_cp: $("#approvecp"),
            view_approve_com: $("#approvecompany")
        },
        buttons: {
            view_pending_btn: $("#view_pending"),
            view_project_btn: $("#view_project"),
            view_job_btn: $("#view_job"),
            action_btn: $("button.btn.action"),
            view_approve_cp: $('#approve_cp'),
            view_approve_com: $('#approve_com')
        }
    }
    oc_staff.init();
});

function initialization_modal_controller() {
    var objcpprofile = $('#cpProfile');
    var objofferjobcp = $('#offerjobCP');
    //api_addnewproject
    var objnewproject = $('#ocdnewproject');
    var intDialog = $("#ocdialogs");
    $('#cpProfile, #offerjobCP, #ocdnewproject, #ocdialogs').appendTo("body");
    //$('#offerjobCP').appendTo("body");
    //$('#ocdnewproject').appendTo("body");
    intDialog.on("show", function () {// wire up the OK button to dismiss the modal when shown
        intDialog.find("a.btn").unbind(interactions).on(interactions, function (e) {
            console.log("button pressed");
            // just as an example...
            intDialog.modal('hide');
            // dismiss the dialog
        });
    });
    intDialog.on("hide", function () {// remove the event listeners when the dialog is dismissed
        $("#myModal a.btn").off(interactions);
    });
    intDialog.on("hidden", function () {// remove the actual elements from the DOM when fully hidden
        intDialog.remove();
    });
    objnewproject.on("show", function () {
        var field = $('#project_id_input');
        var field_display = $("#field_assigned_project_id");
        field.val("");
        $("#creat_new_project_btn").unbind(interactions).on(interactions, function () {
            $.getJSON(oc_obj.api_addnewproject, function (db) {
                field_display.val(field.val());
                console.log(db.result);
                console.log(a);
                //TODO: to be continue for the function of adding new project
            });
        });
    });
    //intDialog.modal({// wire up the actual modal functionality and show the dialog
    //	"backdrop" : "static",
    //	"keyboard" : true,
    //	"show" : true // ensure the modal is shown immediately
    //});
}

function table_select_interaction(button_object, action_tag_input) {
    //$(this) =objjq
    var action_tag = "";
    //	console.log( typeof (action_tag_input));
    if (typeof (action_tag_input) != "string")
        action_tag = "success";
    else
        action_tag = action_tag_input;
    //	console.log(action_tag);
    var tr = button_object.closest("tr");
    button_object.closest("table").find("." + action_tag).removeClass(action_tag);
    tr.addClass(action_tag);
    return tr.index();
    //	console.log(ord);
}


