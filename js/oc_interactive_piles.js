/* job booking sections*/
var oc_JB = {
	cb_edit_existing_job : function(db) {
		$('#jobs_container').fadeOut(transition_time_span, function() {
			$('#form_work_approval_panel').fadeIn(function() {
				/* landed at the editing form here and restore the data on the screen */
				rprocess.cb_edit_existing_panel(db);
				//	ocdata.action_save_job_editing_form(db);
			});
		});
	},
	cb_add_new_job_by_order_id : function(return_new_row_id, ref) {
		$('#jobs_container').fadeOut(transition_time_span, function() {
			$('#form_work_approval_panel').fadeIn(function() {
				$(this).removeClass('hide');
				$('#jobs_container').addClass('hide');
				$('#form_work_approval_panel').attr('data-row-id', return_new_row_id);
				$('#form_work_approval_panel').attr('data-job-reference-id', ref);
				$('#apply_and_save_job_data').unbind(interactions).on(interactions, {
					action : "save"
				}, button_processing_order_close_area);
			});
		});
	},
	tab_approve_order_interactions : function() {
		$('#jobs_container .buttons button, #jobs_container .job.new, #jobs_container .job:not(.new),#jobs_container li.job .remove_btn').unbind(interactions);
		$('#jobs_container .buttons button').unbind(interactions).on(interactions, function(e) {
			console.log("init_tab_approve_order buttons");
			if ($(this).hasClass('grid')) {
				$('#jobs_container ul').removeClass('list').addClass('grid');
			} else if ($(this).hasClass('list')) {
				$('#jobs_container ul').removeClass('grid').addClass('list');
			}
		});
		$('#jobs_container .job.new').unbind(interactions).on(interactions, function(e) {
			//console.log(ocdata.db_current_cr_order.order_ref_id);
			ocdata.add_new_job_by_order_id(ocdata.db_current_cr_order.order_ref_id, oc_JB.cb_add_new_job_by_order_id);
		});
		$('#jobs_container .job:not(.new)').unbind(interactions).on(interactions, function(e) {
			console.log("edit job assignment");
			var ref_id = $(this).attr("data-id");
			var current_query_form_object;
			current_query_form_object = oc.findWhere(ocdata.db_query_jobs_pool.data, "ID", ref_id);
			console.log("after selecting this part of the job the form will appear.");
			ocdata.db_current_editing_job_form = current_query_form_object;
			oc_JB.cb_edit_existing_job(current_query_form_object);
		});
		$('#jobs_container li.job .remove_btn').unbind(interactions).on(interactions, button_confirm_remove_job_by_id);
		$('#tab_approve_order .ifload').showLoading(false);
	},
	cb_oc_tool : function() {
		console.log("cb oc tool");
		var el_1 = $(".datepicker_el");
		var el_2 = $(".timepicker_el");
		var el_3 = $("#key_equipement_management");
		el_2.removeAttr('disabled');
		el_1.removeAttr('disabled');
		//disable interactions in the tooling table
		//when select item from the tool box this will be picked as the equiped tools for the CP
		el_3.find(".datarow >div:first-child").each(function(index, item) {
			var add_tool_button = $(this);
			//var tool_id = add_tool_button.attr("data-tool-id");
			add_tool_button.unbind(interactions).on(interactions, {
				tool : add_tool_button.attr("data-tool-id")
			}, function(e) {
				var a = $(this).hasClass("active");
				if (!a) {
					oc.add_to_collection(e.data.tool, ocdata.db_current_editing_job_form, "toolset");
					$(this).addClass("active");
				} else {
					oc.remove_from_collection(e.data.tool, ocdata.db_current_editing_job_form, "toolset");
					$(this).removeClass("active");
				}
				console.log(ocdata.db_current_editing_job_form.toolset);
				//			console.log(event.data.tool)
			});
		});
	}
}
