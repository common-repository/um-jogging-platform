<?php

class UMJP_account{

    function __construct(){
        add_action('um_submit_account_errors_hook','umjp_update_users_data');                
        add_action('um_after_account_general',array(&$this,'extend_account'));
    }  

    function extend_account(){ 
        umjp_render_template('umjp-account-template');
        wp_enqueue_style( 'enter-data.css' , umjp_CSS . 'enter-data.css' );  
    }


}





