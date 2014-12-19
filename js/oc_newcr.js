jQuery(function($) {
	var $ = jQuery;
	$("#menu-p1").addClass("active");
	$("#gform_wrapper_8").addClass("well");
	$(".step1 .ginput_container").on("click", function() {
		//	alert("yes");
		$("#menu-p2").removeClass("active");
		$("#menu-p1").addClass("active");
	});
	$(".step2 input").on("focus", function() {
		//	alert("yes");
		$("#menu-p1").removeClass("active");
		$("#menu-p2").addClass("active");
	});
	$("#gforms_confirmation_message .nextsection")
	$(document).bind('gform_confirmation_loaded', function() {
		$("#menu-p1").removeClass("active");
		$("#menu-p2").removeClass("active");
		$("#menu-p3").addClass("active");
		//  $('#gform_1').slideUp('slow');
		//  alert("sweet");
		$("#gforms_confirmation_message").addClass("well");
		$("#gforms_confirmation_message .okay").on("click", function() {
			//  	ocform_newcr.cr_form_select_company_init();
			alert("done here");
		});
		//  $(".entry-content").append('<button class="">Add Our Company Representatives Now</button>');
		//  $('#form-success').slideDown('slow');
	});
});
