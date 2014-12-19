function create() {
	//create particle and random values
	var $particle = jQuery('<div class="particle" />'), x = Math.randMinMax(-boundx, boundx), y = Math.randMinMax(-boundx, boundx / 4), z = Math.randMinMax(-200, 200), degree = Math.randMinMax(0, 360), color = 'hsla(' + Math.randMinMax(200, 320) + ', 80%, 60%, 1)';

	//append particle to dom
	$particle.css('background', color);
	$emitter.append($particle);

	//after a short timeout, set css to be transitioned to. Without the timeout, we would not see the transition
	window.setTimeout(function() {
		$particle.css({
			webkitTransform : 'translateX(' + x + 'px) translateY(' + y + 'px) translateZ(' + z + 'px) rotateX(' + degree + 'deg)',
			opacity : 0
		});
	}, 50);

	//remove current particle after time
	window.setTimeout(function() {
		$particle.remove();
	}, removeAfter);

	//create next particle
	window.setTimeout(create, emitEvery);

}

//https://gist.github.com/timohausmann/4997906
Math.randMinMax = function(t, n, a) {
	var r = t + Math.random() * (n - t)
	return a && ( r = Math.round(r)), r
}
//execute first particle creation
var $emitter, emitEvery, boundx, boundy;
jQuery(function($) {
	var a = location.href.indexOf('hkmbranding') >= 0;
	var b = location.href.indexOf('OCapp') >= 0;
	var c = location.href.indexOf('theme-editor.php') >= 0;

	if (a || b || c) {
		$("body").append("<div id='wrapemitter'><div id='emitter'></div></div>");
		$emitter = jQuery('#emitter'), emitEvery = 50, //emit new particle every X ms
		removeAfter = 3000;
		boundx = 1000;
		//remove particles after X ms
		create();
	}

});
