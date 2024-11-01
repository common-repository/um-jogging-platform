<?php

class UMJP_Progress{

    function __construct(){
        add_action( 'um_profile_content_jogging_progress', array(&$this,'show_progress'));
        add_action( 'wp_ajax_deleteData', array(&$this, 'my_ajax_deleteData_handler'));
    }


    function show_progress () {

        if (array_key_exists('amount', $_POST)) {
            umjp_render_template('umjp-progress-chart-template');
        }

        umjp_render_template('umjp-progress-template');
        wp_enqueue_style( 'umjp-progress.css' , umjp_CSS . 'umjp-progress.css' );
    }

// Depending on if the user filled in 1,2 or all fields the typeofrequest string will change and dynamically
// give different data from the DB which is used in the to form the chart.
    function get_data() {
        
        $typeofRequest = 'Default';

        $amount = sanitize_key($_POST['amount']);

        if (array_key_exists('firstDate', $_POST)) {
            $firstDate = sanitize_key($_POST['firstDate']);
        }

        if (array_key_exists('compareDate', $_POST)) {
            $compareDate = sanitize_key($_POST['compareDate']);
        }

        if (!is_numeric($amount)) {
            exit('amount is not numeric');
        }


        if (($firstDate)) {
            $this->checkdates($firstDate);
            $typeofRequest = 'onlyDate';
        }

        if (($firstDate) && ($compareDate)) {
            $this->checkdates($compareDate);
            $typeofRequest = 'compareDate';
        }        
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'jogging_data';
        $refDate = $firstDate;
        $user_id = wp_get_current_user()->ID;
        $results2 = null;
     

        if($typeofRequest == 'Default' && $typeofRequest != 'onlyDate') {
            $sql = $wpdb->prepare("SELECT * FROM $table_name 
            WHERE user_id=%d ORDER BY dates desc limit %d;",
            $user_id, $amount);
            $results1 = $wpdb->get_results($sql);

            $results1 = array_reverse($results1);
        }

        if($typeofRequest == 'onlyDate' || $typeofRequest == 'compareDate') {
            $sql1 = $wpdb->prepare(
                "SELECT * FROM $table_name WHERE user_id=%d
                 AND dates >= DATE(%s) ORDER BY dates ASC limit %d;",
                 $user_id, $refDate, $amount
            );
            $results1 = $wpdb->get_results($sql1);
        }


        if($typeofRequest == 'compareDate') {
               $sql2 = $wpdb->prepare(
                     "SELECT * FROM $table_name WHERE user_id=%d
                      AND dates >= DATE(%s) ORDER BY dates ASC limit %d;",
                      $user_id, $compareDate, $amount
               );
                $results2 = $wpdb->get_results($sql2);
            }


            
        if($results2){
            $combinedRes = array($results1, $results2);
            return $combinedRes;
        }
        return array($results1);

    }


    function checkdates ($date) {

        $year = (int) substr($date, 0, 4);
        $month= (int) substr($date, 5, 7);
        $day  = (int) substr($date, 8, 10);
    
        if (!checkdate( $month, $day, $year)) {
            exit;
        }
    }


    function my_ajax_deleteData_handler () {

        $id = wp_get_current_user()->ID;
        $time = (int) sanitize_key($_POST['umjp_time']);
        $date = sanitize_key($_POST['umjp_date']);

        if( $id == 0) {
            wp_die();
        }

        global $wpdb;
        $table_name = $wpdb->prefix . 'jogging_data';

        $sql = $wpdb->prepare("DELETE FROM $table_name WHERE timeMin = %d AND user_id = %d
        AND dates = DATE(%s);",  $time, $id, $date);

        $wpdb->query($sql);

        wp_die();
    }
    


}


