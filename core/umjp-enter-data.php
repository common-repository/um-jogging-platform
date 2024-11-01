<?php
 
class UMJP_enter_data{

    function __construct() {
        add_action('um_profile_content_jogging_data', array(&$this,'um_profile_content_jogging_data'));
        add_action('init','umjp_update_users_data');
        add_action('init', array(&$this, 'update_data'));
    }

    function um_profile_content_jogging_data () {
        umjp_render_template('umjp-enter-data-template');
        wp_enqueue_style( 'umjp-enter-data.css' , umjp_CSS . 'umjp-enter-data.css' );
    }


    function update_data () {

        // checks if there is a submitted post
        if (!array_key_exists('enter__distance', $_POST)) {
            return;
        }

        if(!array_key_exists('date', $_POST)) {
            return;
        }

        if(!array_key_exists('time', $_POST)) {
            return;
        }

        $enter__distance = floatval($_POST['enter__distance']);
        $time            = floatval($_POST['time']);
        $date            = substr($_POST['date'], 0, 10);

        $year = (int) substr($_POST['date'], 0, 4);
        $month= (int) substr($_POST['date'], 5, 7);
        $day  = (int) substr($_POST['date'], 8, 10);

        if (!checkdate( $month, $day, $year)) {
           exit;
        }

        // backend check if all fields are filled in
        if (!$enter__distance || !$time  || !$date ) {
            return;
        }
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'jogging_data';
        $data = array(
            'distance' => $enter__distance,
            'timeMin' => $time,
            'dates' => $date,
            'user_id' => wp_get_current_user()->ID
        );


        $updated = $wpdb->insert($table_name, $data);

        $currentPoints = get_user_meta(get_current_user_id(), 'umjp-points', true);
        update_user_meta( get_current_user_id(), 'umjp-points', ($currentPoints + 5 + round($enter__distance)));

        wp_redirect( get_site_url().'/user/'. wp_get_current_user()->user_login .'/?profiletab=jogging' );
        exit;
    }

}
