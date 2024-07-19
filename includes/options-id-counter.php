<?php

    if(!defined('WPINC')) die('You shouldnt be here');

    
    if(!class_exists('optionsIDCounter')){
        
        class optionsIDCounter{
            
            public function __construct()
            {
                add_action('init',array($this,'create_post_type'));
            }

            public function create_post_type(){
                $args = [
                    'label' => 'optionsIDCounter',
                    'description' => 'Test Plugin ID Counter For WordPress',
                    'has_archive' => true,
                    'public' => true,
                    'show_ui' => true,
                    'menu_icon' => 'dashicons-insert', 
                ];

                register_post_type('optionsIDCounter',$args);
            }
        }
    }

    $init = new optionsIDCounter();

