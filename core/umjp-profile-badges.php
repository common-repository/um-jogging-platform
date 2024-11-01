<?php

class UMJP_profileBadges {

    function __construct(){

    }


// returns badges, which are declared in leaderboards.php and in this class (badges are in the user meta)
    function getBadges($type, $place){

        $amount = get_user_meta(um_profile_id(), $type . '_' . $place , true);

        if(!$amount){
            return 0;
        }

        return $amount;

    }


// Following three function are called monthly (in cron-events) 
// and gives people bagdes based on individual performance
    function individual_quantity(){

        $arrayUsers = get_users();
        global $wpdb; 
        $table_name = $wpdb->prefix . 'jogging_data';
        $refDate = date("Y-m-d", strtotime("first day of previous month"));

        foreach ($arrayUsers as $key => $value) {

            $user_id = $value->ID;

            $sql = $wpdb->prepare(
                "   SELECT user_id, COUNT(*) AS cnt
                    FROM $table_name
                    WHERE user_id = %d AND 
					dates >= DATE(%s)
                    GROUP BY user_id;" , $user_id, $refDate
            );
            
			$amountRuns = $wpdb->get_results($sql);

            if(!isset($amountRuns[0]->cnt)){
                continue;   
            }

            $amount = $amountRuns[0]->cnt;

            if($amount >= 8){
                $currentBadges = get_user_meta($user_id, 'umjp_IQ_1', true);
                update_user_meta($user_id, 'umjp_IQ_1', ($currentBadges+1));
                return;
            }elseif($amount >= 5){
                $currentBadges = get_user_meta($user_id, 'umjp_IQ_2', true);
                update_user_meta($user_id, 'umjp_IQ_2', ($currentBadges+1));
                return;                
            }elseif($amount >= 2){
                $currentBadges = get_user_meta($user_id, 'umjp_IQ_3', true);
                update_user_meta($user_id, 'umjp_IQ_3', ($currentBadges+1));
                return; 
            }
            return;

        }
    }

    function individual_distance(){

        $arrayUsers = get_users();
        global $wpdb; 
        $table_name = $wpdb->prefix . 'jogging_data';
        $refDate = date("Y-m-d", strtotime("first day of previous month"));

        foreach ($arrayUsers as $key => $value) {

            $user_id = $value->ID;

            $sql = $wpdb->prepare(
                "   SELECT user_id, SUM(distance) AS cnt
                    FROM $table_name
                    WHERE user_id = %d AND 
					dates >= DATE(%s)
                    GROUP BY user_id;" , $user_id, $refDate
			);			

            $totalKm = $wpdb->get_results($sql);

            if(!isset($totalKm[0]->cnt)){
                continue;   
            }           
            
            $totalKms = $totalKm[0]->cnt;

            if($totalKms >= 75){
                $currentBadges = get_user_meta($user_id, 'umjp_ID_1', true);
                update_user_meta($user_id, 'umjp_ID_1', ($currentBadges+1));
                return;
            }elseif($totalKms >= 30){
                $currentBadges = get_user_meta($user_id, 'umjp_ID_2', true);
                update_user_meta($user_id, 'umjp_ID_2', ($currentBadges+1));
                return;                
            }elseif($totalKms >= 10){
                $currentBadges = get_user_meta($user_id, 'umjp_ID_3', true);
                update_user_meta($user_id, 'umjp_ID_3', ($currentBadges+1));
                return; 
            }
            return;

        }
    }

    function individual_time(){

        $arrayUsers = get_users();
        global $wpdb; 
        $table_name = $wpdb->prefix . 'jogging_data';
        $refDate = date("Y-m-d", strtotime("first day of previous month"));

        foreach ($arrayUsers as $key => $value) {

            $user_id = $value->ID;

            $sql = $wpdb->prepare(
                "   SELECT user_id, SUM(timeMin) AS cnt
                    FROM $table_name
                    WHERE user_id = %d  AND 
					dates >= DATE(%s)					
                    GROUP BY user_id;" , $user_id, $refDate
			);			

			$totalMin = $wpdb->get_results($sql);

            if(!isset($totalMin[0]->cnt)){
                continue;   
            }           
            
            $totalMins = $totalMin[0]->cnt;

            if($totalMins >= 480){
                $currentBadges = get_user_meta($user_id, 'umjp_IT_1', true);
                update_user_meta($user_id, 'umjp_IT_1', ($currentBadges+1));
                return;
            }elseif($totalMins >= 300){
                $currentBadges = get_user_meta($user_id, 'umjp_IT_2', true);
                update_user_meta($user_id, 'umjp_IT_2', ($currentBadges+1));
                return;                
            }elseif($totalMins >= 120){
                $currentBadges = get_user_meta($user_id, 'umjp_IT_3', true);
                update_user_meta($user_id, 'umjp_IT_3', ($currentBadges+1));
                return; 
            }
            return;
        }
    }




}