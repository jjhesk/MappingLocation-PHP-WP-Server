<?php

/*
 
I tried the function displayed next to the custom posts Taxonomy (product) with the function
next_post_link ('format', 'link', 'in_same_cat', 'excluded_categories');

But now, it returns me a null value. How can this functionality work?

 */

defined('ABSPATH') || exit ;

if (!class_exists('CTaxNextPrev')) {
class CTaxNextPrev {

    var $taxonomy;

    function __construct($taxonomy) {

        $this->taxonomy = $taxonomy;

    }

    function output($show_title = false,$previous = true) {

        if ( is_attachment() )

            return false;

        $post = $this->query($previous);

        if ( !$post )

            return false;

        

        if($show_title) {

            $title = $post->post_title;         

        }

        else {

            $title = $previous ? __('Previous Post') : __('Next Post');

        }

        

        $rel = $previous ? 'prev' : 'next';

        

        $string = '<a class="navlink" href="'.get_permalink($post).'" rel="'.$rel.'">'.$title.'</a>';

        

        return $string;

    }

    private function query($previous = true ) {
        global $post, $wpdb;
        if ( empty( $post ) )
            return null;
        $current_post_date = $post->post_date;
        $join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";
        $term = $this->taxonomy;
        $cat_array = wp_get_object_terms($post->ID, $term, array('fields' => 'ids'));

        $join .= " AND tt.taxonomy = '$term' AND tt.term_id IN (" . implode(',', $cat_array) . ")";

        

        $adjacent = $previous ? 'previous' : 'next';

        $op = $previous ? '<' : '>';

        $order = $previous ? 'DESC' : 'ASC';



        

        $where = $wpdb->prepare("WHERE p.post_date $op %s AND p.post_type = %s AND p.post_status = 'publish' ", $current_post_date, $post->post_type);

        $sort  = "ORDER BY p.post_date $order LIMIT 1";



        $query = "SELECT p.* FROM $wpdb->posts AS p $join $where $sort";

        $query_key = 'get_nextprev_post_'.$adjacent . md5($query);

        $result = wp_cache_get($query_key, 'counts');

        if ( false !== $result )

            return $result;



        $result = $wpdb->get_row("SELECT p.* FROM $wpdb->posts AS p $join $where $sort");

        if ( null === $result )

            $result = '';



        wp_cache_set($query_key, $result, 'counts');

        return $result;

    }

}
}

?>