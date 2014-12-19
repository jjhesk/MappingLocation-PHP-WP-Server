var ocReload = {
	data : {
		param_id : -1,
		url : oc_obj.api_getpending_cp,
		type : ""
	},
	pending_init : function() {
		if (this.data.param_id > 0) {
			$(".view_detail_application_btn[data-id=" + ocReload.data.param_id + "]").fadeOut();
		}
		if (this.data.url == null) {
			console.log("unable to return datat");
			return false;
		}
		ocdata.get(ocReload.data.url, ocReload.pending_cb);
		console.log('renew_cp act');
		//refresh UI
	},
	pending_cb : function(returndata) {
		var notification, db, target, dispen;
		if (ocReload.data.type == "approvecp") {
			if (returndata == null) {
				db = ocdata.new_cp;
			} else {
				db = ocdata.new_cp = returndata;
			}
			$("#approve_cp .badge").html(db.total);
			notification = "There is no more pending CP request.";
			target = "#tpl_cpdetail";
			target_list = "#tpl_cplist";
			dispenView = as.hole.cpdetail;
			dispenList = as.hole.cplist;
		}
		if (ocReload.data.type == "approvecompany") {
			if (returndata == null) {
				db = ocdata.new_com;
			} else {
				db = ocdata.new_com = returndata;
			}
			$("#approve_com .badge").html(db.total);
			notification = "There is no more pending Company request.";
			target = "#tpl_comdetail";
			target_list = "#tpl_comlist";
			dispenView = as.hole.comdetail;
			dispenList = as.hole.comlist;
		}
		if (db.total > 0) {
			/*console.log('found return items, render the items accordingly');
			 console.log(db);
			 console.log(target);
			 console.log(target_list);
			 console.log(dispenView);
			 console.log(dispenList);
			 console.log('--the end--');*/
			rprocess.render_templates(db.src[0], target, dispenView);
			rprocess.render_templates(db, target_list, dispenList);
		} else {
			dispenView.html("<div class='notification_view'>" + notification + "</div>");
		}
	},
	importdata_pendingcplist : function(returndata) {
		ocdata.new_cp = returndata;
		$("#approve_cp .badge").html(returndata.total);
	},
	importdata_pendingcomlist : function(returndata) {
		ocdata.new_com = returndata;
        console.log("importdata_pendingcomlist return");
		console.log(returndata);
		$("#approve_com .badge").html(returndata.total);
	}
}
/*

 Developed and Created by Heskeyo 2013 OneCall project
 This is the OC data object that is use for managing and creation form object in the front interaction . Under this object, we have the follow static information object shown as below:

 new_cp:{},
 new_com:{},
 db_pendingorder:{},
 db_current_cr_order:{}

 the jobs that are queried from the current order id
 db_query_jobs_pool:{}

 a single saved job form data from the db_query_jobs_pool
 db_current_editing_job_form:{}

 json handlers are also written in ocdata as well.

 */
var ocdata = {
	data_channel : function(action) {
		if (action == "reject")
			return oc_obj.api_rejPending;
		if (action == "accept")
			return oc_obj.api_accPending;
	},
	action_type_channel_reponse : function(type) {
		if (type == 'approvecp')
			return oc_obj.api_getpending_cp;
		if (type == 'approvecompany')
			return oc_obj.api_getpending_com;
		console.log("uncaught error from type");
	},
	//get demo_new_cp_data
	loaded_target : 0,
	total_loading_target : 2,
	action_incoming_order : function() {
		$.getJSON(oc_obj.channel_service_order, function(db) {
			ocdata.db_pendingorder = db.result;
			console.log(db.result);
			$("#view_pending .badge").html(db.total);
		});
	},
	action_pending_procedure : function(dataid, type, action) {
		$.getJSON(ocdata.data_channel(action), {
			id : dataid,
			type : type
		}, function(data) {
			if (data.result > 0) {
				ocReload.data = new Object();
				ocReload.data.type = type;
				ocReload.data.param_id = dataid;
				ocReload.data.url = ocdata.action_type_channel_reponse(type);
				ocReload.pending_init();
			} else {
				console.log("failure from this submission");
				ocReload.data.param_id = -1;
			}
		});
	},
	get : function(api_interface_uri, callback) {
		var l = this;
		//console.log("data get new cp");
		$.getJSON(api_interface_uri, function(data) {
			callback(data);
			l.loaded_target++;
			if (l.loaded_target == l.total_loading_target) {
				console.log('done loading');
			}
		});
	},
	get_equipment_list : function(job_id) {
		/*
		 console.log("get_equipment_list");
		 console.log(oc_obj.api_gettool_set_from_list);
		 $('#tab_approve_order .ifload').showLoading(true);
		 $.getJSON(oc_obj.api_gettool_set_from_list, {
		 jobid : job_id
		 }, function(data) {
		 if (data.status == "ok") {
		 $('#tab_approve_order .ifload').showLoading(false);
		 console.log("data.result data return from the db");
		 console.log(data.result);
		 //render tool list from the database
		 rprocess.render_tools_set(data.result);
		 //apply interactions for the tool list
		 oc_JB.cb_oc_tool();
		 } else {
		 console.log("server error");
		 }
		 });*/

	},
	get_equipment_inventory_system : function(p) {
		console.log("get_equipment_inventory_system");
		$.getJSON(oc_obj.apitoolset, {
			date : p.date,
			time : p.time
		}, function(data) {
			if (data.status == "ok") {
				rprocess.render_tools_set(data.result);
				oc_JB.cb_oc_tool();
			} else {
				console.log("server error");
			}
		});
	},
	add_new_job_by_order_id : function(ord_id, callback) {
		console.log(oc_obj.api_job_new_job);
		console.log(ord_id);
		$('#tab_approve_order .ifload').showLoading(true);
		$.getJSON(oc_obj.api_job_new_job, {
			order_id : ord_id
		}, function(data) {
			if (data.status == "ok" && parseInt(data.result.id) > 0) {
				$('#tab_approve_order .ifload').showLoading(false);
				console.log("add job and assigned");
				callback(parseInt(data.result.id), parseInt(data.result.ref));
			} else {
				console.log("server error");
			}
		});
	},
	action_save_job_editing_form : function(db) {
		console.log('trigger action_save_job_editing_form');
		$('#tab_approve_order .ifload').showLoading(true);
		//console.log( typeof db.toolset);
		//console.log(db.hasOwnProperty("toolset"));
		console.log('doneif  hasOwnProperty');
		if (db.hasOwnProperty("toolset")) {
			console.log('done hasOwnProperty');
			console.log(db.toolset);
		} else {
			console.log('done !hasOwnProperty');
		}
		try {
			$.getJSON(oc_obj.api_save_job, db, function(data) {
				//console.log(data);
				console.log('done loading');
				$('#tab_approve_order .ifload').showLoading(false);
			});
		} catch(e) {
			console.log(e.message);
		}finally  {
			console.log("then this will work again");
		}
	},
	action_remove_job_approve : function(ord_id, j_id) {
		$.getJSON(oc_obj.api_remove_job_approve, {
			order_id : ord_id,
			job_id : j_id
		}, function(data) {
			if (data.status == "ok") {
				console.log("after remove the at action_remove_job_approve");
				console.log(data);
				ocdata.get_jobs_by_order_id(ocdata.db_current_cr_order.order_ref_id);
			} else {
				console.log("server error");
			}
		});
	},
	/* happens when it refreshes from the tab from init_tab_content_order  */
	get_jobs_by_order_id : function(ord_id) {
		$.getJSON(oc_obj.api_get_job_by_order, {
			order_id : ord_id
		}, function(data) {
			if (data.status == "ok") {
				if (data.result == "no associated data") {
					rprocess.cb_processing_order_close_area_empty();
				} else if (parseInt(data.result.total) == 0) {
					rprocess.cb_processing_order_close_area_empty();
				} else if (parseInt(data.result.total) > 0) {
					ocdata.db_query_jobs_pool = data.result;
					//console.log(oc_obj.api_get_job_by_order);
					//console.log(data);
					//	console.log(parseInt(data.result.total));
					rprocess.cb_processing_order_close_area(data.result);
				}
			} else {
				console.log("server error");
			}
		});
	}
}
var pdf = {
	loadClassic : function(location) {
		window.open(location, '_blank', 'fullscreen=yes');
		return false;
	},
	load : function(location) {
		var target_canvas_id = "print_doc";
		//
		// Fetch the PDF document from the URL using promises
		//
		PDFJS.getDocument(location).then(function(pdf) {
			// Using promise to fetch the page
			pdf.getPage(1).then(function(page) {
				var scale = 1.5;
				var viewport = page.getViewport(scale);
				// Prepare canvas using PDF page dimensions
				var canvas = document.getElementById(target_canvas_id);
				var context = canvas.getContext('2d');
				canvas.height = viewport.height;
				canvas.width = viewport.width;
				// Render PDF page into canvas context
				var renderContext = {
					canvasContext : context,
					viewport : viewport
				};
				page.render(renderContext);
			});
		});
	}
}
/* still working on this */
var demo_boardcast_data = [{
	jobid : 793,
	crid : 324,
	job_location : "hong kong",
	job_application_deadline : "1/23/2013",
	rate : "20%"
}, {
	jobid : 683,
	crid : 324,
	job_location : "kowloon",
	job_application_deadline : "1/23/2013",
	rate : "10%"
}];
var demo_cp_from_boardcast = {
	projectid : 322,
	jobid : 793,
	status : "boardcasted",
	sendtime : "32/23/2013 12:44",
	sendtotal : 342,
	interested : 3,
	jobstart_date : "2/23/2013",
	jobstart_time : "20:12",
	jobstart_loc : "Hong Kong Kowloon",
	job_application_deadline : "1/23/2013",
	remarks : "this is the simple one line text for now",
	applicants : [{
		cpid : 934,
		cpstatus : "notified and express interest to the job",
		cpstar_level : 3
	}, {
		cpid : 933,
		cpstatus : "not interested",
		cpstar_level : 2
	}]
};
var demo_jobpool_data = {
	view_type : "timeline",
	filter : "none",
	data : [{
		projectid : 232,
		jobid : 898,
		loc : "hong kong",
		status : "in progress",
	}, {
		projectid : 822,
		jobid : 898,
		loc : "hong kong",
		status : "pending",
	}, {
		projectid : 432,
		jobid : 898,
		loc : "hong kong",
		status : "complete",
	}]
}
var demo_order_data = [{
	crid : 342,
	service_date : "32/41/41",
	service_time : "34:11",
	submission_date : "32/22/11",
	status : "pending",
	location : "hong kong",
	clientcompany : "feeding Hong Kong Ltd",
	content_of_service : [{
		serialno : "3",
		typeorder : "full time cp",
		options : "select 3 stars CP, additional 0 hours, payment method with cash"
	}, {
		serialno : "4",
		typeorder : "full time cp",
		options : "select 6 stars CP, additional 2 hours, payment method with wired transfer"

	}, {
		serialno : "1",
		typeorder : "full time cp",
		options : "select 1 stars CP, additional 1 hours, payment method with wired transfer"
	}]
}, {
	crid : 342,
	status : "pending",
	service_date : "32/41/41",
	service_time : "34:11",
	submission_date : "32/22/11",
	location : "kowloon",
	clientcompany : "Golden Gate Hong Kong Ltd",
	content_of_service : [{
		serialno : "2",
		typeorder : "one-time on-call cp",
		options : "select 2 stars CP, additional 8 hours, payment method with wired transfer"
	}, {
		serialno : "3",
		typeorder : "full time cp",
		options : "select 4 stars CP, additional 4 hours, payment method with credit card"
		/* ,
		 options : {
		 payment : "null"
		 }*/
	}]
}];
var demo_datamodel_individual_jobrecord = {
	jobid : 342,
	projectid : 543,
	jobstart_date : "11/2/2013",
	jobstart_time : "13:43",
	assistantnames : "a b abcb onsdi n",
	jobstart_loc : "hong kong aonte oenf ionie nionefo inafef",
	status : "undergo | complete",
	total_running_time : "23hr",
	reports : 4,
	remarks : "Don't be put off by the rather long opening remarks, which are nothing to do with the main topic!",
	assistantnames : "nanmc oincion; aonsciaw ioncs; iwaofno cn ja; oine ps;",
	siteimages : [{
		url : "http://onecallapp.imusictech.net/wp-content/uploads/2013/06/temp-e1370254935115.jpg"
	}, {
		url : "http://onecallapp.imusictech.net/wp-content/uploads/2013/06/temp-e1370254935115.jpg"
	}],
	reports_archive : [{
		date : "23/32/2013",
		time : "14:22",
		template : "post2"
	}, {
		date : "1/3/2013",
		time : "11:22",
		template : "post1"
	}, {
		date : "2/3/2013",
		time : "13:12",
		template : "post2"
	}, {
		date : "3/4/2013",
		time : "15:33",
		template : "post4"
	}],
	plotdata : [{
		rx : 50,
		ry : 56,
		w : 20,
		e : 50,
		fx : 16,
		fy : 50
	}, {
		rx : 10,
		ry : 2,
		w : 31,
		e : 13,
		fx : 2,
		fy : 5
	}, {
		rx : 5,
		ry : 60,
		w : 50,
		e : 22,
		fx : 26,
		fy : 5
	}, {
		rx : 10,
		ry : 2,
		w : 31,
		e : 13,
		fx : 2,
		fy : 5
	}, {
		rx : 5,
		ry : 60,
		w : 50,
		e : 22,
		fx : 26,
		fy : 5
	}, {
		rx : 10,
		ry : 2,
		w : 31,
		e : 13,
		fx : 2,
		fy : 5
	}, {
		rx : 5,
		ry : 60,
		w : 50,
		e : 22,
		fx : 26,
		fy : 5
	}, {
		rx : 10,
		ry : 2,
		w : 31,
		e : 13,
		fx : 2,
		fy : 5
	}, {
		rx : 5,
		ry : 60,
		w : 50,
		e : 22,
		fx : 26,
		fy : 5
	}, {
		rx : 10,
		ry : 2,
		w : 31,
		e : 13,
		fx : 2,
		fy : 5
	}, {
		rx : 5,
		ry : 60,
		w : 50,
		e : 22,
		fx : 26,
		fy : 5
	}]
};
var systemjobs = [{
	start_date : "2012-11-06 10:00",
	end_date : "2012-11-06 12:10",
	text : "Task A-12458",
	section_id : 1
}, {
	start_date : "2012-11-06 10:00",
	end_date : "2012-11-06 16:00",
	text : "Task A-89411",
	section_id : 1
}, {
	start_date : "2012-11-06 10:00",
	end_date : "2012-11-06 14:00",
	text : "Task A-64168",
	section_id : 1
}, {
	start_date : "2012-11-06 16:05",
	end_date : "2012-11-06 17:00",
	text : "Task A-46598",
	section_id : 1,
	important : 1
}, {
	start_date : "2012-11-08 12:05",
	end_date : "2012-11-08 17:45",
	text : "Try creating important event here",
	section_id : 2
}, {
	start_date : "2012-11-08 05:05",
	end_date : "2012-11-08 07:45",
	text : "Task B-46G10",
	section_id : 2
}, {
	start_date : "2009-06-30 16:30",
	end_date : "2009-06-30 18:00",
	text : "Task B-46558",
	section_id : 2
}, {
	start_date : "2009-06-30 18:30",
	end_date : "2009-06-30 20:00",
	text : "Task B-45564",
	section_id : 2
}, {
	start_date : "2012-11-07 10:00",
	end_date : "2012-11-07 12:10",
	text : "Task C-12F458",
	section_id : 3
}, {
	start_date : "2012-11-07 10:00",
	end_date : "2012-11-07 16:00",
	text : "Task C-89Q411",
	section_id : 3,
	important : 1
}, {
	start_date : "2012-11-07 10:00",
	end_date : "2012-11-07 14:00",
	text : "Task C-64T168",
	section_id : 3
}, {
	start_date : "2012-11-07 16:05",
	end_date : "2012-11-07 17:00",
	text : "Task C-465P98",
	section_id : 3,
	important : 1
}];
function schedulerinit(target, datasource) {
	console.log('new class');
	scheduler.locale.labels.timeline_tab = "Timeline";
	scheduler.locale.labels.section_custom = "Section";
	scheduler.locale.labels.section_important = "Important";
	scheduler.locale.labels.new_event = "Task ";
	scheduler.config.details_on_create = true;
	scheduler.config.details_on_dblclick = true;
	scheduler.config.xml_date = "%Y-%m-%d %H:%i";

	//===============
	//Configuration
	//===============
	scheduler.templates.event_class = function(start, end, event) {
		event.color = (event.important) ? "red" : "";
		return "";
	};

	var sections = [{
		key : 1,
		label : "Current Job"
	}, {
		key : 2,
		label : "John Williams"
	}, {
		key : 3,
		label : "David Miller"
	}, {
		key : 4,
		label : "Linda Brown"
	}];

	var basicSort = function(a, b) {
		if (+a.start_date == +b.start_date) {
			return a.id > b.id ? 1 : -1;
		}
		return a.start_date > b.start_date ? 1 : -1;
	};
	var prioritySort = function(a, b) {
		// here we can define sorting logic, what event should be displayed at the top
		if (a.important && !b.important) {
			// display a before b
			return -1;
		} else {
			if (!a.important && b.important) {
				// display a after b
				return 1;
			} else {
				return basicSort(a, b);
			}
		}
	};

	// this function is not universal and should be changed depending on your timeline configuration
	var timeframeSort = function(a, b) {
		a_timeframe_start = scheduler.date.date_part(new Date(a.start_date));
		a_timeframe_end = scheduler.date.date_part(new Date(a.end_date));
		if (+a.end_date != +a_timeframe_end) {
			a_timeframe_end = scheduler.date.add(a_timeframe_end, 1, "day");
		}

		b_timeframe_start = scheduler.date.date_part(new Date(b.start_date));

		if (a_timeframe_start < b.end_date && a_timeframe_end > b.start_date && +a_timeframe_start == +b_timeframe_start) {
			return prioritySort(a, b);
		} else {
			return (a_timeframe_start < b_timeframe_start) ? -1 : 1;
		}
	};

	scheduler.createTimelineView({
		name : "timeline",
		x_unit : "day",
		x_date : "%d %F %Y",
		x_step : 1,
		x_size : 5,
		x_start : 1,
		x_length : 5,
		y_unit : sections,
		y_property : "section_id",
		render : "bar",
		round_position : true,
		sort : timeframeSort
	});
	// Working week
	scheduler.date.timeline_start = scheduler.date.week_start;
	scheduler.date.add_timeline = function(date, step, something) {
		return scheduler.date.add(date, step * 7, "day");
	};

	//===============
	//Data loading
	//===============
	scheduler.config.lightbox.sections = [{
		name : "important",
		map_to : "important",
		type : "checkbox",
		checked_value : 1,
		unchecked_value : 0
	}, {
		name : "description",
		height : 50,
		map_to : "text",
		type : "textarea",
		focus : true
	}, {
		name : "custom",
		height : 23,
		type : "select",
		options : sections,
		map_to : "section_id"
	}, {
		name : "time",
		height : 72,
		type : "time",
		map_to : "auto"
	}];
	//timeline - starting from the timeline section
	scheduler.init(target, new Date(), "timeline");
	console.log(datasource);
	function afterloaddata(j) {
		console.log("now data");
		console.log(j);
	}

	try {
		scheduler.load(datasource, "json", afterloaddata);
	} catch(e) {
	}

	/*
	 scheduler.parse([{
	 start_date : "2012-11-06 10:00",
	 end_date : "2012-11-06 12:10",
	 text : "Task A-12458",
	 section_id : 1
	 },{
	 start_date : "2012-11-06 10:00",
	 end_date : "2012-11-06 12:10",
	 text : "Task A-12458",
	 section_id : 1
	 },{
	 start_date : "2012-11-06 10:00",
	 end_date : "2012-11-06 12:10",
	 text : "Task A-12458",
	 section_id : 1
	 }], "json");
	 */
}