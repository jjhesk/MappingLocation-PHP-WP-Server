/**
 * Created by hesk on 1/12/14.
 */
jQuery(function ($) {
    var $ = jQuery;
    var interact = "tap click";

    $("#get_check_list").on(interact, function () {

    });

    $("#printpage").on(interact, function () {
        window.print();
    });

    $("#get_image").on(interact, function () {
        html2canvas($('#finalized_basemap_print'), {
            onrendered: function (canvas) {
                $("#save_image_area").html(canvas);
                Canvas2Image.saveAsPNG(canvas);
                //saveImageAsData();
            }
        });
        // $("#save_image_box").removeClass("hidden");
    });

    $('#toggle_image').on(interact, function () {
        jQuery("#save_image_box").toggleClass('hidden');
    });


    var la_position = ["bl", "br", "tr", "tl"];
    var la_position_index = 0;
    var legend_touch = $('#legend_area');
    legend_touch.on(interact, function () {
        $.each(la_position, function (index, value) {
            if (legend_touch.hasClass(value)) {
                legend_touch.removeClass(value);
                la_position_index++;
                la_position_index %= 4;
                //    console.log(la_position[la_position_index]);
            }
        });
        legend_touch.addClass(la_position[la_position_index]);
    });
});
function saveImageAs() {
    window.onload = function () {
        var img = document.getElementById('embedImage');
        var button = document.getElementById('saveImage');
        img.src = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUA' +
            'AAAFCAYAAACNbyblAAAAHElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO' +
            '9TXL0Y4OHwAAAABJRU5ErkJggg==';
        img.onload = function () {
            button.removeAttribute('disabled');
        };
        button.onclick = function () {
            window.location.href = img.src.replace('image/png', 'image/octet-stream');
        };
    };
}
function saveImageAsData() {
    var canvas = jQuery("#save_image_area canvas");
    Canvas2Image.saveAsPNG(canvas);
}