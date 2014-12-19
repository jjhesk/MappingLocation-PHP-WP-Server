function nextMatchNaive(selector) {
	var match;
	match = this.next();
	while (match.length > 0 && !match.is(selector)) {
		match = match.next();
	}
	return match;
}

function input_field_data(objdata) {
	this.val(JSON.stringify(objdata));
}

function doc_ele_warper(number, extra_class) {
	var $ = jQuery, j = this;
	if (extra_class == null || extra_class == undefined)
		extra_class = '';
	if (j.size() > 0) {
		j.each(function(e) {
			var f = e % number;
			if (f == 0) {
				j
				//  .children()
				.slice(e, e + number).wrapAll('<div class="row use ' + extra_class + '" />');
			}
		});
	}
}

(function($) {

	//developed by hesk.. get the div id and get all the input field data and present them in an object
	$.fn.ocFormObjData = function(options) {
		var $ = jQuery;
		var selector = this;
		var inputs = selector.find(":input");
		var obj = $.map(inputs, function(n, i) {
			return {
				Key : n.name,
				Value : $(n).val()
			};
		});
		return obj;
	}
	$.fn.serializeObject = function() {
		var o = {};
		var a = this.serializeArray();
		$.each(a, function() {
			if (o[this.name]) {
				if (!o[this.name].push) {
					o[this.name] = [o[this.name]];
				}
				o[this.name].push(this.value || '');
			} else {
				o[this.name] = this.value || '';
			}
		});
		return o;
	};
})(jQuery);
var oc_template = {
	report : function() {
		var list = ['o_b89c89ed39881f6f_000.jpg', 'o_b89c89ed39881f6f_001.jpg', 'o_b89c89ed39881f6f_002.jpg', 'o_b89c89ed39881f6f_003.jpg', 'o_b89c89ed39881f6f_004.jpg', 'o_b89c89ed39881f6f_005.jpg', 'o_b89c89ed39881f6f_006.jpg', 'o_b89c89ed39881f6f_007.jpg', 'o_b89c89ed39881f6f_008.jpg', 'o_b89c89ed39881f6f_009.jpg', 'o_b89c89ed39881f6f_010.jpg', 'o_b89c89ed39881f6f_011.jpg'];
		var html = '<div class="centered container">';
		for (var i = 0; i < list.length; i++) {
			html += '<div class="row"><img src="' + oc_obj.imgbin + list[i] + '"/></div>';
		};
		html += '</div>';
		return html;
	}
}
var oc_time = {
	humandate : function(date_str) {
		var time_formats = [[60, 'just now', 1], // 60
		[120, '1 minute ago', '1 minute from now'], // 60*2
		[3600, 'minutes', 60], // 60*60, 60
		[7200, '1 hour ago', '1 hour from now'], // 60*60*2
		[86400, 'hours', 3600], // 60*60*24, 60*60
		[172800, 'yesterday', 'tomorrow'], // 60*60*24*2
		[604800, 'days', 86400], // 60*60*24*7, 60*60*24
		[1209600, 'last week', 'next week'], // 60*60*24*7*4*2
		[2419200, 'weeks', 604800], // 60*60*24*7*4, 60*60*24*7
		[4838400, 'last month', 'next month'], // 60*60*24*7*4*2
		[29030400, 'months', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
		[58060800, 'last year', 'next year'], // 60*60*24*7*4*12*2
		[2903040000, 'years', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
		[5806080000, 'last century', 'next century'], // 60*60*24*7*4*12*100*2
		[58060800000, 'centuries', 2903040000] // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
		];
		var time = ('' + date_str).replace(/-/g, "/").replace(/[TZ]/g, " ").replace(/^\s\s*/, '').replace(/\s\s*$/, '');
		if (time.substr(time.length - 4, 1) == ".")
			time = time.substr(0, time.length - 4);
		var seconds = (new Date - new Date(time)) / 1000;
		var token = 'ago', list_choice = 1;
		if (seconds < 0) {
			seconds = Math.abs(seconds);
			token = 'from now';
			list_choice = 2;
		}
		var i = 0, format;
		while ( format = time_formats[i++])
		if (seconds < format[0]) {
			if ( typeof format[2] == 'string')
				return format[list_choice];
			else
				return Math.floor(seconds / format[2]) + ' ' + format[1] + ' ' + token;
		}
		return time;
	},
	date : function() {
		/*
		Dates in javascript are numeric values of milliseconds since January 1, 1970. Facebook dates (at least creation_time and update_time in the stream table) are in seconds since January 1, 1970 so you need to multiply by 1000. Here is some code doing it for a post on my wall earlier today:
		*/
		// Takes an ISO time and returns a string representing how
		// long ago the date represents.
	},
	oneDate : function(t, logincheck) {
		if (t == undefined) {
			//alert("t is undefined");
			return false;
		}
		if (logincheck == undefined) {
			logincheck = false;
		}
		if (t.trim == '0000-00-00 00:00:00' || oc_time.humandate(t).indexOf('just now') != -1 && logincheck) {
			return "First Time Log In";
		} else {
			var k = t.replaceAt(10, "T") + "Z";
			return oc_time.humandate(k);
		}
	},
	e : function(selector) {
		//humandate("2008-01-28T20:24:17Z"); // =      > "2 hours ago
		// If jQuery is included in the page, adds a jQuery plugin to handle it as well
		// under timetag
		var val = this.attr('since');
		if (selector == null)
			alert("doesnt work.. ");
		else
			this.children(selector).html(oc_time.oneDate(val));
	},
	convertinline : function(before) {
		var val = this.html();
		if (before != undefined)
			this.html(before + " " + oc_time.oneDate(val));
		else
			this.html(oc_time.oneDate(val));
	}
}
var interactions = "click";
var oc = {
	remove_child_el : function(parent_obj, key) {
		//for (var key in parent_obj) {
		if (parent_obj.hasOwnProperty(key)) {
			delete parent_obj[key];
		}
		//}
	},
	interaction_initialization : function() {
		/* change the configuration when the user start touching the device */
		var hasTouch = false;
		window.addEventListener('touchstart', function() {
			if (!hasTouch) {
				hasTouch = true;
				interactions = 'touchstart';
			}
		}, false);
	},
	findWherePlugin : function(key, val) {
		var bob = null, collection = this;
		for (var i in collection) {
			var item = collection[i];
			if (item[key] == val) {
				return bob = collection[i];
			}
		}
		return bob;
	},
	remove_from_collection : function(id, collection, property) {
		if (id == 0) {
			console.log("id is not defined");
			return;
		}
		if (!collection.hasOwnProperty(property)) {
			console.log("nothing to remove");
			return;
		} else {
			var st = collection[property];
			var arr = st.fulltrim().split(",");
			var index = arr.indexOf(id);
			arr.splice(index, 1);
			st = arr.join(",");
			collection[property] = st;
			return;
		}
	},
	add_to_collection : function(id, collection, property) {
		if (id == 0) {
			console.log("id is not defined");
			return;
		}
		if (!collection.hasOwnProperty(property)) {
			collection[property] = id;
			return;
		} else {
			var st = collection[property];
			var arr = st.fulltrim().split(",");
			arr.push(id);
			st = arr.join(",");
			collection[property] = st;
			return;
		}
		/*

		 if (!ocdata.db_current_editing_job_form.hasOwnProperty("toolset")) {
		 ocdata.db_current_editing_job_form.toolset = tool_id;
		 } else {
		 var st = ocdata.db_current_editing_job_form.toolset;
		 var arr = st.split(",");
		 arr.push(tool_id);
		 st = arr.join(",");
		 ocdata.db_current_editing_job_form.toolset = st;
		 }

		 */
	},
	findWhere : function(collection, key, val) {
		//	console.log("get value == ");
		//	console.log(val);
		//	console.log(key);
		//	console.log(collection);
		//console.log("set value == ");
		var bob = null;
		for (var i in collection) {
			var item = collection[i];
			//..console.log(item[key]);
			if (item[key] == val) {
				return bob = collection[i];
			}
		}
		return bob;
	},
	loadframe : function(switch_) {
		/* this is the loading div for the loading animation */
		var hassomthing = $(this).html().trim();
		if ( typeof switch_ == "boolean") {
			if (switch_) {
				if (hassomthing == "") {
					$(this).html('<div class="loader run"><img src="' + oc_obj.application_loader + '"/></div>');
				} else {
					$(this).find('.loader').addClass('run');
				}
				//	console.log(oc_obj.application_loader);
			} else {
				$(this).find('.loader').removeClass('run');
			}
		}

	},
	checkobject_if_empty : function(target_id) {
		var data = target_id.serializeObject();
		var c = 0;
		//		console.log(data);
		for (var i in data) {
			c++;
			if (data[i] == "") {
				return c;
			}
		}
		console.log(c);
		return -1;
	},
	appendItem : function(target_id, template_id, form_source_id) {
		var $ = jQuery;
		//console.log("fired append item");
		var view = $(form_source_id).serializeObject();
		var template = $(template_id).html();
		var output = Mustache.render(template, view);
		$(target_id).append(output);
	},
	get_item_no : function($target) {
		return content = parseInt($target.closest(".tcontent").children().eq(0).text().trim());
	},
	get_checked_item_content : function($target) {
		//console.log($target);
		if ($target[0].checked) {
			var content = $target.parent().text().fulltrim();
			return content;
		} else
			return false;
	},
	autoDisableFields : function() {
		var $ = jQuery;
		$(".gfield").each(function() {
			if ($(this).hasClass("disabled")) {
				console.log("disabled");
				$(this).find("input, textarea, select, button").prop('disabled', true);
			} else {
				console.log("na disabled");
			}
		})
	},
	menu_ini : function() {
		var $ = jQuery, temp, menu_item = $('.menu_control li');
		menu_item.on('mouseover touch', function() {
			temp = $(this).parent().children('.current')
			temp.removeClass('current');
			$(this).addClass('current');
		});
		menu_item.on('mouseout', function() {
			$(this).removeClass('current');
			temp.addClass('current');
		});
	},
	addjob_format_form : function() {
		var $ = jQuery;
		// alert("sweet");
		//jQuery("#gform_1").find("gfield six columns").groupwrap(2, 'row_2');
		$(document).bind('gform_confirmation_loaded', function() {
			//$('#gform_1').slideUp('slow');
			//alert("sweet");
			//$('#form-success').slideDown('slow');
		});
		$(document).bind('gform_page_loaded', function(event, form_id, current_page) {
			//$('#gform_1').slideUp('slow');
			//alert("sweet");
			//$('#form-success').slideDown('slow');
		});
		$(document).bind('gformInitDatepicker', function() {
			gformInitDatepicker();
			alert("sweet");
		});
		$(document).bind('gform_post_render', function(event, form_id, current_page) {
			oc.autoDisableFields();
			console.log('page:' + current_page);
			if ($('#the_draw_board').size() > 0 && current_page == 4) {
				//  $('#the_draw_board').insertBefore(jQuery('#gform_submit_button_1'));
				$('#field_1_41').prepend($('#the_draw_board'));
				$('#field_4_41').prepend($('#the_draw_board'));
				implementation_canvas_draw();
			}
			if ($('#gform_page_1_6 .gform_page_fields').size() > 0 && current_page == 6) {
				$('#gform_page_1_6 .gform_page_fields').append(oc_template.report());
			}
			if ($('#field_4_51').size() > 0 && current_page == 6) {
				$(oc_template.report()).insertAfter("#field_4_51");
			}
		});
	}
}
var string_process = {
	trim : function() {
		return this.replace(/^\s+|\s+$/g, '');
	},
	ltrim : function() {
		return this.replace(/^\s+/, '');
	},
	rtrim : function() {
		return this.replace(/\s+$/, '');
	},
	fulltrim : function() {
		return this.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g, '').replace(/\s+/g, ' ');
	},
	htmlEntities : function() {
		return this.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
	},
	replace_at : function(index, char) {
		return this.substr(0, index) + char + this.substr(index + char.length);
	}
}
var controlpicker = {
	invalid : {
		daysOfWeek : [0, 6],
		daysOfMonth : ['5/1', '12/24', '12/25']
	},
	theme : 'ios',
	display : 'bottom',
	mode : 'scroller'
}
var custom_uploader;
var conponent_init = {
	sUploader : function() {
		$('#upload_image_button').on(interactions, function(e) {
			e.preventDefault();
			//If the uploader object has already been created, reopen the dialog
			if (custom_uploader) {
				custom_uploader.open();
				return;
			}
			//Extend the wp.media object
			custom_uploader = wp.media.frames.file_frame = wp.media({
				title : 'Upload the Images for the Record Plan',
				button : {
					text : 'OK'
				},
				multiple : false
			});
			//When a file is selected, grab the URL and set it as the text field's value
			custom_uploader.on('select', function() {
				attachment = custom_uploader.state().get('selection').first().toJSON();
				console.log(attachment);
				$('#upload_image').val(attachment.url);
			});
			//Open the uploader dialog
			custom_uploader.open();
		});
	},
	mUploader : function() {
		$('#upload_image_button').on(interactions, function(e) {
			e.preventDefault();
			//If the uploader object has already been created, reopen the dialog
			if (custom_uploader) {
				custom_uploader.open();
				return;
			}
			//Extend the wp.media object
			custom_uploader = wp.media.frames.file_frame = wp.media({
				title : 'Upload the Images for the Record Plan',
				button : {
					text : 'OK'
				},
				multiple : true
			});
			//When a file is selected, grab the URL and set it as the text field's value
			custom_uploader.on('select', function() {
				var selection = custom_uploader.state().get('selection');
				$("#appendimages_record_plan").html("");
				selection.map(function(attachment) {
					attachment = attachment.toJSON();
					console.log(attachment);
					rprocess.render_selected_pictures(attachment);
					//	$('#upload_image').val(attachment.url);
					// Do something with attachment.id and/or attachment.url here
				});
			});
			//Open the uploader dialog
			custom_uploader.open();
		});
	},
	timepickers : function() {
		var date_pick = $(".datepicker_el");
		var time_pick = $(".timepicker_el");
		//	console.log("init date_pick");
		//date_pick.datepicker('destroy');
		if (date_pick.hasClass('hasDatepicker')) {
			date_pick.removeClass('hasDatepicker')
		}
		if (time_pick.hasClass('hasPtTimeSelect')) {
			time_pick.removeClass('hasPtTimeSelect')
		}
		date_pick.datepicker({
			showAnim : "fadeIn",
			defaultDate : "+1w",
			changeMonth : true,
			numberOfMonths : 3,
			onClose : function(selectedDate) {
				$("#to").datepicker("option", "minDate", selectedDate);
				ocdata.db_current_editing_job_form.dateset = selectedDate;
			}
		});
		time_pick.ptTimeSelect({
			showAnim : "fadeIn",
			containerClass : undefined,
			containerWidth : undefined,
			hoursLabel : 'Hour',
			minutesLabel : 'Minutes',
			setButtonLabel : 'Set Time',
			popupImage : undefined,
			onFocusDisplay : true,
			zIndex : 10,
			onBeforeShow : undefined,
			onClose : function(selectedDate) {
				ocdata.db_current_editing_job_form.timeset = $(selectedDate).val();
			}
		});
		$("#ui-datepicker-div").removeClass(".ui-corner-all");
	}
}
Array.prototype.findOut = oc.findWherePlugin;
String.prototype.trim = string_process.trim;
String.prototype.ltrim = string_process.ltrim;
String.prototype.rtrim = string_process.rtrim;
String.prototype.fulltrim = string_process.fulltrim;
String.prototype.htmlEntities = string_process.htmlEntities;
String.prototype.replaceAt = string_process.replace_at;
Handlebars.registerHelper('link', function(text, url) {
	text = Handlebars.Utils.escapeExpression(text);
	url = Handlebars.Utils.escapeExpression(url);
	var result = '<a href="' + url + '">' + text + '</a>';
	return new Handlebars.SafeString(result);
});
jQuery.fn.showLoading = oc.loadframe;
// Implementation for "naive next loop" function
jQuery.fn.groupwrap = doc_ele_warper;
jQuery.fn.nextMatchNaive = nextMatchNaive;
jQuery.fn.input_save_data = input_field_data;
jQuery.fn.reformat_gform = oc.format_form;
//time plugins
jQuery.fn.time_convert_inline = oc_time.convertinline;
jQuery.fn.time_convert_children = oc_time.e;
//
var transition_time_span = 500;

jQuery(function($) {
	oc.menu_ini();
	oc.interaction_initialization();
});
