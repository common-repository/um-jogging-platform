<?php

class UMJP_Deactivate {

    function __construct () {

        $this->deactivate();
    }


    function deactivate () {
        
        $ID = get_page_by_title('Leaderboards')->ID;
        wp_delete_post($ID);

        wp_clear_scheduled_hook( 'umjp_cron_logic' );
    }





}

