<?php

/**
 * Created by PhpStorm.
 * User: Hesk
 * Date: 14年6月6日
 * Time: 下午1:58
 */
defined('ABSPATH') || exit;
if (!class_exists('oc_report')) {
    class oc_report extends oc_db
    {
        public static function get_submission_list($jobid)
        {
            global $wpdb;
            $tab = DB_PROJECTRETURN;
            $sql = "SELECT * FROM $tab WHERE post_job_id=$jobid ORDER BY upload_stamp DESC";
            $result = $wpdb->get_results($sql) or die(mysql_error());
            $out = array();
            foreach ($result as $res) {
                $out[] = array(
                    "android_id" => $res->android_id,
                    "post_job_id" => $res->post_job_id,
                    "ID" => $res->ID,
                    "upload_stamp" => $res->upload_stamp,
                    "drawmaps" => $res->drawmaps,
                    "photos" => $res->photos,
                );
                unset($res->machine_data);
            }
            return $out;

        }

        public static function get_submission_sub($jobid, $sub)
        {
            global $wpdb;
            $tab = DB_PROJECTRETURN;
            $sql = "SELECT * FROM $tab WHERE post_job_id=$jobid AND ID=$sub ORDER BY upload_stamp DESC";
            $result = $wpdb->get_row($sql) or die(mysql_error());
            //  $out = array();
            /* foreach ($result as $res) {
                 $out[] = array(
                     "android_id" => $res->android_id,
                     "post_job_id" => $res->post_job_id,
                     "ID" => $res->ID,
                     "upload_stamp" => $res->upload_stamp,
                     "drawmaps" => $res->drawmaps,
                     "photos" => $res->photos,
                     "machine" => $res->machine_data
                 );
             }*/
            $aar_objects = array();
            foreach (explode(",", $result->photos) as $id) {
                if (wp_attachment_is_image(intval($id))) {
                    $aar_objects[] = array(
                        "id" => intval($id),
                        "src" => wp_get_attachment_url(intval($id))
                    );
                };
                // what's image uploader for?
            }
            unset($result->photos);
            $result->photo_object = $aar_objects;
            return $result;

        }

        private static function print_taxonomic_ranks($terms = '')
        {

            /* // check input
             if (empty($terms) || is_wp_error($terms) || !is_array($terms))
                 return;

             // set id variables to 0 for easy check
             $order_id = $family_id = $subfamily_id = 0;

             // get order
             foreach ($terms as $term) {
                 if ($order_id || $term->parent)
                     continue;
                 $order_id = $term->term_id;
                 $order = $term->name;
             }

             // get family
             foreach ($terms as $term) {
                 if ($family_id || $order_id != $term->parent)
                     continue;
                 $family_id = $term->term_id;
                 $family = $term->name;
             }

             // get subfamily
             foreach ($terms as $term) {
                 if ($subfamily_id || $family_id != $term->parent)
                     continue;
                 $subfamily_id = $term->term_id;
                 $subfamily = $term->name;
             }*/
            // if terms is not array or its empty don't proceed

            /*
                        if (!is_array($terms) || empty($terms)) {
                            return false;
                        }*/
            /*
                        foreach ($terms as $term) {
                            // if the term have a parent, set the child term as attribute in parent term
                            if ($term->parent != 0) {
                                $terms[$term->parent]->child = $term;
                            } else {
                                // record the parent term
                                $parent = $term;
                            }


                        }*/
            $tags = array();
            foreach ($terms as $term) {
                $tags[] = $term->slug;
            }
            $display_list = join(", ", $tags);
            // output
            //  return "Order: $order, Family: $family, Sub-family: $subfamily";
            return $display_list;
        }

        public static function get_report($job_id)
        {
            $args = array(
                'status' => 'publish',
                'post_type' => 'reports',
                'posts_per_page' => -1,
                'meta_query' => array(
                    array(
                        'key' => 'report_job_id',
                        'value' => $job_id,
                    )
                )
            );
            $out = array();
            $f = new WP_Query($args);
            if ($f->have_posts()) :
                while ($f->have_posts()):$f->the_post();
                    $id = $f->post->ID;
                    $out[] = array(
                        "r_id" => $id,
                        "report_name" => get_the_title(),
                        "status" => $f->post->post_status
                    );
                endwhile;  endif;
            wp_reset_query();
            return $out;
        }

        public static function get_templates()
        {
            $args = array(
                'status' => 'publish',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'terms' => 'templates',
                        'field' => 'slug',
                    )
                ),
                'post_type' => 'page',
                'posts_per_page' => -1
            );
            $out = array();
            $f = new WP_Query($args);

            if ($f->have_posts()) :
                while ($f->have_posts()):$f->the_post();
                    $id = $f->post->ID;
                    $terms = get_the_terms($id, 'category');
                    if ($terms && !is_wp_error($terms)) :
                        $tags = array(); /*
                        foreach ($terms as $term) {
                            $tags[] = $term->slug;
                        }
                        $display_list = join(", ", $tags);*/
                        $display_list = self::print_taxonomic_ranks($terms);
                    else:
                        $display_list = "no data";
                    endif;
                    $out[] = array(
                        "id" => $id,
                        "template" => get_the_content(),
                        "name" => get_the_title(),
                        "cat" => $display_list
                    );
                endwhile;  endif;
            wp_reset_query();
            return $out;
        }

    }
}