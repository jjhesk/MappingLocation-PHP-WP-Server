<?php
/**
 * Created by PhpStorm.
 * User: hesk
 * Date: 1/17/14
 * Time: 1:03 AM
 */
defined('ABSPATH') || exit;

class header_direct
{

    private static $public_pages = array(396, 399, 394, 309, 161, 194, 180, LAND_PUBLIC);
    private static $after_login_pages = array(
        'cr' => LAND_CR,
        'cp' => LAND_CP,
        'ocstaff' => LAND_STAFF,
        'administrator' => LAND_ADMIN
    );

    public static function init()
    {
        //   add_action('get_header', array(__CLASS__, 'system_pages_direct'), 6);
        //   add_action('render_home_page_section', array(__CLASS__, 'un_loginpage'), 100);
        //    add_action('afterlogin_page', array(__CLASS__, 'in_loginpage'), 100);
        //    add_action('beforelogin_index', array(__CLASS__, 'un_login'), 100);
        //    add_action('afterlogin_index', array(__CLASS__, 'in_login'), 100);
    }

    public function __construct()
    {
       add_filter('login_redirect', array(&$this, 'login_redirect_f'), 99, 3);
        //  debugoc::upload_bmap_log("loading construct for header redirection", 60);
        //   add_filter('single_template', array(&$this, 'oc_single_template_controller'), 15);
    //   add_action('template_redirect', array(&$this, 'intercept_template_hierarchy'), 20);
    }

    public function intercept_template_hierarchy()
    {

        /* global $post;
         if (get_post_type($post) == HKMBASEMAP && is_single()) {
             if (file_exists(get_template_directory() . '/single-my_cpt-' . $post->post_name . '.php')) {
                 include(get_template_directory() . '/single-my_cpt-' . $post->post_name . '.php');
                 exit;
             }
         }*/
      //  add_filter('single_template', array(&$this, 'add_posttype_slug_template'), 10, 1);
    }

    public function add_posttype_slug_template($templates)
    {
        // wp_reset_query();
        $object = get_queried_object();

        //debugoc::upload_bmap_log("add_9post1type_5slug_template" . print_r($templates, true) . " : and : " . print_r($object, true), 51);
        // New
        //$templates[] = SINGLE_PATH . "single-{$object->post_type}-{$object->post_name}.php";
        // Like in core
        if (isset($object->post_type)) {
            $templates[] = SINGLE_PATH . "single-{$object->post_type}.php";
        }
        $templates[] = SINGLE_PATH . "single.php";
        return locate_template($templates);
    }

    public function oc_single_template_controller($single_template)
    {
        global $wp_query, $post;
        /**
         * Checks for single template by ID
         */
        /* if (file_exists(SINGLE_PATH . 'single-' . $post->ID . '.php'))
             return SINGLE_PATH . 'single-' . $post->ID . '.php';*/
        if (isset($post)) {
            if ($post->post_type == HKMBASEMAP) {
                $single_template = SINGLE_PATH . 'single-cpmap.php';
                //   $single_template $single_template;
            } else {
                $single_template = SINGLE_PATH . 'single.php';
            }
            debugoc::upload_bmap_log(print_r($post, true), 50);
        }

        return $single_template;
    }


    public function login_redirect_f($redirect_to, $request, $user)
    {

        debugoc::upload_bmap_log("redirection:" . $redirect_to . ". request:" . $request . " and user: " . print_r($user, true), 50);
        //			$user = wp_get_current_user();
        //print_r('run line 43;');
        // print_r('run line is_user_logged_in;' . is_user_logged_in() . $user -> ID);
        if (!is_wp_error($user)) {
            if ($user->ID > 0) {
                // $userrole = get_user_by('id', $user -> ID);
                $rolelist = $user->roles;
                $part = "";
                if (count($rolelist) > 0) {
                    foreach ($rolelist as $key => $value) {
                        if (in_array($value, array_keys(self::$after_login_pages))) {
                            $part = self::$after_login_pages[$value];
                            break;
                        };
                    }
                    //   $redirect_to = get_bloginfo('url') . $part;
                }
                /**
                 * go to a url for this page
                 * $user_info = get_userdata($user->ID);
                 * if ($user_info->primary_blog) {
                 * $primary_url = get_blogaddress_by_id($user_info->primary_blog) . 'wp-admin/';
                 * if ($primary_url) {
                 * wp_redirect($primary_url);
                 * die();
                 * }
                 * }*/
            }
            return empty($part) ? $redirect_to : get_permalink($part);
        } else {
            // print_r($user);
            // echo "not login";
            // user is not found - so return back to the login screen
            return $redirect_to;
        }
      //  return empty($part) ? $redirect_to : get_permalink($part);
    }

    public static function un_loginpage()
    {
        ?>
        <a class="block_notice" href="<?php echo get_permalink(161); ?>">
            <div class="notice">I am a representative for OneCall affiliated company</div>
        </a>
        <a class="block_notice" href="<?php echo get_permalink(180); ?>">
            <div class="notice"> I am a first time representative from a company that is not affiliated to OneCall
            </div>
        </a>
        <a class="block_notice" href="<?php echo get_permalink(194); ?>">
            <div class="notice"> I am CP professional and I am looking for work.</div>
        </a>
        <a class="block_notice" href="<?php echo wp_login_url(); ?>">
            <div class="notice"> I am a member</div>
        </a>
    <?php
    }

    public static function un_login()
    {
        echo ocmodel::get_tpl('index', 'oc');
    }

// Show a different message to a logged-in user who can add posts.
    public static function in_login()
    {
        //get_template_part('page-template/cp','index');
        get_sidebar();
    }

    public static function action_get_content_from_editor()
    {
    }

    public static function in_loginpage()
    {
        /*
         ----
         debugoc::logarray('e %s',wp_get_current_user());
         $user = wp_get_current_user();
         $userrole = new WP_User($user->ID);
         debugoc::logarray('e %s',$userrole);
         ----
         */
        while (have_posts()) : the_post();
            get_template_part('content', 'page');
        endwhile;
    }

    /**
     * if the user is not login and the landing pages are not fallen into one the item in the list
     * @return bool
     */
    public static function system_pages_direct()
    {
        global $post;
        debugoc::upload_bmap_log("redirection action triggered", 50);
        if (!is_user_logged_in() && $post->ID == LAND_ADMIN) {
            wp_redirect(get_permalink(LAND_PUBLIC));
            //debugoc::logarray('e %s', wp_get_current_user());
            debugoc::upload_bmap_log("redirection action 1", 50);
            return FALSE;
        }
        if (!is_user_logged_in() && !in_array($post->ID, self::$public_pages)) {
            //if this is the private pages without user login
            auth_redirect();
            debugoc::upload_bmap_log("redirection action 2", 50);
            return FALSE;
            //redirect them to the login page
        }
    }
}