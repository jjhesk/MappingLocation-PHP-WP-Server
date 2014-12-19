/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
( function() {
	var nav = document.getElementById( 'site-navigation' ), button, menu;
	if ( ! nav )
		return;
	button = nav.getElementsByTagName( 'h3' )[0];
	menu   = nav.getElementsByTagName( 'ul' )[0];
	if ( ! button )
		return;

	// Hide button if menu is missing or empty.
	if ( ! menu || ! menu.childNodes.length ) {
		button.style.display = 'none';
		return;
	}

	button.onclick = function() {
		if ( -1 == menu.className.indexOf( 'nav-menu' ) )
			menu.className = 'nav-menu';

		if ( -1 != button.className.indexOf( 'toggled-on' ) ) {
			button.className = button.className.replace( ' toggled-on', '' );
			menu.className = menu.className.replace( ' toggled-on', '' );
		} else {
			button.className += ' toggled-on';
			menu.className += ' toggled-on';
		}
	};
} )();
/*!
* simplePagination.js v1.4
* A simple jQuery pagination plugin.
* http://flaviusmatis.github.com/simplePagination.js/
*
* Copyright 2012, Flavius Matis
* Released under the MIT license.
* http://flaviusmatis.github.com/license.html
*/
(function(b){var a={init:function(d){var e=b.extend({items:1,itemsOnPage:1,pages:0,displayedPages:5,edges:2,currentPage:1,hrefTextPrefix:"#page-",hrefTextSuffix:"",prevText:"Prev",nextText:"Next",ellipseText:"&hellip;",cssStyle:"light-theme",selectOnClick:true,onPageClick:function(f,g){},onInit:function(){}},d||{});var c=this;e.pages=e.pages?e.pages:Math.ceil(e.items/e.itemsOnPage)?Math.ceil(e.items/e.itemsOnPage):1;e.currentPage=e.currentPage-1;e.halfDisplayed=e.displayedPages/2;this.each(function(){c.addClass(e.cssStyle).data("pagination",e);a._draw.call(c)});e.onInit();return this},selectPage:function(c){a._selectPage.call(this,c-1);return this},prevPage:function(){var c=this.data("pagination");if(c.currentPage>0){a._selectPage.call(this,c.currentPage-1)}return this},nextPage:function(){var c=this.data("pagination");if(c.currentPage<c.pages-1){a._selectPage.call(this,c.currentPage+1)}return this},getPagesCount:function(){return this.data("pagination").pages},getCurrentPage:function(){return this.data("pagination").currentPage+1},destroy:function(){this.empty();return this},redraw:function(){a._draw.call(this);return this},disable:function(){var c=this.data("pagination");c.disabled=true;this.data("pagination",c);a._draw.call(this);return this},enable:function(){var c=this.data("pagination");c.disabled=false;this.data("pagination",c);a._draw.call(this);return this},_draw:function(){var h=this,g=h.data("pagination"),d=a._getInterval(g),e;a.destroy.call(this);if(g.prevText){a._appendItem.call(this,g.currentPage-1,{text:g.prevText,classes:"prev"})}if(d.start>0&&g.edges>0){var c=Math.min(g.edges,d.start);for(e=0;e<c;e++){a._appendItem.call(this,e)}if(g.edges<d.start&&(d.start-g.edges!=1)){h.append('<span class="ellipse">'+g.ellipseText+"</span>")}else{if(d.start-g.edges==1){a._appendItem.call(this,g.edges)}}}for(e=d.start;e<d.end;e++){a._appendItem.call(this,e)}if(d.end<g.pages&&g.edges>0){if(g.pages-g.edges>d.end&&(g.pages-g.edges-d.end!=1)){h.append('<span class="ellipse">'+g.ellipseText+"</span>")}else{if(g.pages-g.edges-d.end==1){a._appendItem.call(this,d.end++)}}var f=Math.max(g.pages-g.edges,d.end);for(e=f;e<g.pages;e++){a._appendItem.call(this,e)}}if(g.nextText){a._appendItem.call(this,g.currentPage+1,{text:g.nextText,classes:"next"})}},_getInterval:function(c){return{start:Math.ceil(c.currentPage>c.halfDisplayed?Math.max(Math.min(c.currentPage-c.halfDisplayed,(c.pages-c.displayedPages)),0):0),end:Math.ceil(c.currentPage>c.halfDisplayed?Math.min(c.currentPage+c.halfDisplayed,c.pages):Math.min(c.displayedPages,c.pages))}},_appendItem:function(c,g){var e=this,f,d,h=e.data("pagination");c=c<0?0:(c<h.pages?c:h.pages-1);f=b.extend({text:c+1,classes:""},g||{});if(c==h.currentPage||h.disabled){d=b('<span class="current">'+(f.text)+"</span>")}else{d=b('<a href="'+h.hrefTextPrefix+(c+1)+h.hrefTextSuffix+'" class="page-link">'+(f.text)+"</a>");d.click(function(i){return a._selectPage.call(e,c,i)})}if(f.classes){d.addClass(f.classes)}e.append(d)},_selectPage:function(c,d){var e=this.data("pagination");e.currentPage=c;if(e.selectOnClick){a._draw.call(this)}return e.onPageClick(c+1,d)}};b.fn.pagination=function(c){if(a[c]&&c.charAt(0)!="_"){return a[c].apply(this,Array.prototype.slice.call(arguments,1))}else{if(typeof c==="object"||!c){return a.init.apply(this,arguments)}else{b.error("Method "+c+" does not exist on jQuery.pagination")}}}})(jQuery);