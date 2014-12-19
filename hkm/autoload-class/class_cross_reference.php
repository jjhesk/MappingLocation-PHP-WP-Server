<?
// Prevent loading this file directly
defined('ABSPATH') || exit ;

if (!class_exists('hkm_cross_reference')) {
    // HKMhelper Class
    class hkm_cross_reference {
        /*function __construct(){
         $this->meta_featured_image_div=array();
         }*/

        public function meta_box_get_post_title($id, $type) {
            $optionpost = null;
            $items = get_posts(array('post_type' => $type, 'posts_per_page' => -1, "include" => $id));
            foreach ($items as $item) {
                $optionpost = $item -> post_title;
            }
            return $optionpost;
        }

        public function meta_box_get_post_slug($id, $type) {
            $optionpost = null;
            $items = get_posts(array('post_type' => $type, 'posts_per_page' => -1, "include" => array($id)));
            $optionpost = $items[0] -> post_name;
            return $optionpost;
        }

        public function meta_box_enhance_list_post($posttype) {
            $optionpost = null;
            $optionpost[-1] = " [ empty field here ] ";
            $items = get_posts(array('post_type' => $posttype, 'posts_per_page' => -1));
            foreach ($items as $item) {
                $optionpost[$item -> ID] = $item -> ID . " - " . $item -> post_title;
            }
            return $optionpost;
        }

        public function meta_box_enhance_list_get_field_id($posttype, $id, $fieldrequired) {
            $optionpost = null;
            $optionpost = array();
            $items = get_posts(array('post_type' => $type, 'posts_per_page' => -1, "include" => $id));
            foreach ($items as $item) {
                $optionpost[$item -> ID] = $item -> post_title;
            }
            return $optionpost;
        }

        public function meta_box_enhance_thumbnail_src($posttype, $id) {
            $optionpost = "";
            $items = get_posts(array('post_type' => $posttype, "include" => $id));
            /*, 'meta_query' => array( array(
             'key' => '_thumbnail_id',
             'value' => '0',
             'compare' => '>=',
             )
             )*/
            $optionpost = wp_get_attachment_image_src(get_post_thumbnail_id($items[0] -> ID), 'cd_player_album_cover');
            return $optionpost[0];
        }



    }

}
?>