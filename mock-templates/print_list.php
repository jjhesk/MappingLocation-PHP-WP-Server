<?php

/**
 * HKM development All Rights Reserved
 * Template Name: PRINTING GUI
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.0
 */

get_header('mobile');
?><style>
        .ui_container {
            display: block;
            width: 100%;
        }

        .ui_container .ui_print_item:nth-child(odd) {
            background-color: #4a9329;
        }

        .ui_container .ui_print_item:nth-child(even) {
            background-color: #919333;
        }

        input[type=submit] {
            width: 200px;
            height: 30px;
        }

        .ui_container form {
            margin-bottom: 2px;
            color:white;
            font-size: 20px;
        }
</style><?php
app_submission::printing_list();
get_footer('mobile');
?>