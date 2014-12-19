jQuery(function ($) {
    //var $ = jQuery;
    $("#menu-p1").addClass("active");
    $(".step1 .ginput_container").on("click", function () {
        //  alert("step1 yes");
        $("#menu-p2").removeClass("active");
        $("#menu-p1").addClass("active");
    });
    $(".step2 input").on("focus", function () {
        //  alert("step2 yes");
        $("#menu-p1").removeClass("active");
        $("#menu-p2").addClass("active");
    });
    $(document).bind('gform_confirmation_loaded', function (event, form_id) {
        $("#gforms_confirmation_message").addClass("well");
        $("#gforms_confirmation_message .okay").on("click", function () {
            //	ocform_newcr.cr_form_select_company_init();
            //alert("done here");
        });
        //$(".entry-content").append('<button class="">Add Our Company Representatives Now</button>');
        //$('#form-success').slideDown('slow');


        /*   console.log(event);
         console.log(form_id);
         console.log("---");
         */
        $("#menu-p1").removeClass("active");
        $("#menu-p2").removeClass("active");
        $("#menu-p3").addClass("active");
    });

    jQuery(document).bind('gform_post_render', function (event, form_id, current_page) {
        /*   console.log(event);
         console.log(form_id);
         console.log(current_page);
         console.log("---");*/
        switch (parseInt(current_page)) {
            case 1:
                // console.log("-1--");
                $("#menu-p1").addClass("active");
                $("#menu-p2").removeClass("active");
                $("#menu-p3").removeClass("active");
                return false;
            case 2:
                $('#field_7_19 .gfield_label').css('width', 'auto');
                // console.log(current_page);
                $("#menu-p1").removeClass("active");
                $("#menu-p2").addClass("active");
                $("#menu-p3").removeClass("active");
                return false;
            default :
                return false;
        }
    });
});
