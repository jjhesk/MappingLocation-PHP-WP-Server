/**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */

jQuery(document).ready(function($) {

  jQuery("#ec_custom_logo").change(function() {
    var toShow = jQuery("#section-ec_logo");
    if(jQuery(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
	jQuery("#ec_logo_url_toggle").change(function() {
    var toShow = jQuery("#section-ec_logo_url");
    if(jQuery(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
	jQuery("#ec_favicon_toggle").change(function() {
    var toShow = jQuery("#section-ec_favicon");
    if(jQuery(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
		}).change();	
	jQuery("#ec_apple_touch_toggle").change(function() {
    var toShow = jQuery("#section-ec_apple_touch");
    if(jQuery(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
		}).change();	
  jQuery("#section-ec_font").change(function() {
    if(jQuery(this).find(":selected").val() == 'custom') {
      jQuery('#section-ec_custom_font').fadeIn();
    } else {
      jQuery('#section-ec_custom_font').hide();
    }
  }).change();
  jQuery("#section-ec_menu_font").change(function() {
    if(jQuery(this).find(":selected").val() == 'custom') {
      jQuery('#section-ec_custom_menu_font').fadeIn();
    } else {
      jQuery('#section-ec_custom_menu_font').hide();
    }
  }).change();
    jQuery("#section-ec_front_product_type").change(function() {
    if(jQuery(this).find(":selected").val() == 'key1') {
      jQuery('#section-ec_front_product_image').fadeIn();
    } else ec
  }).change();
     jQuery("#section-ec_front_product_type").change(function() {
    if(jQuery(this).find(":selected").val() == 'key2') {
      jQuery('#section-ec_front_product_video').fadeIn();
    } else {
      jQuery('#section-ec_front_product_video').hide();
    }
  }).change();
   jQuery("#section-ec_blog_product_type").change(function() {
    if(jQuery(this).find(":selected").val() == 'key1') {
      jQuery('#section-ec_blog_product_image').fadeIn();
    } else {
      jQuery('#section-ec_blog_product_image').hide();
    }
  }).change();
     jQuery("#section-ec_blog_product_type").change(function() {
    if(jQuery(this).find(":selected").val() == 'key2') {
      jQuery('#section-ec_blog_product_video').fadeIn();
    } else {
      jQuery('#section-ec_blog_product_video').hide();
    }
  }).change();

  jQuery("#ec_show_excerpts").change(function() {
    var toShow = jQuery("#section-ec_excerpt_link_text, #section-ec_excerpt_length");
    if(jQuery(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
  jQuery("#ec_portfolio_title_toggle").change(function() {
    var toShow = jQuery("#section-ec_portfolio_title");
    if(jQuery(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
    jQuery("#ec_blog_product_link_toggle").change(function() {
    var toShow = jQuery("#section-ec_blog_product_link_url, #section-ec_blog_product_link_text");
    if(jQuery(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
   jQuery("#ec_front_product_link_toggle").change(function() {
    var toShow = jQuery("#section-ec_front_product_link_url, #section-ec_front_product_link_text");
    if(jQuery(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
   jQuery("#ec_box_title_toggle").change(function() {
    var toShow = jQuery("#section-ec_box_title");
    if(jQuery(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();	
     jQuery("#ec_recent_posts_title_toggle").change(function() {
    var toShow = jQuery("#section-ec_recent_posts_title");
    if(jQuery(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
  jQuery("#ec_show_featured_images").change(function() {
    var toShow = jQuery("#section-ec_featured_image_align, #section-ec_featured_image_height, #section-ec_featured_image_width");
    if(jQuery(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
    jQuery("#ec_disable_footer").change(function() {
    var toShow = jQuery("#section-ec_footer_text, #section-ec_hide_link");
    if(jQuery(this).is(':checked')) {
      toShow.fadeIn();
    } else {
      toShow.fadeOut();
    }
  }).change();
      jQuery("#ec_custom_background").change(function() {
    var toShow = jQuery("#section-ec_background_upload, #section-ec_bg_image_position, #section-ec_bg_image_repeat, #section-ec_background_color, #section-ec_bg_image_attachment ");
    if(jQuery(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
   }).change();
      jQuery("#ec_custom_menu_color_toggle").change(function() {
    var toShow = jQuery("#section-ec_custom_menu_color, #section-ec_custom_dropdown_color, #section-ec_menulink_color, #section-ec_menu_hover_color ");
    if(jQuery(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
  jQuery("#ec_slider_type").change(function(){
    var val = jQuery(this).val(),
      post = jQuery("#section-ec_slider_category"),
      custom = jQuery("#section-ec_customslider_category");
    if(val == 'custom') {
      post.hide(); custom.show();
    } else {
      post.show(); custom.hide();
    }
  }).change();

  jQuery.each(['twitter', 'facebook', 'gplus', 'flickr', 'linkedin', 'pinterest', 'youtube', 'googlemaps', 'email', 'rsslink'], function(i, val) {
	  jQuery("#section-ec_" + val).each(function(){
		  var Dis = jQuery(this), Nex = jQuery(this).next();
		  Dis.find(".controls").css({float: 'left', clear: 'both'});
		  Nex.find(".controls").css({float: 'right', width: 80});
		  Nex.hide();
		  Dis.find('.option').before(Nex.find(".option"));
		  Dis.find("input[type='checkbox']").change(function() {
			  if(jQuery(this).is(":checked")) {
				  jQuery(this).closest('.option').next().show();
			  } else {
				  jQuery(this).closest('.option').next().hide();
			  }
		  }).change();
	  });
  });
});	

jQuery(function($) {
	var initialize = function(id) {
		var el = jQuery("#" + id);
		function update(base) {
			var hidden = base.find("input[type='hidden']");
			var val = [];
			base.find('.right_list .list_items span').each(function() {
				val.push(jQuery(this).data('key'));
			});
			hidden.val(val.join(",")).change();
			el.find('.right_list .action').show();
			el.find('.left_list .action').hide();
		}
		el.find(".left_list .list_items").delegate(".action", "click", function() {
			var item = jQuery(this).closest('.list_item');
			jQuery(this).closest('.section_order').children('.right_list').children('.list_items').append(item);
			update(jQuery(this).closest(".section_order"));
		});
		el.find(".right_list .list_items").delegate(".action", "click", function() {
			var item = jQuery(this).closest('.list_item');
			jQuery(this).val('Add');
			jQuery(this).closest('.section_order').children('.left_list').children('.list_items').append(item);
			jQuery(this).hide();
			update(jQuery(this).closest(".section_order"));
		});
		el.find(".right_list .list_items").sortable({
			update: function() {
				update(jQuery(this).closest(".section_order"));
			},
			connectWith: '#' + id + ' .left_list .list_items'
		});

		el.find(".left_list .list_items").sortable({
			connectWith: '#' + id + ' .right_list .list_items'
		});

		update(el);
	}

	jQuery('.section_order').each(function() {
		initialize(jQuery(this).attr('id'));
	});

	jQuery("input[name='eclipse[ec_blog_section_order]']").change(function(){
		var show = jQuery(this).val().split(",");
		var map = {
			response_blog_slider: "subsection-featureslider",
			response_post: "subsection-blogoptions",
			response_callout_section: "subsection-calloutoptions",
			response_portfolio_element: "subsection-portfoliooptions",
			response_box_section: "subsection-boxoptions",
			response_recent_posts_element: "subsection-recentpostsoptions",
			response_twitterbar_section: "subsection-twtterbaroptions",
			response_index_carousel_section: "subsection-carouseloptions",
			response_product_element: "subsection-productoptions"
			// , response_box_section: ""
		};

		jQuery.each(map, function(key, value) {
			jQuery("#" + value).hide();
			jQuery.each(show, function(i, show_key) {
				if(key == show_key)
					jQuery("#" + value).show();
			});
		});
	}).trigger('change');
	
		jQuery("input[name='eclipse[ec_front_section_order]']").change(function(){
		var show = jQuery(this).val().split(",");
		var map = {
			response_portfolio_element: "subsection-portfolio",
			response_twitterbar_section: "subsection-twtterbar",
			response_box_section: "subsection-box",
			response_recent_posts_element: "subsection-recentposts",
			// , response_box_section: ""
		};

		jQuery.each(map, function(key, value) {
			jQuery("#" + value).hide();
			jQuery.each(show, function(i, show_key) {
				if(key == show_key)
					jQuery("#" + value).show();
			});
		});
	}).trigger('change');
	
	jQuery("input[name='response[header_section_order]']").change(function(){
		var show = jQuery(this).val().split(",");
		var map = {
			response_sitename_contact: "section-ec_header_contact",
			response_description_icons: "subsection-social"
			// , response_box_section: ""
		};

		jQuery.each(map, function(key, value) {
			jQuery("#" + value).hide();
			jQuery.each(show, function(i, show_key) {
				if(key == show_key)
					jQuery("#" + value).show();
			});
		});
	}).trigger('change');

});
