<?php

    add_shortcode('counter','display_database_data');

    add_action('rest_api_init','create_rest_endpoint');

    function display_database_data(){
        
        global $wpdb;

        $table_name = $wpdb->prefix . 'customers';

        $result_data = $wpdb->get_results( "SELECT * FROM $table_name");


        foreach($result_data as $data){
            echo '<p>' . esc_html($data -> Name) . '</p>';
            echo '<p>' . esc_html($data -> Lastname) . '</p>';
            echo '<button class="increase" data_id="'.esc_attr($data -> id).'">' . '+' . '</button>';
            echo '<p class="'. ($data -> id == 2 ? 'testclass' : '').'">' . $data -> id .'</p>';
            echo '<button class="decrease" data_id="'.esc_attr($data -> id).'">' . '-' . '</button>';
        }

    }

    function create_rest_endpoint(){

        register_rest_route('custom/v1','/updateId',array(
            'methods' => 'POST',
            'callback' => 'handle_update_id_api',
            'permission_callback' => '__return_true'
        ));
    }

    function handle_update_id_api(){

        global $wpdb

    }
    
    ?>

    <script>
        document.addEventListener('DOMContentLoaded',()=>{

            const buttons = document.querySelectorAll('button');

            buttons.forEach((button)=>{
                button.addEventListener('click',async ()=>{

                    const action = button.classList.contains('increase') ? 'increase' : 'decrease';

                    try {
                        const response = await fetch('<?php echo esc_url(get_rest_url(null, 'custom/v1/updateId')); ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-WP-Nonce': '<?php echo wp_create_nonce('wp_rest'); ?>'
                            },
                            body: JSON.stringify(action)
                        });

                        if(!response.ok) throw new Error('Error while fetching the data');

                        const data = await response.json();
                        console.log(data);
                    } catch (error) {
                        console.error(error);
                    }
                })
            })

        })
    </script>

    <style>
        .testclass{
            color:blue;
            font-size:2rem;
        }
    </style>