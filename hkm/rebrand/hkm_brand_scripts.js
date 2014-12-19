var _j=jQuery;
var hkmBrand_objcontrol = {
    _ele5_toggle : function() {
        //remove on site page
        _j("#wpadminbar #wp-admin-bar-root-default > #wp-admin-bar-wp-logo .ab-sub-wrapper").remove();
        _j("#wpadminbar #wp-admin-bar-root-default > #wp-admin-bar-site-name .ab-sub-wrapper").remove();
        _j("#wpadminbar #wp-admin-bar-root-default > #wp-admin-bar-wp-logo .ab-item").attr('title', '');
        var abitemSelector = "#wpadminbar .ab-top-menu > li.menupop > .ab-item";
        var originalBkg = _j(abitemSelector).css('background');
        var originalColor = _j(abitemSelector).css('color');
        _j(abitemSelector).mouseover(function() {
            _j(this).css({
                'background' : '#222222',
                'color' : '#fafafa'
            });
        }).mouseout(function() {
            _j(this).css({
                'background' : originalBkg,
                'color' : originalColor
            });
        });
    },
    _ele4_toggle : function() {
        _j("#wphead #header-logo").remove();
        _j("ul#wp-admin-bar-root-default li#wp-admin-bar-wp-logo").css("display", "none");
    },
    _ele6_toggle : function() {
        _j("ul#wp-admin-bar-root-default li#wp-admin-bar-updates").css("display", "none");
    },
    _ele7_toggle : function() {
        _j("#update-nag").css("display", "none");
        _j(".update-nag").css("display", "none");
    },
    _ele8_toggle : function() {
        _j("#screen-options-link-wrap").css("display", "none");
    },
    _ele9_toggle : function() {
        _j("#contextual-help-link-wrap").css("display", "none");
        _j("#contextual-help-link").css("display", "none");
    },
    _ele10_toggle : function() {
        _j("#favorite-actions").css("display", "none");
    },
    _ele11 : function(arg) {
        _j('li#wp-admin-bar-my-account').css('cursor', 'default');
        var alltext = _j('li#wp-admin-bar-my-account').html();
        if (alltext != null) {
            var parts = alltext.split(',');
            alltext = arg + parts[1];
            _j('li#wp-admin-bar-my-account').html(alltext);
        }
    },
    _ele12 : function(arg) {
        _j("ul#wp-admin-bar-user-actions li#wp-admin-bar-logout a").text(arg);

    },
    _ele13_toggle : function() {
        _j("ul#wp-admin-bar-user-actions li#wp-admin-bar-edit-profile").css("visibility", "hidden");
        _j("ul#wp-admin-bar-user-actions li#wp-admin-bar-edit-profile").css("height", "10px");
        _j('#wpadminbar #wp-admin-bar-top-secondary > #wp-admin-bar-my-account > a').attr('href', '#');
        _j('#wpadminbar #wp-admin-bar-top-secondary #wp-admin-bar-user-info > a').attr('href', '#');
        _j('#wpadminbar #wp-admin-bar-top-secondary #wp-admin-bar-edit-profile > a').attr('href', '#');
    },
    _ele14_toggle : function() {
        var logout_content = _j("li#wp-admin-bar-logout").html();
        _j("ul#wp-admin-bar-top-secondary").html('<li id="wp-admin-bar-logout">' + logout_content + '</li>');
    },
    _af1_toggle : function() {
        _j("#footer-left").css("display", "none");
    },
    _af2 : function(arg) {
        _j("#footer-left").html(arg);
    },
    _af3_toggle : function() {
        _j("#footer-upgrade").css("display", "none");
    },
    _af4 : function(arg) {
        _j("#footer-upgrade").html(arg);
    },
    _login_txt : function(arg) {
        _j("#backtoblog").prepend("<span>" + arg + "</span><br>");
        _j(".login #nav, .login #backtoblog").css(this.config_css_blog_default);
        _j(".login a").css({"color" : "white"});
    },
    _dashlogin_hide : function() {
        _j("#login>h1").remove();
    },
    _dashlogin : function(arg) {
        _j("#login>h1").css(this.loginimg_default);
        _j("#login>h1").html("<img src=\"" + arg.url + "\"/>");
        _j("#login>h1>img").css(this.config_css_login_set)
    },
    loginbgcgf : function(obj) {
        var conf = {
            "background-size" : obj._dashbg_config_w + " " + obj._dashbg_config_h,
            "background-image" : "url(" + obj.url + ")",
            "background-repeat":"no-repeat",
            "background-position":"50% 50%",
            "background-color":"black"
        };
        _j(".login").css(conf);
    },
    config_css_login_set : {
        "width" : "102%",
        "display" : "block"
    },
    loginimg_default : {
        "height" : "100%",
        "width" : "100%",
        "display" : "block"
    },
    config_css_blog_default : {
        "text-shadow" : "2px 1px 3px rgb(12, 214, 133),4px 3px 5px rgb(65, 235, 167)",
        "margin" : "0 0 0 16px",
        "padding" : "16px 16px 0",
        "color" : "white",
        "font-weight" : "bold"
    }
}
