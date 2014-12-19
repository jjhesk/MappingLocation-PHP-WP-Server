<?php
defined('ABSPATH') || exit;
/**
 * Created by PhpStorm.
 * User: hesk
 * Date: 1/12/14
 * Time: 10:18 PM
 */
if (!class_exists('adminbar')):
    class adminbar
    {
        private $additional_explaination = "";

        public function __construct()
        {
            $this->init();
        }

        /**
         * for the office
         * @param $wp_admin_bar
         */
        public function application_approval($wp_admin_bar)
        {

            if (oc_db_account::has_role('administrator')) {
                $this->additional_explaination = "(office)";
            }
            $menu_id = 'system-approve';
            $node = array(
                'id' => $menu_id,
                'title' => 'Approves' . $this->additional_explaination,
                'href' => get_permalink(250),
                'meta' => array(
                    'class' => 'actionbar-class'
                )
            );
            $wp_admin_bar->add_node($node);
            //$action_url = admin_url('edit.php?post_type=occompany&page=approvals');
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'companyapp', // link ID, defaults to a sanitized title value
                'title' => __('New Company App'), // link title
                'href' => admin_url('edit.php?post_type=occompany&page=approvals'), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'crapp', // link ID, defaults to a sanitized title value
                'title' => __('New CR App'), // link title
                'href' => admin_url('users.php?page=crapprovals'), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'cpapp', // link ID, defaults to a sanitized title value
                'title' => __('New CP App'), // link title
                'href' => admin_url('users.php?page=cpapprovals'), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));


        }

        /**
         * for the office
         * @param $wp_admin_bar
         */
        public function work($wp_admin_bar)
        {

            if (oc_db_account::has_role('administrator')) {
                $this->additional_explaination = "(office)";
            }
            $menu_id = 'system-work';
            $node = array(
                'id' => $menu_id,
                'title' => 'Orders' . $this->additional_explaination,
                //  'href' => get_permalink(217),
                'meta' => array(
                    'class' => 'actionbar-class'
                )
            );
            $wp_admin_bar->add_node($node);
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'incomingorders', // link ID, defaults to a sanitized title value
                'title' => __('Incoming Orders'), // link title
                'href' => admin_url('admin.php?page=gf_entries&id=' . GF_SERVICE_ORDER_FORM), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'historyorders', // link ID, defaults to a sanitized title value
                'title' => __('Job History'), // link title
                'href' => admin_url('edit.php?post_type=oc-job'), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'staff_neworder', // link ID, defaults to a sanitized title value
                'title' => __('New Order by Phone Call'), // link title
                // 'href' => admin_url('media-new.php'), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'add_job', // link ID, defaults to a sanitized title value
                'title' => __('New Job Appointment'), // link title
                'href' => admin_url('post-new.php?post_type=oc-job'), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
        }

        /**
         * for the office
         * @param $wp_admin_bar
         */
        public function role_management($wp_admin_bar)
        {

            if (oc_db_account::has_role('administrator')) {
                $this->additional_explaination = "(office)";
            }
            $menu_id = 'staff-rolemanagement';
            $node = array(
                'id' => $menu_id,
                'title' => 'Roles' . $this->additional_explaination,
                //  'href' => get_permalink(217),
                'meta' => array(
                    'class' => 'actionbar-class'
                )
            );
            $wp_admin_bar->add_node($node);
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'view_all_cps', // link ID, defaults to a sanitized title value
                'title' => __('CR review'), // link title
                'href' => admin_url('users.php') . '?role=cr', // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'view_all_cr', // link ID, defaults to a sanitized title value
                'title' => __('CP review'), // link title
                'href' => admin_url('users.php') . '?role=cp',
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'view_all_staffs', // link ID, defaults to a sanitized title value
                'title' => __('Staff review'), // link titleocstaff
                'href' => admin_url('users.php') . '?role=ocstaff',
                // 'href' => admin_url('media-new.php'), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
        }

        /**
         * for the office
         * @param $wp_admin_bar
         */
        public function report_management($wp_admin_bar)
        {

            if (oc_db_account::has_role('administrator')) {
                $this->additional_explaination = "(office)";
            }
            $menu_id = 'staff-reports';
            $node = array(
                'id' => $menu_id,
                'title' => 'Report' . $this->additional_explaination,
                //  'href' => get_permalink(217),
                'meta' => array(
                    'class' => 'actionbar-class'
                )
            );
            $wp_admin_bar->add_node($node);
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'review_submitted_reports', // link ID, defaults to a sanitized title value
                'title' => __('Report Reviews'), // link title
                // 'href' => admin_url('media-new.php'), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'report_templates', // link ID, defaults to a sanitized title value
                'title' => __('Report Templates'), // link title
                // 'href' => admin_url('media-new.php'), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'basemapsreview', // link ID, defaults to a sanitized title value
                'title' => __('Base Map Review'), // link title
                // 'href' => admin_url('media-new.php'), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'evaluations', // link ID, defaults to a sanitized title value
                'title' => __('Evaluations'), // link title
                // 'href' => admin_url('media-new.php'), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
        }

        /**
         * company representatives
         * @param $wp_admin_bar
         */
        public function cr_menu($wp_admin_bar)
        {
            if (oc_db_account::has_role('administrator')) {
                $this->additional_explaination = "(CR)";
            }
            $menu_id = 'system-companyrep';
            $node = array(
                'id' => $menu_id,
                'title' => 'New Order' . $this->additional_explaination,

                'meta' => array(
                    'class' => 'actionbar-class'
                )
            );
            $wp_admin_bar->add_node($node);


            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'cr_neworder', // link ID, defaults to a sanitized title value
                'title' => __('Place a new order'), // link title
                'href' => get_permalink(542),
                // 'href' => admin_url('media-new.php'), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'cr_payment_subscription', // link ID, defaults to a sanitized title value
                'title' => __('Subscription'), // link title
                // 'href' => admin_url('media-new.php'), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'cr_development_record', // link ID, defaults to a sanitized title value
                'title' => __('Company Development Records'), // link title
                // 'href' => admin_url('media-new.php'), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
        }

        /**
         * for cp
         * @param $wp_admin_bar
         */
        public function cp_menu($wp_admin_bar)
        {
            if (oc_db_account::has_role('administrator')) {
                $this->additional_explaination = "(CP)";
            }

            $menu_id = 'system-cpmenu';
            $node = array(
                'id' => $menu_id,
                'title' => 'My Work' . $this->additional_explaination,
                'href' => get_permalink(217),
                'meta' => array(
                    'class' => 'actionbar-class'
                )
            );
            $wp_admin_bar->add_node($node);
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'myjob', // link ID, defaults to a sanitized title value
                'title' => __('Job History'), // link title
                // 'href' => admin_url('media-new.php'), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'mymarket', // link ID, defaults to a sanitized title value
                'title' => __('Market Place'), // link title
                'href' => admin_url('admin.php?page=joblisting'), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'myschedule', // link ID, defaults to a sanitized title value
                'title' => __('Job Schedule'), // link title
                'href' => admin_url('admin.php?page=successoffers'), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
            $wp_admin_bar->add_menu(array(
                'parent' => $menu_id, // use 'false' for a root menu, or pass the ID of the parent menu
                'id' => 'mystatus', // link ID, defaults to a sanitized title value
                'title' => __('My Professional Profile'), // link title
                // 'href' => admin_url('media-new.php'), // name of file
                'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
            ));
        }

        public function remove_wp_preset_buttons($wp_admin_bar)
        {
            /**
             * my-account – link to your account (avatars disabled)
             * my-account-with-avatar – link to your account (avatars enabled)
             * my-blogs – the “My Sites” menu if the user has more than one site
             * get-shortlink – provides a Shortlink to that page
             * edit – link to the Edit/Write-Post page
             * new-content – link to the “Add New” dropdown list
             * comments – link to the “Comments” dropdown
             * appearance – link to the “Appearance” dropdown
             * updates – the “Updates” dropdown
             */
            $wp_admin_bar->remove_node('wp-logo');
            $wp_admin_bar->remove_node('comments');
            if (!oc_db_account::has_role('administrator')) {
                $wp_admin_bar->remove_node('edit');
                $wp_admin_bar->remove_node('new-content');
            } else {
                $wp_admin_bar->remove_node('edit');
            }
        }


        public function init()
        {
            /**
             *
             * wp_admin_bar_wp_menu – 10
             * wp_admin_bar_my_sites_menu – 20
             * wp_admin_bar_site_menu – 30
             * wp_admin_bar_updates_menu – 40
             * wp_admin_bar_comments_menu – 60
             * wp_admin_bar_new_content_menu – 70
             * wp_admin_bar_edit_menu – 80
             */
            /**
             * development resources
             * @resource: http://digwp.com/2011/04/admin-bar-tricks/
             */


            if (oc_db_account::has_role(array('ocstaff', 'administrator'))) {
                add_action('admin_bar_menu', array($this, 'application_approval'), 81);
                add_action('admin_bar_menu', array($this, 'role_management'), 83);
                add_action('admin_bar_menu', array($this, 'work'), 82);
                add_action('admin_bar_menu', array($this, 'report_management'), 84);
            }
            if (oc_db_account::has_role(array('cp', 'administrator'))) {

                add_action('admin_bar_menu', array($this, 'cp_menu'), 85);
            }
            if (oc_db_account::has_role(array('cp', 'administrator'))) {
                //   add_action('admin_bar_menu', array($this, 'cp_menu'), 83);

            }
            if (oc_db_account::has_role(array('cr', 'administrator'))) {
                add_action('admin_bar_menu', array($this, 'cr_menu'), 89);
            }


            add_action('admin_bar_menu', array($this, 'remove_wp_preset_buttons'), 999);

            if (!current_user_can('manage_options')) {
                add_action('wp_dashboard_setup', array($this, 'removeDashboard'));
            }
        }


        public function removeDashboard()
        {

            global $wp_meta_boxes;

            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);


        }
        /*
                private $nodeHead, $pos = 81;

                public function adminbarmenu_add_menu($wp_admin_bar)
                {
                    $wp_admin_bar->add_node($this->nodeHead);
                }

                private function initConfig($args = array())
                {
                    add_action('admin_bar_menu', array(&$this, 'adminbarmenu_add_menu'), $this->pos);

                }

                public function addMenu($args = array())
                {
                  //  $menu = new self($args);
                    $this->pos++;
                }*/
    }
endif;