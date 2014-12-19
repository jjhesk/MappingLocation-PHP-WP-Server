<?php
/**
 * Created by PhpStorm.
 * User: Hesk
 * Date: 14年5月14日
 * Time: 下午5:14
 */
defined('ABSPATH') || exit;

// INIT
add_action('after_setup_theme', array('unavailable_post_status', 'init'));

class unavailable_post_status extends wp_custom_post_status
{
    /**
     * @access protected
     * @var string
     */
    static protected $instance;


    /**
     * Creates a new instance. Called on 'after_setup_theme'.
     * May be used to access class methods from outside.
     *
     * @return void
     */
    static public function init()
    {
        null === self :: $instance and self :: $instance = new self;
        return self :: $instance;
    }
    public function __construct()
    {
        // Set your data here. Only "$post_status" is required.
        $this->post_status = 'unavailable';
        // The post types where you want to add the custom status. Allowed are string and array
        $this->post_type = 'post';
        // @see parent class: defaults inside add_post_status()
        $this->args = array();
        parent :: __construct();
    }
}