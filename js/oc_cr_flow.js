var oc_content_table;
var oc_cr_view = {

	orderform : function() {
		var $ = jQuery, ooc = this, form = $("#orderform");
		$("#orderform #gform_wrapper_9,#viewgrid").addClass("well");
		$("#newrecord").on("touch touchend touchstart click", function() {
			if (form.hasClass("hide")) {
				ooc.history_view_close();
				//	form.find()
				//console.log("slide down");
				form.slideDown(500, function() {
					ooc.form_lock = "order";
				});
			}
		});
		var buttonsgroup = '<div class="btn-group"><button class="btn btn-large hide prev_step_btn">&#8249; Prev</button><button class="btn next_step_btn btn-large">Next &#8250;</button><button class="hide btn btn-large placeorder">Place the Order</button><button class="hide btn btn-large review_order">Preview order</button></div>';
		var submit_button = $("#gform_submit_button_9").hide();
		$(".gform_footer.top_label").append(buttonsgroup);
		$(".gform_heading p").append(buttonsgroup);
		//----------------------------------------------
		var review_order_btn = $(".review_order");
		var next_step_btn = $(".next_step_btn");
		var placeorder_btn = $(".placeorder");
		var prev_step_btn = $(".prev_step_btn");

		$(".gform_body").append($("#table_of_service").clone());
		var table_of_service = $(".gform_body #table_of_service");
		var method1_select = table_of_service.find("#method1_select");
		var method2_select = table_of_service.find("#method2_select");

		var gform_9 = $("#gform_fields_9");
		var review_order_table = $("#review_of_order");
		var table_of_service = oc_content_table = $(".gform_body #table_of_service");
		var servicetable_obj = {};
		var all_input_fields_not_checkboxs = $("input[type=checkbox], #input_3_number, #method1_select, #input_4_number, #method2_select");
		next_step_btn.on(interactions, function() {
			if (!next_step_btn.hasClass('hide')) {
				gform_9.slideUp();
				table_of_service.removeClass("hide").slideDown();
				next_step_btn.addClass('hide');
				prev_step_btn.removeClass('hide');
			}
			return false;
		});

		prev_step_btn.on(interactions, function() {
			if (!prev_step_btn.hasClass('hide')) {
				prev_step_btn.addClass('hide');
				next_step_btn.removeClass('hide');
				table_of_service.slideUp();
				gform_9.slideDown();
				placeorder_btn.addClass('hide');
				oc_cr_view.collapse_preview_order(false);
			}
			return false;
		});

		review_order_btn.on(interactions, function() {
			console.log("trigger review order");
			table_of_service.slideUp();
			gform_9.slideUp();
			//review_order_table.removeClass('hide').slideDown();
			placeorder_btn.removeClass('hide');
			review_order_btn.addClass('hide');
			oc_cr_view.review_order_content();
			oc_cr_view.confirm_review_orders();
			//$("#review_of_order").removeClass('hide').slideDown();
			//console.log($("#input_9_4").val());
			return false;
		});
		/*
		$("#check_input_data").on(interactions, function(e) {
		$("#table_of_service").find(".tcontent").each(function(index, el) {
		console.log(el);
		});
		});
		*/
		//initialize the table of service

		table_of_service.find("tr.tcontent").on(interactions, function(e) {
			var self = $(this);
			var checkbox = self.find("label.checkbox.column1 input");
			if (checkbox.is(':checked')) {
				oc_cr_view.check_number_item(self, false);
			} else {
				oc_cr_view.check_number_item(self, true);
				enable_submit();
			}
			oc_cr_view.review_order_content();
		});

		all_input_fields_not_checkboxs.on(interactions, function(e) {
			e.stopPropagation();
		});

		table_of_service.find("label.checkbox.column1 input").on("change", function(e) {
			var self = $(this);
			if (self.is(':checked')) {
				enable_submit();
				oc_cr_view.check_number_item(self.closest("tr.tcontent"), true);
			} else {
				oc_cr_view.check_number_item(self.closest("tr.tcontent"), false);
			}
			return false;
		});

		//tpl_review_order
		function enable_submit() {
			var A = table_of_service.find("label.checkbox.column1 input:checked").size() > 0;
			var B = oc.checkobject_if_empty(gform_9.closest("form")) == -1;
			//	console.log(B);
			//	console.log(A);
			//if (A && B) {
			if (A) {
				//submit_button.show();
				review_order_btn.removeClass("hide");
			} else {
				review_order_btn.addClass("hide");
				//submit_button.hide();
			}
		}


		method1_select.on("change", function() {
			var self = $(this), valmethod = "";
			valmethod = self.find("option:selected").text();
			table_of_service.find("#method1").html(valmethod);
		});

		method2_select.on("change", function() {
			var self = $(this), valmethod = "";
			valmethod = self.find("option:selected").text();
			table_of_service.find("#method2").html(valmethod);
		});

		$(document).bind('gform_confirmation_loaded', function() {
			//$('#gform_1').slideUp('slow');

			/*

			$("#gforms_confirmation_message").addClass("well");
			$("#gforms_confirmation_message .nextsection").on("click", function() {

			});*/
			//ocform_newcompany.cr_form_ini(company_name);
			//$(".entry-content").append('<button class="">Add Our Company Representatives Now</button>');
			//$('#form-success').slideDown('slow');
		});
		var check_box_col2 = $(".tcontent .column2 input[type=checkbox]");
		check_box_col2.on('change', oc_cr_view.check_numer_item_content);
	},
	collapse_preview_order : function(isVisible) {
		var base = $("#gform_9 .gform_body"), confirm_order, self = this;
		if (base.find("#confirm_order").length == 1) {
			confirm_order = base.find("#confirm_order");
			if (isVisible)
				confirm_order.slideDown();
			else
				confirm_order.slideUp();
		}

	},
	confirm_review_orders : function() {
		var base = $("#gform_9 .gform_body"), confirm_order, self = this;
		//self.order_content
		//tempid
		if (base.find("#confirm_order").length == 0) {
			base.append('<article id="confirm_order"></article>');
		}
		confirm_order = base.find("#confirm_order");
		var d_template_html = $("#review_of_order").html();
		var template = Handlebars.compile(d_template_html);
		console.log("template compiling passed");
		var output = template(self.order_content);
		confirm_order.html(output);
		
		oc_cr_view.collapse_preview_order(true);
		//	var output = Mustache.render($("#tpl_review_order").html(), view);
		//	$("#rez_area").append(output);
	},
	review_order_content : function() {
		var self = this;
		var column1 = oc_content_table.find(".checkbox.column1 input:checked");
		self.order_content = [];
		$.each(column1, function(index, i) {
			var view = {
				item : 0,
				type : "",
				content : {}
			};
			//view.content = "";
			//TODO: continue from here 7/9/2013
			//view.content
			var selected_item = oc.get_item_no($(i));

			if (selected_item == 3) {
				view.content['number_hours'] = oc_content_table.find("#input_3_number_hours").val();
				view.content['method'] = oc_content_table.find("#method1_select").val();
				view.content['list'] = self.check_add_item_content(selected_item);
				//console.log("additional");
			} else if (selected_item == 4) {
				view.content['method'] = oc_content_table.find("#method2_select").val();
				view.content['number_hours'] = oc_content_table.find("input#input_4_number").val();
			} else {
				view.content['list'] = self.check_add_item_content(selected_item);
			}
			view.item = selected_item;
			view.type = oc.get_checked_item_content($(i));
			self.order_content.push(view);
		});
		$("#input_9_4").val(JSON.stringify(self.order_content));
		//console.log(self.order_content);
		return true;
	},

	check_add_item_content : function(index) {
		//		console.log(index);
		var list_check_box = oc_content_table.find(".tcontent").eq(index - 1).find(".column2 input[type=checkbox]:checked");
		//		console.log(list_check_box);
		var list = [];
		list_check_box.each(function(check_index, item) {
			var label = oc_content_table.find(".tcontent").eq(index - 1).find(".column2 label.checkbox").eq(check_index).text().trim();
			list.push(label);
		});
		//	console.log(list);
		return list;
	},
	check_numer_item_content : function(e) {
		//this happens when the checkboxs were changed from the column2
		var ss = $(this);
		var label = ss.closest(".checkbox").text().trim();
		var row = ss.closest(".tcontent");
		//var item_number = parseInt(ss.closest(".tcontent").find("td:first-child").text().trim());
		var find = _.findWhere(oc_cr_view.order_content, {
			item : parseInt(row.find("td:first-child").text().trim())
		});
		if (find == null) {// this is not found form the object
			oc_cr_view.check_number_item(row, true);
		}
		oc_cr_view.review_order_content()
	},
	check_number_item : function(el, isOn) {
		if ( typeof isOn === 'boolean') {
			var self = el;
			var selected = self.hasClass("success");
			var checkbox = self.find("label.checkbox.column1 input");
			if (isOn) {
				checkbox.attr('checked', true);
				self.addClass("success");
			} else {
				checkbox.attr('checked', false);
				self.removeClass("success");
			}
		} else {
			console.log("error boolean expected");
		}
	},
	order_content : [],
	form_lock : "",
	orderform_close : function() {
		var $ = jQuery, ooc = this, form = $("#orderform");
		if (ooc.form_lock == "order") {
			form.slideUp();
		}
	},
	history_view_close : function() {
		var $ = jQuery, ooc = this, grid = $("#viewgrid");
		if (ooc.form_lock == "grid") {
			grid.slideUp();
		}
	},
	history_view : function() {
		var $ = jQuery, ooc = this, grid = $("#viewgrid");
		$("#viewprojects").on("touch touchend touchstart click", function() {
			ooc.orderform_close();
			if (grid.hasClass("hide")) {
				//	form.find()
				//console.log("slide down");
				grid.slideDown(500, function() {
					ooc.form_lock = "grid";
				});
			}
		});
	}
}
jQuery(function($) {
	oc_cr_view.orderform();
	oc_cr_view.history_view();
});
