var pH = {
	map : {},
	plotmap : {},
	linkmap : {},
	interactive : {},
	Init : function() {
		//============================
		plotModel.testCount = 0;
		var array = [];
		plotModel.data = array;
		//============================
		pH.canvas_circles = paper.project.activeLayer;
		pH.map = new paper.Layer();
		pH.canvas_circles.activate();
		pH.plotmap = new paper.Layer();
		pH.linkmap = new paper.Layer();
		pH.interactive = new paper.Layer();
		pH.addmap();
		//console.log(paper.project.activeLayer);
		var layer = paper.project.activeLayer;
	},
	addPair_c : function(point1, point2, r1, r2) {
		var a1 = shapes.circle(point1, r1);
		var a2 = this.addMarker(true, point1);
		var a3 = shapes.circle(point2, r2);
		var a4 = this.addMarker(true, point2);
		plotModel.findDelta(point1, point2, r1, r2)
	},
	label : function(string, point) {
		var text = new paper.PointText(point);
		text.justification = 'center';
		text.fillColor = 'black';
		text.content = string;
		text.fontSize = 25;
	},
	addMarker : function(showLabel, position) {
		var m = shapes.circle_marker();
		var marker = m.clone();
		// Set the stroke color of all items in the group:

		// Move the group to the center of the view:
		marker.position = position;
		//var m = new paper.Symbol(marker);
		//marker.add(event.position);
		if (showLabel) {
			this.label("T" + plotModel.testCount, position);
		}
		return marker;
	},
	addCross : function(position, letter) {
		var marker = shapes.circle_marker();
		marker.position = position;
		marker.strokeColor = 'black';
		marker.name = letter;
		this.label(letter, position);
		marker.onMouseDrag = function(event) {
			this.position = event.point;
			if (this.name == "A") {
				input_data.point_a = event.point;
			} else if (this.name == "B") {
				input_data.point_b = event.point;
			}
			pH.restart();
			pH.draw_from_input_data(input_data);
		}
	},
	initLink : function() {
		this.linkmap.activate();
		// this.path={};
		var g = new paper.Path({
			strokeColor : 'black',
			fullySelected : false,
		});
		console.log(g);
		this.path = g;
		this.canvas_circles.activate();
	},
	linkToOBJ : function(obj) {
		//this.linkmap.activate();
		this.linkmap.activate();
		var point = obj.position;
		var g = this.path;
		plotModel.path_point_collection.push({
			name : obj.name,
			point : obj.position
		});
		if (!_.isEmpty(g)) {
			g.add(point);
			console.log("add path");
			this.path = g;
		}
		if (this.redraw || _.isEmpty(g)) {
			console.log("create new path");
			var iniLink = new paper.Path({
				strokeColor : 'black',
				fullySelected : false,
				strokeWidth : 4,
				smooth : true
			});
			iniLink.add(point);
			this.path = iniLink;
			this.redraw = false;
		}
		//this.path.closed = true;
		this.canvas_circles.activate();
		//this.canvas_circles.activate();
	},
	isAdding : function(selected_name) {
		var collection = plotModel.path_point_collection;
		var m = _.where(collection, {
			"name" : selected_name
		});
		//TODO: fix this part
		if (m.length == 0 && collection.length == 0)
			return 1;
		else if (m.length == 1 && collection.length == 1)
			return 2;
		else if (m.length > 0 && collection.length > 0)
			return 0;
		else
			return 1;
	},
	selectpoint : function(point) {
		var hitOptions = {
			stroke : false,
			fill : true,
			tolerance : 5
		};
		var selectedcircle = shapes.circle_sh(point, plotModel.testCount);
		selectedcircle.name = "T" + plotModel.testCount;
		selectedcircle.dashArray = [10, 4];
		var self = this;
		self.selectedname = "";
		selectedcircle.selected = false;
		selectedcircle.onMouseDown = function(event) {
			//TODO: fix this part
			var pointer = self.isAdding(this.name);
			console.log(pointer);
			if (pointer == 1) {
				self.selectedname = this.name;
				this.selected = true;
				self.linkToOBJ(this);
				$("#fixed_display_information").html("selected" + this.name);
			} else if (pointer == 2) {
				plotModel.path_point_collection = [];
				this.selected = false;
				self.linkmap.activate();
				self.path.removeSegment(0);
				self.canvas_circles.activate();
			}
		}
		selectedcircle.onMouseUp = function(event) {
			if (event.item) {
				// event.item.scale(1.1);
				//TODO: fix this part
			}
		}
		selectedcircle.onFrame = interactive_pack.rotate;
		this.selectpoint_label(point);
		return selectedcircle;
	},
	selectpoint_label : function(point) {
		this.label("p " + plotModel.testCount, point);
	},
	ctoggle : function(target) {
		if (target == "points") {
			pH.plotmap.visible = !pH.plotmap.visible;
		} else if (target == "interaction") {
			pH.interactive.visible = !pH.interactive.visible;
		} else if (target == "base") {
			pH.canvas_circles.visible = !pH.canvas_circles.visible;
		} else if (target == "link")
			pH.linkmap.visible = !pH.linkmap.visible;
	},
	clean : function(target) {
		if (target == "points") {
			pH.plotmap.activate();
		} else if (target == "interaction") {
			pH.interactive.activate();
		} else if (target == "base") {
			pH.canvas_circles.activate();
		} else if (target == "link") {
			pH.linkmap.activate();
			plotModel.path_point_collection = [];
			pH.redraw = true;

		}
		if (paper.project.activeLayer.hasChildren()) {
			paper.project.activeLayer.removeChildren();
		}
		if (target == "base") {
			plotModel.data = [];
			plotModel.testCount = 0;
		}
		pH.canvas_circles.activate();
	},
	toggle : function() {

	},
	alert : function(string) {
		pH.interactive.activate();
		var text = new paper.PointText(new paper.Point(20, 20));
		text.justification = 'left';
		text.fillColor = 'black';
		text.content = string;
		text.fontSize = 25;
		setTimeout(function() {
			pH.clean("interaction");
		}, 2000);
		pH.canvas_circles.activate();
	},
	addmap : function() {
		this.map.visible = true;
		this.map.activate();
		//	var raster = new Raster('dump_images/temp.jpg');
		var raster = new paper.Raster(oc_obj.layer_image);
		raster.opacity = 0.8;
		var loaded = false;
		raster.onLoad = function() {
			loaded = true;
			raster.onStart();
		}
		raster.onStart = function() {
			if (!loaded)
				return;
			//raster.fitBounds(paper.view.bounds, true);
			raster.fitBounds(raster.bounds, true);

			console.log(raster);
			console.log(raster.bounds);
			//raster.scale(3.2);
			raster.translate(new Point(0, 500));
			//project.activeLayer.removeChildren();
		}
		//console.log(this.map);
		//this.map[0].transform(new Point(0,-2000));
		pH.canvas_circles.activate();
	},
	plotmap_view : false,
	draw_from_input_data : function(input_data) {
		plotModel.testCount = 0;
		this.plotmap.activate();
		this.addCross(new paper.Point(input_data.point_a), "A");
		this.addCross(new paper.Point(input_data.point_b), "B");
		this.canvas_circles.activate();
		_.each(input_data.testing_length, paperinvocation_from_testing_list);
	},
	restart : function() {
		pH.clean("interaction");
		pH.clean("points");
		pH.clean("base");
		pH.clean("link");
	}
}
var plotting_map = {
	canvas_switch_grid : function() {
		//this.grid_status = "";
		if (this.grid_status == "pro") {
			$("#grid").addClass("normal_active");
			$("#grid").removeClass("pro_active");
			this.grid_status = "normal";
			return true;
		}
		if (this.grid_status == "normal") {
			$("#grid").addClass("pro_active");
			$("#grid").removeClass("normal_active");
			this.grid_status = "pro";
			return true;
		}
		if (!this.hasOwnProperty("grid_status")) {
			$("#grid").addClass("normal_active");
			$("#grid").removeClass("pro_active");
			this.grid_status = "normal";
		}
	},
	showgrid : function() {
		var template = Handlebars.compile($("#tpl_inputdata").html());
		console.log(input_data);
		var output = template(input_data);
		$("#brewcontent_grid").html(output);
	},
	ini : function() {
		var self = this;
		if ( typeof (paper) == "undefined") {
			alert("paper library is required");
		}
		//.html("Add Test Demo");
		//http://jsfiddle.net/alnitak/xN45K/
		var ctx = document.querySelector('canvas').getContext('2d');
		// var ctx = $("#plotmap").getContext('2d');
		ctx.canvas.width = 800;
		ctx.canvas.height = 1280;
		// $("#grid,#layer1").width(600).height(600);
		self.ctx = ctx;
		self.text_color = "#000";
		self.circle_color = "#d00";
		self.test_row = 0;
		// Get a reference to the canvas object
		//var canvas = document.getElementById('plotmap');
		// Create an empty project and a view for the canvas:
		paper.install(window);
		paper.setup('plotmap');
		pH.Init();

		$("#plot_grid").on(interactions, function(e) {
			//	self.canvas_switch_grid();
			self.showgrid();
		});
		//.html("switch Grid");
		$("#plot_0").on(interactions, function(e) {
			pH.ctoggle("base");
		});
		$("#plot_3").on(interactions, function(e) {
			pH.ctoggle("points");
		});
		$("#plot_4").on(interactions, function(e) {
			pH.ctoggle("link");
		});
		$("#p-move").on(interactions, function(e) {
			interactive_pack.move();
			return false;
		});
		$("#plot_1").on(interactions, function(e) {
			var rn_x1 = Math.random() * 800 + 100;
			var rn_x2 = Math.random() * 800 + 100;
			var rn_y1 = Math.random() * 400 + 100;
			var rn_y2 = Math.random() * 800 + 100;
			var rn_n1radius = Math.random() * 100 + 100;
			var rn_n2radius = Math.random() * 100 + 100;
			var test_point1 = new paper.Point(rn_x1, rn_y1);
			var test_point2 = new paper.Point(rn_x2, rn_y2);
			pH.addPair_c(test_point1, test_point2, rn_n1radius, rn_n2radius);
			var test = {
				p1 : test_point1,
				p2 : test_point2,
				r1 : rn_n1radius,
				p2 : rn_n2radius
			}

			plotModel.data.push(test);
			plotModel.updateCount();
		});
		$("#startover").on(interactions, function(e) {
			pH.clean("interaction");
			pH.clean("points");
			pH.clean("base");
			pH.clean("link");
		});
		$("#plot_2,#render_routes").on(interactions, function(e) {
			pH.clean("interaction");
			pH.clean("points");
			pH.clean("base");
			pH.draw_from_input_data(input_data);
		});
		$('#myModal').on('show', function(e) {
			$("#removerow").on(interactions, function(event) {
				$(".datarow .col1 input:checked").each(function(index) {
					var d_ref = $(this).parent().find(".refpoint").html();
					_.each(input_data.testing_length, function(a, b, c) {
						if (a.ref == d_ref) {
							_.reject(input_data.testing_length, function(num) {
								return num == b;
							});
						}
					});
				});
			});
			$(".datarow .col1 input").change(function(event) {
				var tr = $(this).parent().parent();
				if ($(this).attr("checked")) {
					tr.addClass("selected");
					//	console.log("log one");
					return;
				} else {
					tr.removeClass("selected");
					//	console.log("log one");
					return;
				}
			});
		});
	}
}
