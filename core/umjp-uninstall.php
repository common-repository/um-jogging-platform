<?php

class UMJP_uninstall {

    function __construct () {
        $this->deletePlugin();
    }

    function add_menu() {
        add_submenu_page(
            'ultimatemember',
            'Uninstall UMJP',                       // page title
            'Uninstall UMJP',                       // menu title
            'delete_plugins',                       // capability
            'uninstall',                            // menu slug
            array(&$this, 'umjp_uninstall_render')  // callback function,   
        );
    }

    function umjp_uninstall_render() {
        wp_enqueue_style( 'umjp-uninstall.css' , umjp_CSS . 'umjp-uninstall.css' );
        umjp_render_template('umjp-uninstall-template');
    }


    function deletePlugin() {

        if (!array_key_exists('UMJP_Uninstall', $_POST)) {
            return;
        }

        if ( !current_user_can('activate_plugins')) {
            return;
        }

        delete_option( 'umjp_currentMonth' );

        wp_clear_scheduled_hook('umjp_cron_logic');

        global $wpdb;
        $wpdb->query( "DROP TABLE IF EXISTS wp_jogging_data" );

        $users = get_users();

        foreach ($users as $user) {

            $id = $user->ID;

            delete_user_meta($id, 'umjp-points');
            delete_user_meta($id, 'aob');
            delete_user_meta($id, 'gender');
            delete_user_meta($id, 'umjp_IQ_1');
            delete_user_meta($id, 'umjp_IQ_2');
            delete_user_meta($id, 'umjp_IQ_3');
            delete_user_meta($id, 'umjp_ID_1');
            delete_user_meta($id, 'umjp_ID_2');
            delete_user_meta($id, 'umjp_ID_3');
            delete_user_meta($id, 'umjp_IT_1');
            delete_user_meta($id, 'umjp_IT_2');
            delete_user_meta($id, 'umjp_IT_3');

            delete_user_meta($id, 'most_runs_1');
            delete_user_meta($id, 'most_runs_2');
            delete_user_meta($id, 'most_runs_3');
            delete_user_meta($id, 'most_Km_1');
            delete_user_meta($id, 'most_Km_2');
            delete_user_meta($id, 'most_Km_3');
            delete_user_meta($id, 'fastest3_5_1');
            delete_user_meta($id, 'fastest3_5_2');
            delete_user_meta($id, 'fastest3_5_3');
            delete_user_meta($id, 'fastest5_8_1');
            delete_user_meta($id, 'fastest5_8_2');
            delete_user_meta($id, 'fastest5_8_3');
            delete_user_meta($id, 'fastest8_12_1');
            delete_user_meta($id, 'fastest8_12_2');
            delete_user_meta($id, 'fastest8_12_3');
            delete_user_meta($id, 'fastest12_plus_1');
            delete_user_meta($id, 'fastest12_plus_2');
            delete_user_meta($id, 'fastest12_plus_3');
        }

        $this->rrmdir(WP_PLUGIN_DIR . '/um-jogging-platform');

        wp_redirect( get_admin_url() . 'admin.php?page=ultimatemember' );
        exit;
    }


    function rrmdir($dir) { 
        if (is_dir($dir)) { 
          $objects = scandir($dir); 
          foreach ($objects as $object) { 
            if ($object != "." && $object != "..") { 
              if (is_dir($dir."/".$object))
                $this->rrmdir($dir."/".$object);
              else
                unlink($dir."/".$object); 
            } 
          }
          rmdir($dir); 
        } 
      }



}