<?php

function umjp_render_template ($template) {

        $file = plugin_dir_path(__FILE__) . 'templates/' . $template . '.php';
        
		$theme_file = get_stylesheet_directory() . '/ultimate-member/umjp/' . $template . '.php';

		if (file_exists($theme_file)) {
			$file = $theme_file;
		}

		if (file_exists($file)) {
			require $file;
        }
}



function umjp_update_users_data (){

    if (!array_key_exists('gender', $_POST)) {
        return;
    }

    if (!array_key_exists('aob', $_POST)) {
        return;
    }

    $gender = sanitize_key($_POST['gender']);
    $aob = substr($_POST['aob'], 0, 10);

    $year = (int) substr($_POST['aob'], 0, 4);
    $month= (int) substr($_POST['aob'], 5, 7);
    $day  = (int) substr($_POST['aob'], 8, 10);

    if (!checkdate( $month, $day, $year)) {
        exit;
    }
    
    update_user_meta( get_current_user_id(), 'gender', $gender);
    update_user_meta( get_current_user_id(), 'aob', $aob);
}




  

    
