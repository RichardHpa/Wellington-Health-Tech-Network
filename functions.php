<?php

flush_rewrite_rules( false );

/*
    Adding Style and Script files into the theme
*/
function customThemeEnqueues(){
    wp_enqueue_script('jquery');

    wp_enqueue_style('masterStyle', get_template_directory_uri() . '/assets/css/front/style.css', array(), '0.0.1', 'all');

    wp_enqueue_script('customScript', get_template_directory_uri() . '/assets/js/script.js', array(), '1.0.0', true);

}
add_action('wp_enqueue_scripts', 'customThemeEnqueues');

/*
    Adding style and script files into the admin for the theme
*/
function admin_my_enqueue() {
    wp_enqueue_style('adminStyle', get_template_directory_uri() . '/assets/css/admin.css', array(), '1.0.0', 'all');
    wp_enqueue_script('adminScript', get_template_directory_uri() . '/assets/js/admin.js', array(), '1.0.0', true);
}
add_action('admin_enqueue_scripts', 'admin_my_enqueue');
