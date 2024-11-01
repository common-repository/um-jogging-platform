<?php
 
class UMJP_Leaderboards_setup {

    function __construct() {

        $this->create_page();
    }

    function create_page(){

        if (get_page_by_title('Leaderboards')) {
            if (get_page_by_title('Leaderboards')->post_status == 'publish') {
                return;
            }
        }

        wp_insert_post(
            array(
                'post_content' => '[umjp-Leaderboards]',
                'post_title' => 'Leaderboards',
                'post_type' => 'Page',
                'post_name' =>  'Leaderboards'
            )
        );
        
        $ID = get_page_by_title('Leaderboards')->ID;
        wp_publish_post($ID);


    }

}

