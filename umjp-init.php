<?php

/*
Plugin Name: Ultimate member jogging platform
Plugin URI: http://ultimatemember.com/
Description: Jogging platform for Ultimate member
Version: 1.0.0
Author: RogierLankhorst, willemvanderveen
*/


defined( 'ABSPATH' ) or die( 'no access' );

register_activation_hook( __FILE__ , 'umjp_activate' );
register_deactivation_hook(__FILE__, 'umjp_deactivate');
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'umjp_add_action_links' );
add_action( 'admin_menu', 'umjp_uninstall' );

function umjp_activate () {  
    require_once 'core/umjp-database.php';
    require_once 'core/umjp-leaderboards-setup.php';
    require_once 'core/umjp-cron-events.php';

    $activate       = new UMJP_Database();
    $leaderboards   = new UMJP_leaderboards_setup();
    $cron           = new UMJP_cron_events();
}


function umjp_deactivate () {
    require_once 'core/umjp-deactivate.php';

    $deactivate = new umjp_deactivate();
}


function umjp_add_action_links ( $links ) {

    $mylinks = array(
    '<a href="' . admin_url( 'options-general.php?page=myplugin' ) . '" class="um-delete" title="'.__('Remove this plugin','ultimate-member').'">Uninstall</a>',
    );

    $links = array_merge( $links, $mylinks );

    return $links;

}


function umjp_uninstall() {
    require_once 'core/umjp-uninstall.php';

    $uninstall      = new UMJP_uninstall();
    $uninstall->add_menu();
}


class UMJP_master {

    public $maintab;
    public $profile;
    public $enterData;
    public $account;
    public $progress;
    public $leaderboards;
    public $profileBadges;
    public $advice;

    function __construct(){
        
        define("umjp_plugin", plugins_url().'/um-jogging-platform');
        define("umjp_CSS", umjp_plugin . '/assets/css/');
        define("umjp_js", umjp_plugin . '/assets/js/');
    
        require_once 'umjp-services.php';
    
        require_once 'core/umjp-maintab.php';
        require_once 'core/umjp-profile.php';
        require_once 'core/umjp-enter-data.php';
        require_once 'core/umjp-account.php';
        require_once 'core/umjp-progress.php';
        require_once 'core/umjp-leaderboards.php';
        require_once 'core/umjp-profile-badges.php';
        require_once 'core/umjp-advice.php';

        
        $this->maintab        = new UMJP_maintab();
        $this->profile        = new UMJP_profile();
        $this->enterData      = new UMJP_enter_data();  
        $this->account        = new UMJP_account();
        $this->progress       = new UMJP_progress();
        $this->leaderboards   = new UMJP_Leaderboards();
        $this->profileBadges  = new UMJP_profileBadges();
        $this->advice         = new UMJP_advice();
    }
    
}

global $umjp_master;
$umjp_master = new UMJP_master();
















