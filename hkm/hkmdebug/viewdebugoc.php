<?php
/**
 * Created by PhpStorm.
 * User: hesk
 * Date: 4/23/14
 * Time: 11:46 PM
 */
defined('ABSPATH') || exit;
use hkmdebug\core\log_review as logRw;

if (class_exists('hkmdebug\core\log_review')):
    class viewdebugoc extends logRw
    {
        public static function review_code_list($code)
        {
            parent::log_login_errors_display($code);
        }
    }
endif;