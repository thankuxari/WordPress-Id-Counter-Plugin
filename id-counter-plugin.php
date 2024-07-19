<?php

/**
 * Plugin Name: ID Counter Plugin
 * Plugin URI:  https://idCounter.com/plugin-wp
 * Author:      Konstantinos Charitos
 * Author URI:  Plugin Author Link
 * Description: Id Counter for WordPress
 * Version:     0.1.0
 * License:     GPL-2.0+
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: prefix-plugin-name
*/

    if(!defined('ABSPATH')) die('You are not supposed to be here');

    if(!class_exists('idCounter')){
        
        class idCounter{

            public function __construct(){

                define('ID_COUNTER_WP_FILE',__FILE__);

                define('ID_COUNTER_WP_DIR_FILE',dirname(ID_COUNTER_WP_FILE));
        
            }

            public function initialize(){
                include_once(ID_COUNTER_WP_DIR_FILE . '/includes/options-id-counter.php');
                include_once(ID_COUNTER_WP_DIR_FILE . '/includes/id-counter.php');
            }
        }
    }

    $init  = new idCounter();
    $init -> initialize();
