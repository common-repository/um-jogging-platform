<?php

class UMJP_Leaderboards {

    private $rewards = false;

    function __construct(){

        add_shortcode( 'umjp-Leaderboards', array(&$this, 'render'));

    }


    function render(){

        wp_enqueue_style( 'umjp-leaderboards.css' , umjp_CSS . 'umjp-leaderboards.css' );

        ob_start();

        umjp_render_template('umjp-leaderboards-template');

        return ob_get_clean();

    }

// collects data from all different comparesdates parameter is a boolean which determines if
// the ID's are names (true) of numbers (false);
    function get_Leaderboards_data ($rawData){
        
       $leaderBoardData = array(
           "most_runs"      => $this->most_Runs_data(),
           "most_Km"        => $this->total_Km_data(),
           "fastest3_5"     => $this->best_speed_data(3, 4.99),
           "fastest5_8"     => $this->best_speed_data(5, 7.99),
           "fastest8_12"    => $this->best_speed_data(8, 11.99),
           "fastest12_plus" => $this->best_speed_data(12, 100)
       );

       if($rawData){
           return $leaderBoardData;
       }

// This loop replaces all the number ID's with the display_name properties of the wp_users table
       foreach ($leaderBoardData as $typeStat => $value){
           foreach($leaderBoardData[$typeStat] as $timeWindow => $value){
               for($x = 0; $x < 5; $x++){
                if(!isset($leaderBoardData[$typeStat][$timeWindow][$x])){
                    continue;
                }
                $ID = $leaderBoardData[$typeStat][$timeWindow][$x]->user_id;

                $user =  get_userdata($ID);

                if(!isset($user->data->display_name)){
                    continue;
                }
 
                $leaderBoardData[$typeStat][$timeWindow][$x]->user_id = $user->data->display_name;
               }
            }    
        }

       return $leaderBoardData;

    }



    function get_compareDates(){
// array with times for leaderboards
        if(!$this->rewards){
            return array(
                "refDate10" => date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-10 day" )),
                "refDate100" => date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-100 day" )),
                "refDateYear" => date('Y-m-d', strtotime(date('Y-01-01'))),
                "refDateMonth" => date('Y-m-d', strtotime(date('Y-m-01')))
                 );
        }
// this array is needed for rewards, since the monthly chron events fire the moment someone logs in after a new month.
// The above array would not yield any data because it would gather data from the current new month.
        if($this->rewards){
            return array(
                "refDate10" => date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-10 day" )),
                "refDate100" => date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-100 day" )),
                "refDateYear" => date('Y-m-d', strtotime(date('Y-01-01'))),
                "refDateMonth" => date("Y-m-d", strtotime("first day of previous month"))
                 );
        }
    }




// returns array with 4 arrays (based on 4 dates) which hold the sorted data of most runs
    function most_Runs_data (){

        global $wpdb;
        $table_name = $wpdb->prefix . 'jogging_data';
        $results = array();
        $compareDates = $this->get_compareDates();

        foreach ($compareDates as $key => $value){

            $sql = $wpdb->prepare(
                "   SELECT user_id, COUNT(*) AS cnt
                    FROM $table_name
                    WHERE dates >= DATE(%s)
                    GROUP BY user_id
                    ORDER BY COUNT(*) DESC
                    LIMIT 25;" , $value
            );

            $amountRuns = $wpdb->get_results($sql);

            $results[$key] = $amountRuns;
    
        }

            foreach ($compareDates as $key => $value){
                usort($results[$key], array($this,"sort_Amount"));
            }

            return $results;
    }

    function sort_Amount($a, $b){

        if($a->cnt > $b->cnt){
            return -1;
        }
        elseif ($a->cnt < $b->cnt){
            return 1;
        }

        $aa =  get_user_meta( $a->user_id, 'umjp-points', true );
        $bb =  get_user_meta( $b->user_id, 'umjp-points', true );

        if($aa > $bb){
            return -1;
        }
        elseif($bb > $aa){
            return 1;
        }
        return 0;
    }



// returns array with 4 arrays (based on 4 dates) which hold the sorted data of most Km
    function total_Km_data(){

        global $wpdb;
        $table_name = $wpdb->prefix . 'jogging_data';
        $results = array();
        $compareDates = $this->get_compareDates();

        foreach ($compareDates as $key => $value) {

            $sql = $wpdb->prepare(
                "   SELECT SUM(distance) as totalKm, user_id
                    FROM $table_name
                    WHERE dates >= DATE(%s)
                    GROUP BY user_id
                    ORDER BY totalKm desc
                    LIMIT 25;" , $value
            );

            $amountRuns = $wpdb->get_results($sql);

            $results[$key] = $amountRuns;
        }

        foreach ($compareDates as $key => $value){
            usort($results[$key], array($this, "sort_totalKm"));
        }
        return $results;
    }


    function sort_totalKm($a, $b) {

        if ($a->totalKm > $b->totalKm) {
            return -1;
        }
        elseif ($a->totalKm < $b->totalKm){
            return 1;
        }

        $aa =  get_user_meta( $a->user_id, 'umjp-points', true );
        $bb =  get_user_meta( $b->user_id, 'umjp-points', true );

        if ($aa > $bb) {
            return -1;
        }
        elseif ($bb > $aa) {
            return 1;
        }
        return 0;
    }

  
// returns array with 4 arrays (based on 4 dates) which hold the sorted data of most Km
    function best_speed_data($distance1, $distance2) {

        global $wpdb;
        $table_name = $wpdb->prefix . 'jogging_data';
        $results = array();
        $compareDates = $this->get_compareDates();

        foreach ($compareDates as $key => $value) {

            $sql = $wpdb->prepare(
                "   SELECT MAX(distance /timeMin *60) AS maxSpeed, user_id 
                    FROM wp_jogging_data
                    WHERE distance >=%d AND distance <=%d
                    AND dates >= DATE(%s)
                    GROUP BY user_id
                    LIMIT 25;", $distance1, $distance2, $value
            );

            $amountRuns = $wpdb->get_results($sql);

            $results[$key] = $amountRuns;
        }


        foreach ($compareDates as $key => $value) {
            usort($results[$key], array($this, 'sort_fastestSpeed'));
        }

        return $results;

    }


// sort function of the best_speed_data function
    function sort_fastestSpeed($a, $b) {

        if($a->maxSpeed > $b->maxSpeed) {
            return -1;
        }
        elseif ($a->maxSpeed < $b->maxSpeed){
            return 1;
        }

        $aa =  get_user_meta( $a->user_id, 'umjp-points', true );
        $bb =  get_user_meta( $b->user_id, 'umjp-points', true );

        if ($aa > $bb) {
            return -1;
        }
        elseif ($bb > $aa) {
            return 1;
        }
        return 0;
    }


// This function is executed monthly (in cron-events.php) and rewards top players with score:
// Players get rewarded 50,25,10 points if they are the top players in the end of the month

/* badges are awarded also
The following are user meta properties in 3 variants (bronze, silver, gold) they are named:

"most_runs" 
"most_Km"        
"fastest3_5"     
"fastest5_8"     
"fastest8_12"    
"fastest12_plus"

And they have the postfix _1, _2, _3 for their respective places.
*/

    function umjp_rewardLeaders(){

        $points = array(50, 25 ,10);

        $this->rewards = true;

        $leaderData = $this->get_Leaderboards_data(true);

        foreach ($leaderData as $key => $value) {
            for ($i = 0;  $i<3 ; $i++ ) {
                if (!isset($leaderData[$key]['refDateMonth'][$i]->user_id)) {
                    continue;
                }
                $id = $leaderData[$key]['refDateMonth'][$i]->user_id;
                $currentPoints = get_user_meta($id, 'umjp-points', true);
                update_user_meta( $id, 'umjp-points', ($currentPoints + $points[$i]));                 
                 
                $currentScore = get_user_meta($id, $key . '_' . ($i+1) , true);
                update_user_meta( $id, $key . '_' . ($i+1), ($currentScore + 1)); 
            }        
        }
    }






}



