<?php

class UMJP_Database {

    function __construct(){
        $this->create_table();
    }

    function create_table () {
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        global $wpdb;
        $table_name = $wpdb->prefix . "jogging_data"; 

        if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
            return;
        }
    
        
        $charset_collate = $wpdb->get_charset_collate();
    
        $sql = "CREATE TABLE $table_name (
      id mediumint(10) NOT NULL AUTO_INCREMENT,
      dates date,
      distance float(10),
      timeMin mediumint(10),
      user_id varchar(200),
      primary key (id)
    ) $charset_collate;";
                
        dbDelta( $sql );
    }


}

