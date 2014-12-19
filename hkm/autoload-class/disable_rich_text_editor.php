<?php
// Prevent loading this file directly
defined('ABSPATH') || exit;

if (!class_exists('disable_rich_text_editor')) {
    // HKMhelper Class
    class disable_rich_text_editor
    {

        private $disable_post_ids = array();

        public function __construct($args = array())
        {
            //$this -> makeDisabled($args);

        }

        public function register($list_ids)
        {
            $this->disable_post_ids = $list_ids;
        }

        public function makeDisabled($args)
        {
            if (!is_admin()) return;
            $this->register($args);
            //this is good for Version 3.5.1
            add_action('admin_head', array(&$this, 'remove_rich_editor'), 10);
            add_action('init', array(&$this, 'reomve_craps'), 11);
        }

        public function reomve_craps()
        {
            remove_post_type_support('page', 'comments');
            remove_post_type_support('page', 'thumbnail');
        }

        public function remove_rich_editor()
        {
            global $post, $page;
            $screen = get_current_screen();
            if (isset($screen->base) && isset($post->ID)) {
                if (in_array($post->ID, $this->disable_post_ids)) {
                    //    echo "wpse_58501_page_can_richedit false";
                    //doesnt matter what post type it is.
                    remove_post_type_support($post->post_type, 'editor');

                }
                // end if
            }
        }

    }

}
?>
