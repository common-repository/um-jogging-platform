<?php

class UMJP_profile{

	function __construct(){

		add_action('um_profile_content_jogging', array(&$this,'display_profile'));
		add_action('init', array(&$this,'starting_points'));

	}

	// displaying the profile on both main tab and profile subtab
	function display_profile(){
	
		global $ultimatemember;

		switch (get_query_var( 'subnav' )) {
			case 'progress':
				return;
			case 'advice':
				return;
			case 'data' :
				return;
		}

		umjp_render_template('umjp-profile-template');
		wp_enqueue_style( 'umjp-profile.css' , umjp_CSS . 'umjp-profile.css' );
		wp_enqueue_style( 'umjp-badgerly.css' , umjp_CSS . 'umjp-badgerly.css' );
	}


	// Giving every player a umjp-point in user meta-data, other functions might ask for this
	// so needs to be 0 at default.
	function starting_points(){

		$umjp_points = get_user_meta( get_current_user_id(), 'umjp-points', true );

		if (!is_numeric($umjp_points)) {
			update_user_meta( get_current_user_id(), 'umjp-points', 0);
		}
	}

//////////// All the following functions are needed for displaying data on the profile tab
	function getTotalPoints(){
		$currentPoints = get_user_meta(um_profile_id(), 'umjp-points', true);

		if (!$currentPoints) {
			return 0;
		}

		return $currentPoints;
	}
	

	function getTotalRuns(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'jogging_data';
		$user_id = um_profile_id();

            $sql = $wpdb->prepare(
                "   SELECT user_id, COUNT(*) AS cnt
                    FROM $table_name
                    WHERE user_id = %d
                    GROUP BY user_id;" , $user_id
			);			

			$amountRuns = $wpdb->get_results($sql);

			if (!$amountRuns) {
				return 0;
			}
			return $amountRuns[0]->cnt;
	}


	function getTotalKm(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'jogging_data';
		$user_id = um_profile_id();

            $sql = $wpdb->prepare(
                "   SELECT user_id, SUM(distance) AS cnt
                    FROM $table_name
                    WHERE user_id = %d 
                    GROUP BY user_id;" , $user_id
			);			

			$totalKm = $wpdb->get_results($sql);
			
			if(!$totalKm){
				return 0;
			}

			$totalKm = round($totalKm[0]->cnt); 

			return $totalKm;
	}


	function getTotalHours(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'jogging_data';
		$user_id = um_profile_id();

            $sql = $wpdb->prepare(
                "   SELECT user_id, SUM(timeMin) AS cnt
                    FROM $table_name
                    WHERE user_id = %d 
                    GROUP BY user_id;" , $user_id
			);			

			$totalMin = $wpdb->get_results($sql);	

			if(!$totalMin){
				return 0;
			}

			$totalHours = round($totalMin[0]->cnt / 60); 

			return $totalHours;
	}
	

/// Monthly ///////////////////////////////////////////////
	function getMonthPoint(){

		$points = round(($this->getMonthRuns() * 5) + ($this->getMonthKm()));

		return $points;
	}


	function getMonthRuns(){

		global $wpdb;
		$table_name = $wpdb->prefix . 'jogging_data';
		$user_id = um_profile_id();

		$refDate = $refDate =  date('Y-m-d', strtotime(date('Y-m-01')));
		
            $sql = $wpdb->prepare(
                "   SELECT user_id, COUNT(*) AS cnt
                    FROM $table_name
                    WHERE user_id = %d AND 
					dates >= DATE(%s)
                    GROUP BY user_id;" , $user_id, $refDate
			);			

			$amountRuns = $wpdb->get_results($sql);

			if (!$amountRuns) {
				return 0;
			}

			return $amountRuns[0]->cnt;
	}


	function getMonthKm(){

		global $wpdb;
		$table_name = $wpdb->prefix . 'jogging_data';
		$user_id = um_profile_id();
		$refDate = $refDate =  date('Y-m-d', strtotime(date('Y-m-01')));

            $sql = $wpdb->prepare(
                "   SELECT user_id, SUM(distance) AS cnt
                    FROM $table_name
                    WHERE user_id = %d AND 
					dates >= DATE(%s)
                    GROUP BY user_id;" , $user_id, $refDate
			);			

			$totalKm = $wpdb->get_results($sql);

			if (!$totalKm) {
				return 0;
			}

			$totalKm = round($totalKm[0]->cnt); 

			return $totalKm;
	}


	function getMonthHours(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'jogging_data';
		$user_id = um_profile_id();
		$refDate = $refDate =  date('Y-m-d', strtotime(date('Y-m-01')));

            $sql = $wpdb->prepare(
                "   SELECT user_id, SUM(timeMin) AS cnt
                    FROM $table_name
                    WHERE user_id = %d  AND 
					dates >= DATE(%s)					
                    GROUP BY user_id;" , $user_id, $refDate
			);			

			$totalMin = $wpdb->get_results($sql);
			
			if (!$totalMin) {
				return 0;
			}

			$totalHours = round($totalMin[0]->cnt / 60); 

			return $totalHours;
	}

// Last month ///////////////////////////////

function getLastMonthRuns(){

	global $wpdb;
	$table_name = $wpdb->prefix . 'jogging_data';
	$user_id = um_profile_id();

	$refDate1 = date('Y-m-d', strtotime(date('Y-m-01')));
	$refDate2 = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
	
		$sql = $wpdb->prepare(
			"   SELECT user_id, COUNT(*) AS cnt
				FROM $table_name
				WHERE user_id = %d AND 
				dates >= DATE(%s) AND
				dates < DATE(%s)
				GROUP BY user_id;" , $user_id, $refDate2, $refDate1
		);			

		$amountRuns = $wpdb->get_results($sql);

		if (!$amountRuns) {
			return 0;
		}

		return $amountRuns[0]->cnt;
}


function getLastMonthKm(){

	global $wpdb;
	$table_name = $wpdb->prefix . 'jogging_data';
	$user_id = um_profile_id();

	$refDate1 = date('Y-m-d', strtotime(date('Y-m-01')));
	$refDate2 = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));

		$sql = $wpdb->prepare(
			"   SELECT user_id, SUM(distance) AS cnt
				FROM $table_name
				WHERE user_id = %d AND 
				dates >= DATE(%s) AND
				dates < DATE(%s)
				GROUP BY user_id;" , $user_id,  $refDate2, $refDate1
		);			

		$totalKm = $wpdb->get_results($sql);

		if (!$totalKm) {
			return 0;
		}

		$totalKm = round($totalKm[0]->cnt); 

		return $totalKm;
}


function getLastMonthHours(){
	global $wpdb;
	$table_name = $wpdb->prefix . 'jogging_data';
	$user_id = um_profile_id();

	$refDate1 = date('Y-m-d', strtotime(date('Y-m-01')));
	$refDate2 = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));

		$sql = $wpdb->prepare(
			"   SELECT user_id, SUM(timeMin) AS cnt
				FROM $table_name
				WHERE user_id = %d  AND 
				dates >= DATE(%s) AND
				dates < DATE(%s)					
				GROUP BY user_id;" , $user_id,  $refDate2, $refDate1
		);			

		$totalMin = $wpdb->get_results($sql);
		
		if (!$totalMin) {
			return 0;
		}

		$totalHours = round($totalMin[0]->cnt / 60); 

		return $totalHours;
}


// This year /////////////////////////

function getYearRuns(){

	global $wpdb;
	$table_name = $wpdb->prefix . 'jogging_data';
	$user_id = um_profile_id();



	$refDate =  date('Y-m-d', strtotime(date('Y-01-01')));	
	
		$sql = $wpdb->prepare(
			"   SELECT user_id, COUNT(*) AS cnt
				FROM $table_name
				WHERE user_id = %d AND 
				dates >= DATE(%s)
				GROUP BY user_id;" , $user_id, $refDate
		);			

		$amountRuns = $wpdb->get_results($sql);

		if (!$amountRuns) {
			return 0;
		}

		return $amountRuns[0]->cnt;
}


function getYearKm(){

	global $wpdb;
	$table_name = $wpdb->prefix . 'jogging_data';
	$user_id = um_profile_id();
	$refDate =  date('Y-m-d', strtotime(date('Y-01-01')));	

		$sql = $wpdb->prepare(
			"   SELECT user_id, SUM(distance) AS cnt
				FROM $table_name
				WHERE user_id = %d AND 
				dates >= DATE(%s)
				GROUP BY user_id;" , $user_id, $refDate
		);			

		$totalKm = $wpdb->get_results($sql);

		if (!$totalKm) {
			return 0;
		}

		$totalKm = round($totalKm[0]->cnt); 

		return $totalKm;
}


function getYearHours(){

	global $wpdb;
	$table_name = $wpdb->prefix . 'jogging_data';
	$user_id = um_profile_id();
	$refDate =  date('Y-m-d', strtotime(date('Y-01-01')));	

		$sql = $wpdb->prepare(
			"   SELECT user_id, SUM(timeMin) AS cnt
				FROM $table_name
				WHERE user_id = %d  AND 
				dates >= DATE(%s)					
				GROUP BY user_id;" , $user_id, $refDate
		);			

		$totalMin = $wpdb->get_results($sql);
		
		if (!$totalMin) {
			return 0;
		}

		$totalHours = round($totalMin[0]->cnt / 60); 

		return $totalHours;
	}


}

