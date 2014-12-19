var interactive_pack = {
	rotate : function(event) {
		var s = this;
		if (s.selected) {
			s.rotate(1);
		}
	},
	smaller : function() {
		pH.map.scale(0.5);
	},
	move_active : false,
	move_active_cur : false,
	offset_map : {
		x : 0,
		y : 0
	},
	move : function() {
		this.move_active = !this.move_active;
		if (this.move_active) {
			console.log("ON move actived");
			pH.map.activate();
			//	var layer = paper.project.activeLayer;
			pH.map.onMouseDown = function(event) {
				interactive_pack.move_active_cur = true;
				//alert("this is on now");
			}
			pH.map.onMouseMove = function(event) {
				if (interactive_pack.move_active_cur) {
					console.log(event);

					pH.map.position.x = event.delta.x + pH.map.position.x;
					pH.map.position.y = event.delta.y + pH.map.position.y;
					pH.plotmap.position.x = event.delta.x + pH.plotmap.position.x;
					pH.plotmap.position.y = event.delta.y + pH.plotmap.position.y;
					pH.canvas_circles.position.x = event.delta.x + pH.canvas_circles.position.x;
					pH.canvas_circles.position.y = event.delta.y + pH.canvas_circles.position.y;
					
					input_data.point_a.x = input_data.point_a.x + event.delta.x;
					input_data.point_a.y = input_data.point_a.y + event.delta.y;

					input_data.point_b.x = event.delta.x + input_data.point_b.x;
					input_data.point_b.y = event.delta.y + input_data.point_b.y;
					//	pH.map.position =  new Point(event.delta);
					//pH.map.position += interactive_pack.offset_map;
					//			pH.map.translate(event.event);
				} else {
					//console.log(event.point);
				}
			}
			pH.map.onMouseUp = function(event) {
				if (interactive_pack.move_active_cur) {
					//	pH.map.position = new Point(event.point);

					// event.item.scale(1.1);
					//TODO: fix this part
					interactive_pack.move_active_cur = false;
				}
			}
			pH.map.translate();
		} else {
			pH.map.onMouseMove = pH.map.onMouseUp = pH.map.onMouseDown = null;
			pH.canvas_circles.activate();
		}
	}
}

var paperinvocation_from_testing_list = function(item, i, whole) {
	/*console.log(item);
	 console.log(i);*/
	var p1 = new paper.Point(input_data.point_a);
	var p2 = new paper.Point(input_data.point_b);
	var r1 = item.a;
	var r2 = item.b;
	var a1 = shapes.circle(p1, r1);
	//var a2 = pH.addMarker(true, p1);
	var a3 = shapes.circle(p2, r2);
	//var a4 = pH.addMarker(true, p2);
	var result = plotModel.findDelta(p1, p2, r1, r2);
	if (!result) {
		//	console.log("no");
		input_data.testing_length[i].result = 0;
	} else {
		//	console.log("yes");
		plotModel.testCount++;
		input_data.testing_length[i].result = 1;
	}

}
var plotModel = {
	findDelta : function(p1, p2, r1, r2) {
		var point_delta = p2 - p1;
		var d = p1.getDistance(p2);
		var d2 = Math.pow(d, 2);
		var case1 = Math.abs(r1 + r2);
		var case2 = Math.abs(r1 - r2);
		var R1 = Math.pow(r1, 2);
		var R2 = Math.pow(r2, 2);
		if (p1 == p2 && Math.abs(d) == 0 || Math.abs(d) > case1 || Math.abs(d) < case2) {
			//alert("false estimation");
			//alert("d:" + Math.abs(d) + "case1 :" + case1 + "case2 :" + case2);
			//this.canvas_circles.activate();
			//pH.alert("false estimation\n " + "d:" + Math.abs(d) + "\n case1 :" + case1 + "\n case2 :" + case2);
			return false;
		} else {
			//alert("success on: test number " + this.testCount);
			var a = (R1 - R2 + d2) / (2 * d);
			var h = Math.sqrt(R1 - Math.pow(a, 2));
			var x = p1.x + a * (p2.x - p1.x) / d;
			var y = p1.y + a * (p2.y - p1.y) / d;
			var x1 = x + h * (p2.y - p1.y) / d;
			var y1 = y - h * (p2.x - p1.x) / d;
			var x2 = x - h * (p2.y - p1.y) / d;
			var y2 = y + h * (p2.x - p1.x) / d;
			pH.plotmap.activate();
			pH.selectpoint(new paper.Point(x1, y1));
			pH.selectpoint(new paper.Point(x2, y2));
			pH.canvas_circles.activate();
			return true;
		}
	},
	updateCount : function() {
		var result = 0;
		for (var test in this.data) {
			//if (this.data.hasOwnProperty('test')) {
			// or Object.prototype.hasOwnProperty.call(obj, prop)
			result++;
			//}
		}
		this.testCount = result;
	},
	testCount : 0,
	data : [],
	default_data_model : {
		p1 : 1,
		p2 : 1,
		r1 : 1,
		p2 : 1,
		delta : null,
		est1 : null,
		est2 : null
	},
	path_point_collection : []
}
var input_data = {
	point_a : {
		x : 202,
		y : 225
	},
	point_b : {
		x : 312,
		y : 325
	},
	testing_length : [{
		a : 153,
		b : 92,
		est : 0.3,
		ref : "P1A"
	}, {
		a : 103,
		b : 602,
		est : 0.3,
		ref : "P2A"
	}, {
		a : 503,
		b : 102,
		est : 0.3,
		ref : "P3A"
	}, {
		a : 203,
		b : 102,
		est : 0.3,
		ref : "P4A"
	}, {
		a : 106,
		b : 202,
		est : 0.3,
		ref : "P5A"
	}, {
		a : 93,
		b : 82,
		est : 0.3,
		ref : "P6A"
	}, {
		a : 53,
		b : 102,
		est : 0.3,
		ref : "P7A"
	}]
}
Handlebars.registerHelper('_result_', function() {
	console.log("print result");
	if (this.result == 0) {
		console.log("print 0");
		return new Handlebars.SafeString('This is not able to Render from this given data point A to the point B.');
	} else if (this.result == 1) {
		console.log("print 1");
		return new Handlebars.SafeString('Normal');
	}
});
var shapes = {
	circle_marker : function() {
		var length = 10;
		var path1 = new paper.Path([length, length], [-length, -length]);
		var path2 = new paper.Path([length, -length], [-length, length]);
		var circle = new paper.Path.Circle(new Point(0, 0), 10);
		path1.strokeColor = 'black';
		path2.strokeColor = 'black';
		circle.fillColor = 'white';
		circle.opacity = 0.7;
		var group = new paper.Group([path1, path2, circle]);
		return group;
	},
	circle : function(point, r) {
		var circlePath = new paper.Path.Circle(point, r);
		circlePath.style = {
			//fillColor : 'white',
			strokeColor : 'black'
		};
		return circlePath;
	},
	get_random_color : function(control_num) {
		if ( typeof (control_num) != "number") {
			var letters = '0123456789ABCDEF'.split('');
			var color = '#';
			for (var i = 0; i < 6; i++) {
				color += letters[Math.round(Math.random() * 15)];
			}
		} else {
			//	console.log("control_num");
			//	console.log(control_num);
			var hash = CryptoJS.MD5(control_num + "thisone");
			color = "#" + hash.toString().substring(0, 6);
		}
		return color;
	},
	circle_sh : function(point, color_number) {
		var color = this.get_random_color(color_number);
		return new paper.Path.Circle({
			center : point,
			radius : 20,
			strokeWidth : 2,
			strokeColor : 'black',
			fillColor : color,
			opacity : 0.6
		});
	}
}