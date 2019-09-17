<?php
function customThemeEnqueues(){
    wp_enqueue_style('bootstrapStyle', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.3.1', 'all');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css', array(), '4.7.0', 'all' );
    wp_enqueue_style('customStyle', get_template_directory_uri() . '/assets/css/style.min.css', array(), '1.0.0', 'all');

    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrapScript', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.3.1', true);
    wp_enqueue_script('customScript', get_template_directory_uri() . '/assets/js/front/script.min.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'customThemeEnqueues', 11);

function admin_my_enqueue(){
    wp_enqueue_style('adminStyle', get_template_directory_uri() . '/assets/css/admin.min.css', array(), '1.0.2', 'all');
    wp_enqueue_style('adminJqueryUIStyle', get_template_directory_uri() . '/assets/css/jquery-ui.min.css', array(), '1.12.1', 'all');
    wp_enqueue_script('adminJqueryUIScript', get_template_directory_uri() . '/assets/js/jquery-ui.min.js', array(), '1.12.1', true);
    wp_enqueue_script('my_custom_script', get_template_directory_uri() . '/assets/js/admin/admin.min.js', array(), '1.0.2', true);
}
add_action('admin_enqueue_scripts', 'admin_my_enqueue');

require_once get_template_directory() . '/inc/theme_support.php';

require_once get_template_directory() . '/inc/customizer.php';
