function button_accept_byid(event) {
	var _id_ = $(this).attr("data-id");
	var type = $(this).closest("section").id;
	event.stopPropagation();
	//ocdata.action_pending_procedure(_id_, type, "accept");
	bootbox.confirm("Approve this application?", function(result) {
		if (result) {
			ocdata.action_pending_procedure(_id_, type, "accept");
		}
		//	console.log("action clicked button_list_accept id=" + _id_ + " type=" + type + " and  the result =" + result);
	});
}

function button_reject_byid(event) {
	var _id_ = $(this).attr("data-id");
	var type = $(this).closest("section").id;
	//attr("id");
	event.stopPropagation();
	bootbox.confirm("Reject this application?", function(result) {
		if (result) {
			ocdata.action_pending_procedure(_id_, type, "reject");
		}
		//	console.log("action clicked button_list_accept id=" + _id_ + " type=" + type + " and  the result =" + result);
	});
}

/*---- -----*/
function button_view_doc(event) {
	console.log(event.data);
	var document_id = $(this).attr("data-id");
	var feature_cp = $(this).hasClass("reviewcert_cp");
	var feature_br = $(this).hasClass("reviewcert_br");
	var document_location = $(this).attr("data-location");
	if (feature_cp) {
		pdf.loadClassic(document_location);
		console.log("do code @ feature _cp");
	}
	if (feature_br) {
		pdf.loadClassic(document_location);
		console.log("do code @ feature _br");
	}

	return false;
}

function button_confirm_order_date_checking(event) {
	var el_1 = $(".datepicker_el");
	var el_2 = $(".timepicker_el");
	var the_date = el_1.val();
	var the_time = el_2.val();
	if (the_date != "select a date here" && the_time != "select a time here") {
		el_2.attr('disabled', 'disabled');
		el_1.attr('disabled', 'disabled');
		$(".available-on").html(the_date + " - " + the_time);
		ocdata.get_equipment_inventory_system({
			date : the_date,
			time : the_time
		});
	}
	return false;
}

//processing orders tab
function button_processing_order_close_area(e) {
	$('#form_work_approval_panel').fadeOut(transition_time_span, function() {
		console.log(ocdata.db_current_editing_job_form);
		$('#tab_approve_order .ifload').showLoading(true);
		ocdata.get_jobs_by_order_id(ocdata.db_current_cr_order.order_ref_id);
	});

	if (e.hasOwnProperty("data")) {
		if (ocdata.hasOwnProperty("db_current_editing_job_form")) {
			ocdata.action_save_job_editing_form(ocdata.db_current_editing_job_form);
		}else{
			console.log("no data ocdata -> db_current_editing_job_form");
		}
	}
	/*

	 if (e.data.action == "save") {
	 ocdata.action_save_job_editing_form(db);
	 }*/

}

function button_confirm_remove_job_by_id(event) {
	var pid = $(this).closest("li.job").attr('data-id');
	bootbox.confirm("Are you sure that you want to confirm this job process?", function(result) {
		if (result) {
			console.log("order id, job id");
			//console.log(ocdata.db_current_cr_order.order_ref_id);
			//console.log(pid);
			oc.remove_child_el(ocdata, "db_current_editing_job_form");
			console.log(ocdata);
			ocdata.action_remove_job_approve(ocdata.db_current_cr_order.order_ref_id, pid);
		} else {
			console.log("did not get passed");
		}
		//	console.log("action clicked button_list_accept id=" + _id_ + " type=" + type + " and  the result =" + result);
	});
	event.stopPropagation();
}

function init_tab_approve_order() {
	console.log("init_tab_approve_order response");
	$('#tab_approve_order .ifload').showLoading(true);
	if ($('#jobs_container').hasClass('hide')) {
		/* the job form is active */
		var current_order_id_from_editing = $("#form_work_approval_panel").attr("data-order-id");
		console.log("/* the job form is active */");

		$('#tab_approve_order .ifload').showLoading(false);
	} else {
		/* the job container form is active, refresh the stacks*/
		console.log("/* the job container form is active, refresh the stacks*/");
		ocdata.get_jobs_by_order_id(ocdata.db_current_cr_order.order_ref_id);
	}
}

function init_tab_briefinfo() {
	$('#Profilearea  #tab_briefinfo button.printfunction').on(interactions, function(e) {
		console.log("pressed print button here");
	});
}
