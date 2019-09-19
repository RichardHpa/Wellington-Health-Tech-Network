<?php
function customThemeEnqueues(){
    wp_enqueue_style('bootstrapStyle', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.3.1', 'all');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/fontawesome/css/all.min.css', array(), '5.10.2', 'all' );
    wp_enqueue_style('customStyle', get_template_directory_uri() . '/assets/css/style.min.css', array(), '1.0.0', 'all');

    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrapScript', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.3.1', true);
    wp_enqueue_script('customScript', get_template_directory_uri() . '/assets/js/front/script.min.js', array('jquery'), '1.0.0', true);
    wp_localize_script('customScript', 'local_values', array(
        'duration'=> get_theme_mod('whtn_slide_speed_setting', 3)
    ));
}
add_action('wp_enqueue_scripts', 'customThemeEnqueues', 11);

function admin_my_enqueue(){

    wp_enqueue_script('momentScript', get_template_directory_uri() . '/assets/js/moment.js', array(), '1.0.0', true);

    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/fontawesome/css/all.min.css', array(), '5.10.2', 'all' );

    wp_enqueue_style('datePickerStyle', get_template_directory_uri() . '/assets/datepicker/datetimepicker.css', array(), '1.0.0', 'all');
    wp_enqueue_script('datePickerScript', get_template_directory_uri() . '/assets/datepicker/datetimepicker.js', array(), '1.0.0', true);

    wp_enqueue_style('adminStyle', get_template_directory_uri() . '/assets/css/admin.min.css', array(), '1.0.2', 'all');
    wp_enqueue_style('adminJqueryUIStyle', get_template_directory_uri() . '/assets/css/jquery-ui.min.css', array(), '1.12.1', 'all');

    wp_enqueue_script('adminJqueryUIScript', get_template_directory_uri() . '/assets/js/jquery-ui.min.js', array(), '1.12.1', true);
    wp_enqueue_script('adminScript', get_template_directory_uri() . '/assets/js/admin/admin.min.js', array(), '1.0.2', true);

    $options = get_option( 'apikey_options' );
    wp_enqueue_script( 'google_js', 'https://maps.googleapis.com/maps/api/js?v=3.exp&key='.$options['apikey_field_google'].'&libraries=places', array(), '', true );

    wp_localize_script('adminScript', 'variables', array(
        'eventBriteKey' => $options['apikey_field_eventBrite'],
    ));
}
add_action('admin_enqueue_scripts', 'admin_my_enqueue');

require_once get_template_directory() . '/inc/theme_support.php';

require_once get_template_directory() . '/inc/customizer.php';

require_once get_template_directory() . '/inc/disable_gutenberg.php';

require_once get_template_directory() . '/inc/remove_comements.php';

require_once get_template_directory() . '/inc/custom_settings.php';

require_once get_template_directory() . '/inc/custom_post_types.php';

require_once get_template_directory() . '/inc/custom-fields.php';

require_once get_parent_theme_file_path('/inc/walkers/class-wp-dropdown-child.php');
