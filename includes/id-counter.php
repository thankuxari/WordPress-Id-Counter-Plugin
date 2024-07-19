<?php

    add_shortcode('counter','display_database_data');

    add_action('rest_api_init','create_rest_endpoint');

    function display_database_data(){
        
        global $wpdb;

        $table_name = $wpdb->prefix . 'customers';

        $result_data = $wpdb->get_results( "SELECT * FROM $table_name");


        foreach($result_data as $data){
            echo '<p>' . $data -> Name . '</p>';
            echo '<p>' . $data -> Lastname . '</p>';
            echo '<button>' . '+' . '</button>';
            echo '<p class="'. ($data -> id == 2 ? 'testclass' : '').'">' . $data -> id .'</p>';
            echo '<button>' . '-' . '</button>';
        }

    }

    function create_rest_endpoint(){

        register_rest_route('/v1/custom','/updateId',array(
            'method' => 'POST',
            'callback' => 'handle_update_id_api',
            'permission_callback' => '__return_true'
        ));
    }

    
    ?>
    <style>
        .testclass{
            color:blue;
            font-size:2rem;
        }
    </style>