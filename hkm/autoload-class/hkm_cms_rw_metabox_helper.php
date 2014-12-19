<?
// Prevent loading this file directly
defined('ABSPATH') || exit ;

if (!class_exists('hkm_cms_rw_metabox_helper')) {
	// HKMhelper Class
	class hkm_cms_rw_metabox_helper {
		/*function __construct(){
		 $this->meta_featured_image_div=array();
		 }*/
		private function protocal() {
		}

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
			$optionpost = $items[0]->post_name;
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
			$items = get_posts(array('post_type' => $posttype, 'posts_per_page' => -1, "include" => $id));
			foreach ($items as $item) {
				$optionpost[$item -> ID] = $item -> post_title;
			}
			return $optionpost;
		}

		public function tax_label_chinese($mainlabel) {
			$labels = array('name' => _x($mainlabel, 'taxonomy general name'), 'singular_name' => _x($mainlabel, 'taxonomy singular name'), 'search_items' => __('搜查' . $mainlabel, HKM_LANGUAGE_PACK), 'all_items' => __('所有' . $mainlabel, HKM_LANGUAGE_PACK), 'parent_item' => __($mainlabel . '之群組', HKM_LANGUAGE_PACK), 'parent_item_colon' => __($mainlabel . '之群組:', HKM_LANGUAGE_PACK), 'edit_item' => __('修改' . $mainlabel, HKM_LANGUAGE_PACK), 'update_item' => __('更新' . $mainlabel, HKM_LANGUAGE_PACK), 'add_new_item' => __('追加' . $mainlabel, HKM_LANGUAGE_PACK), 'new_item_name' => __('追加' . $mainlabel . '名稱', HKM_LANGUAGE_PACK), 'menu_name' => __($mainlabel, HKM_LANGUAGE_PACK), );
			return $labels;
		}

		public static function urlPostType($post_type) {
			$url = admin_url('edit.php?post_type=' . $post_type);
			$wrap = "<a href=" . $url . ">" . __("搜尋ID", HKM_LANGUAGE_PACK) . "</a>";
			return $wrap;
		}

		private $meta_featured_image_div = array();

		public function div_thumb_image($meta_featured_image_div) {
			/*$meta_featured_image_div = array();
			 $meta_featured_image_div [] = "sss";*/
			//$meta_featured_image_div=array();
			$this -> meta_featured_image_div = $meta_featured_image_div;
			foreach ($this->fields as $field) {
				$class = self::get_class_name($field);

				if (method_exists($class, 'add_actions'))
					call_user_func(array($class, 'add_actions'));
			}
			echo "<br/>class_hkmhelper 33";
			print_r($meta_featured_image_div);
			//$this -> meta_featured_image_div[] =  $meta_featured_image_div;
			//add_action('admin_head-post-new.php', array($this, 'change_thumbnail_html'));
			add_action('admin_head-post-new.php', array(&$this, 'change_thumbnail_html'));
			// Add additional actions for fields

			echo "<br/>class_hkmhelper 37";
			add_action('admin_head-post.php', array(&$this, 'change_thumbnail_html'));

		}

		/**
		 * Get field class name
		 *
		 * @param array $field Field array
		 *
		 * @return bool|string Field class name OR false on failure
		 */
		static function get_class_name($field) {
			$type = ucwords($field['type']);
			$class = "RWMB_{$type}_Field";

			if (class_exists($class))
				return $class;

			return false;
		}

		private function change_thumbnail_html($content) {
			echo "<br/>class_hkmhelper 44";
			if ($this -> data_object_div_thumb_image['post_type'] == $GLOBALS['post_type'])
				add_filter('admin_post_thumbnail_html', array(&$this, 'do_thumb'));
		}

		private function do_thumb($content) {
			//$content = str_replace(__('Set featured image'), $this -> data_object_div_thumb_image['link_word'], $content);
			//$content = str_replace(__('Set featured image'), $this -> meta_featured_image_div['link_word'], $content);
			//$content .= $this -> data_object_div_thumb_image['extra_content'];
			$content .= "<br/>class_hkmHelper 52";
			return $content;
		}

		private function wallpaper_wsm_image_box() {
			remove_meta_box('postimagediv', &$this -> data_object_div_thumb_image['post_type'], 'side');
			add_meta_box('postimagediv', &$this -> data_object_div_thumb_image['title'], 'post_thumbnail_meta_box', &$this -> data_object_div_thumb_image['post_type'], 'normal', 'high');

		}

	}

}
?>