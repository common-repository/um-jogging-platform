<?php

// Setting up main tab on the profile page (next to about/posts/comments)
class UMJP_maintab {

    function __construct(){
        add_filter('um_profile_tabs', array(&$this,'add_tab'), 1001 ); 
    }
    

        function add_tab( $tabs ) { 

                $tabs['jogging'] = array(
                'name' =>'jogging',
                'icon' => 'um-faicon-group',
                'custom' => true,
            );

            $user_id = um_get_requested_user();
            
            if(is_user_logged_in() && get_current_user_id() == $user_id){
                $tabs['jogging']['subnav'] = array(
                    'profile' =>'Profile',
                    'data' => 'Enter data',
                    'progress' => 'Progress',
                    'advice' => 'Advice',
                );
                $tabs['jogging']['subnav_default'] =  'profile';
            } 
           return $tabs; 
       }



   

}












