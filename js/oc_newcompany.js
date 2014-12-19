jQuery(function($) {
	var $ = jQuery;
	$("#post-180").addClass("well");
	$("#menu-p1").addClass("active");
	var input_company = $("#input_6_1");
	var company_name = "";
	input_company.keyup(function() {
		company_name = input_company.val();
	});

	$(document).bind('gform_confirmation_loaded', function(event, form_id) {
		//$('#gform_1').slideUp('slow');
		/*$("#gforms_confirmation_message .nextsection").on("click", function() {		});*/
		entry_id = $("#gforms_confirmation_message").text();
		//$(".entry-content").append('<button class="">Add Our Company Representatives Now</button>');
		//$('#form-success').slideDown('slow');
		console.log(entry_id);
		if (entry_id > 0)
			ocform_newcompany.cr_form_ini(company_name);
		//console.log(event);
	});
	//jQuery(document).bind('gform_page_loaded', function(event, form_id, current_page) {
	// code to be trigger when next/previous page is loaded
	//console.log(event);
	//});
});
var entry_id = -1;
function get_cr_list_data() {
	var list = [];
	$("#new_cr_registration .datastack.row").each(function(index) {
		var obj = {
			tmp_name : $(this).find(".input_cr_name").attr("data-field"),
			tmp_phone : $(this).find(".input_cr_phone").attr("data-field"),
			tmp_email : $(this).find(".input_cr_email").attr("data-field")
		};
		list.push(obj);
	});
	return list;
}

function ajax_submission(idata) {
	console.log(idata);
	$.post(oc_obj.api_cr_list_submission, {
		package_id : entry_id,
		packages : JSON.stringify(idata)
	}, function(e) {
		if (e) {
			console.log(e);
			ocform_newcompany.cr_form_final_ini();
		}
	}, 'json');
}

var ocform_newcompany = {
	cr_form_cr_app_count : function() {
		var total_cr = $("#new_cr_registration li").size();
		if (total_cr > 0) {
			$("#cr_registration_done").show();
			$("#cr_registration_done").show();
		} else {
			$("#cr_registration_done").hide();
		}
		$("#cr_registration_note").html("You have total " + total_cr + " CR in your company at this point.");
	},
	cr_form_final_ini : function() {
		var s = this;
		$("#menu-p2").removeClass('active');
		$("#menu-p3").addClass('active');
		$(".step2").hide();
		$(".step3").show();
		/*$("#cr_registration_notification_done").on(interactions, function() {
		 ajax_submission(get_cr_list_data());
		 return false;
		 });*/
	},
	cr_form_ini : function(input_company) {
		var s = this;
		$("#input_new_cr>h2").html(input_company);
		$("input[name='company_name']").val(input_company);
		$("#menu-p1").removeClass('active');
		$("#menu-p2").addClass('active');
		$("#cr_registration_done").hide().on("click", function() {
			ajax_submission(get_cr_list_data());
			return false;
		});
		$("#gforms_confirmation_message").remove();
		$("#input_new_cr").fadeIn(600, function() {
			console.log("newe cr is in here");
			$("#addcr").on(interactions, function() {
				var $theForm = $("#new_cr_registration").closest('form');
				var inputform = $("#input_new_cr");
				var locBox = oc.checkobject_if_empty(inputform);
				if (locBox != -1) {
					inputform.find("input").eq(locBox - 1).focus();
					return false;
				}
				if ($theForm.length > 0) {
					$.each($theForm, function(index, i) {
						if (!i.checkValidity()) {
							console.log("false on validation");
							//return false;
						}
					});
				}
				oc.appendItem("#new_cr_registration", "#crtemplate", "#input_new_cr");
				inputform.find("input:not([name='company_name'])").val("");
				s.cr_form_cr_app_count();
				$(".destroybut").on("click", function() {
					$(this).parent().parent().remove();
					s.cr_form_cr_app_count();
				});
				return false;
			});
		});

		$(".entry-content>p:first-child").remove();
	}
}
