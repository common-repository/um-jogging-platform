<?php 

class UMJP_cron_events{

    function __construct() {

        update_option('umjp_currentMonth', date('m'));
        $this->setupChron();
        add_action('umjp_cron_logic', array(&$this, 'monthly_logic'));

    }


    function setupChron() {

        if(!wp_next_scheduled('umjp_cron_logic')){

            wp_schedule_event( time() , 'daily',  'umjp_cron_logic');
        }
    }


    function monthly_logic() {

        $date = date('m');

    if ($date == get_option('umjp_currentMonth')) {
        return;
    }

    // all functions from here are executed monthly:
    global $umjp_master;
    $umjp_master->leaderboards->umjp_rewardLeaders();
    $umjp_master->profileBadges->individual_quantity();
    $umjp_master->profileBadges->individual_distance();
    $umjp_master->profileBadges->individual_time();
    
    update_option('umjp_currentMonth', date('m'));

    }



}