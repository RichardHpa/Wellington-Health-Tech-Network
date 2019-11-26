<?php
// define(’WP_POST_REVISIONS’, false);

function customThemeEnqueues(){
    wp_enqueue_script('jquery');

    wp_enqueue_style('bootstrapStyle', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.3.1', 'all');
    wp_enqueue_script('popperjs', get_template_directory_uri() . '/assets/js/popper.min.js', array(), '1.0.0', true);
    wp_enqueue_script('bootstrapScript', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.3.1', true);

    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/fontawesome/css/all.min.css', array(), '5.10.2', 'all' );

    wp_enqueue_style('calendarPluginStyle', get_template_directory_uri() . '/assets/fullcalendar-4.3.1/packages/core/main.css', array(), '4.3.1', 'all');
    wp_enqueue_style('calendarPluginStyleDay', get_template_directory_uri() . '/assets/fullcalendar-4.3.1/packages/daygrid/main.css', array(), '4.3.1', 'all');
    wp_enqueue_style('calendarPluginStyleBootstrap', get_template_directory_uri() . '/assets/fullcalendar-4.3.1/packages/bootstrap/main.min.css', array(), '4.3.1', 'all');

    wp_enqueue_script('momentScript', get_template_directory_uri() . '/assets/js/moment.js', array(), '1.0.0', true);
    wp_enqueue_script('calendarPluginScript', get_template_directory_uri() . '/assets/fullcalendar-4.3.1/packages/core/main.min.js', array(), '4.3.1', true);
    wp_enqueue_script('calendarPluginScriptDay', get_template_directory_uri() . '/assets/fullcalendar-4.3.1/packages/daygrid/main.js', array(), '4.3.1', true);
    wp_enqueue_script('calendarPluginScriptBootstrap', get_template_directory_uri() . '/assets/fullcalendar-4.3.1/packages/bootstrap/main.min.js', array(), '4.3.1', true);


    $options = get_option( 'apikey_options' );
    wp_enqueue_script( 'google_js', 'https://maps.googleapis.com/maps/api/js?v=3.exp&key='.$options['apikey_field_google'].'&libraries=places', array(), '', true );

    wp_enqueue_script('icalScript', get_template_directory_uri() . '/assets/js/ics.min.js', array(), '1.0.0', true);

    wp_enqueue_style('customStyle', get_template_directory_uri() . '/assets/css/style.min.css', array(), '1.0.0', 'all');
    wp_enqueue_script('customScript', get_template_directory_uri() . '/assets/js/front/script.min.js', array('jquery'), '1.0.0', true);

    $today = date("Y/m/d");
    $args = array(
        'post_type' => 'event',
        'posts_per_page' => -1,
        'order'=> 'ASC',
        'orderby'=> 'meta_value',
        'meta_key'=> 'eventStartTime',
        'meta_query' => array(
            'key' => 'eventStartTime',
            'value' => $today,
            'compare' => '>=',
            'type' => 'date'
        )
    );
    $allEventPosts = new WP_Query($args);

    $allEvents = array();
    while ( $allEventPosts->have_posts() ) : $allEventPosts->the_post();
        $eventObj = new \stdClass;
        $eventObj->title = get_the_title();
        $eventObj->start = get_post_meta(get_the_ID(), 'eventStartTime', true);
        $eventObj->end = get_post_meta(get_the_ID(), 'eventEndTime', true);
        $eventObj->url = get_permalink();
        $eventObj->bio = get_post_meta(get_the_ID(), 'eventBio', true);
        array_push($allEvents, $eventObj);
    endwhile;

    wp_localize_script('customScript', 'local_values', array(
        'duration' => get_theme_mod('whtn_slide_speed_setting', 3),
        'events' => $allEvents,
        'themeColour' => get_theme_mod('whtn_button_colour_setting', '#3EA86F')
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

    $id = '';
    if (is_edit_page('new')){
        $type = 'new';
    } else {
        $type = 'edit';
        global $post;
        $id = $post->ID;
    }

    wp_localize_script('adminScript', 'variables', array(
        'eventBriteKey' => $options['apikey_field_eventBrite'],
        'pageType' => $type,
        'currentEventID' => get_post_meta($id, 'selectEvent', true)
    ));
}
add_action('admin_enqueue_scripts', 'admin_my_enqueue');

require_once get_template_directory() . '/inc/theme_support.php';

require_once get_template_directory() . '/inc/customizer.php';

require_once get_template_directory() . '/inc/disable_gutenberg.php';

require_once get_template_directory() . '/inc/remove_comements.php';

require_once get_template_directory() . '/inc/custom_settings.php';

require_once get_template_directory() . '/inc/custom_post_types.php';

require_once get_template_directory() . '/inc/custom_fields.php';

require_once get_parent_theme_file_path('/inc/walkers/class-wp-dropdown-child.php');


function is_edit_page($new_edit = null){
    global $pagenow;
    //make sure we are on the backend
    if (!is_admin()) return false;
    if($new_edit == "edit")
    return in_array( $pagenow, array( 'post.php',  ) );
    elseif($new_edit == "new") //check for new post page
    return in_array( $pagenow, array( 'post-new.php' ) );
    else //check for either new or edit
    return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
}


add_action( 'admin_enqueue_scripts', 'my_admin_enqueue_scripts' );
function my_admin_enqueue_scripts() {
    if ( 'event' == get_post_type() )
    wp_dequeue_script( 'autosave' );
}





// function TstPlg_PageDisplay() {
//     ob_start();
//         echo wp_editor('','MyTextArea');
//         $output = ob_get_contents();
//     ob_end_clean();
//
//     echo '<div class="wrap"><h2>TestPlugin</h2><p>This is a test for the TestPlugin Page</p><hr><div>';
//     echo $output;
//     echo '<hr><p>This is after</p></div></div>';
// }
// function TstPlg_AddMenuPAge() {
//   add_menu_page( 'TstPlg_PageDisplay', 'Test Plugin', 'manage_options', 'TstPlg_PageDisplay', 'TstPlg_PageDisplay');
// }
// add_action ('admin_menu', 'TstPlg_AddMenuPAge');
