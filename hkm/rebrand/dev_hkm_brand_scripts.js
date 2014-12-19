var hkmBrand_objcontrol = {
    _ele5_toggle : function() {
        //remove on site page
        $("#wpadminbar #wp-admin-bar-root-default > #wp-admin-bar-wp-logo .ab-sub-wrapper").hide();
        $("#wpadminbar #wp-admin-bar-root-default > #wp-admin-bar-site-name .ab-sub-wrapper").hide();
        $("#wpadminbar #wp-admin-bar-root-default > #wp-admin-bar-wp-logo .ab-item").attr('title', '');
        var abitemSelector = "#wpadminbar .ab-top-menu > li.menupop > .ab-item";
        var originalBkg = $(abitemSelector).css('background');
        var originalColor = $(abitemSelector).css('color');
        $(abitemSelector).mouseover(function() {
            $(this).css({
                'background' : '#222222',
                'color' : '#fafafa'
            });
        }).mouseout(function() {
            $(this).css({
                'background' : originalBkg,
                'color' : originalColor
            });
        });
    },
    _ele4_toggle : function() {
        $("#wphead #header-logo").css("display", "none");
        $("ul#wp-admin-bar-root-default li#wp-admin-bar-wp-logo").css("display", "none");
    },
    _ele6_toggle : function() {
        $("ul#wp-admin-bar-root-default li#wp-admin-bar-updates").css("display", "none");
    },
    _ele7_toggle : function() {
        $("#update-nag").css("display", "none");
        $(".update-nag").css("display", "none");
    },
    _ele8_toggle : function() {
        $("#screen-options-link-wrap").css("display", "none");
    },
    _ele9_toggle : function() {
        $("#contextual-help-link-wrap").css("display", "none");
        $("#contextual-help-link").css("display", "none");
    },
    _ele10_toggle : function() {
        $("#favorite-actions").css("display", "none");
    },
    _ele11 : function(arg) {
        $('li#wp-admin-bar-my-account').css('cursor', 'default');
        var alltext = $('li#wp-admin-bar-my-account').html();
        if (alltext != null) {
            var parts = alltext.split(',');
            alltext = arg + parts[1];
            $('li#wp-admin-bar-my-account').html(alltext);
        }
    },
    _ele12 : function(arg) {
        $("ul#wp-admin-bar-user-actions li#wp-admin-bar-logout a").text(arg);

    },
    _ele13_toggle : function() {
        $("ul#wp-admin-bar-user-actions li#wp-admin-bar-edit-profile").css("visibility", "hidden");
        $("ul#wp-admin-bar-user-actions li#wp-admin-bar-edit-profile").css("height", "10px");
        $('#wpadminbar #wp-admin-bar-top-secondary > #wp-admin-bar-my-account > a').attr('href', '#');
        $('#wpadminbar #wp-admin-bar-top-secondary #wp-admin-bar-user-info > a').attr('href', '#');
        $('#wpadminbar #wp-admin-bar-top-secondary #wp-admin-bar-edit-profile > a').attr('href', '#');
    },
    _ele14_toggle : function() {
        var logout_content = $("li#wp-admin-bar-logout").html();
        $("ul#wp-admin-bar-top-secondary").html('<li id="wp-admin-bar-logout">' + logout_content + '</li>');
    },
    _af1_toggle : function() {
        $("#footer-left").css("display", "none");
    },
    _af2 : function(arg) {
        $("#footer-left").html(arg);
    },
    _af3_toggle : function() {
        $("#footer-upgrade").css("display", "none");
    },
    _af4 : function(arg) {
        $("#footer-upgrade").html(arg);
    },
    _login_txt : function(arg) {
        $("#backtoblog").prepend("<span>" + arg + "</span><br>");
        $(".login #nav, .login #backtoblog").css(this.config_css_blog_default);
    },
    _dash2_img : function(arg) {

    },
    _dashlogin : function(arg) {
        $("#login>h1").css(this.loginimg_default);
        $("#login>h1").html("<img src=\"" + arg.url + "\"/>");
        $("#login>h1>img").css(this.config_css_login_set)
    },
    loginbgcgf : function(obj) {
        var conf = {
            "background-size" : obj._dashbg_config_w + " " + obj._dashbg_config_h,
            "background-image" : "url(" + obj.url + ")"
        };
        $(".login.login-action-login").css(conf);
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
