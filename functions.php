<?php
flush_rewrite_rules( false );
add_filter('use_block_editor_for_post', '__return_false');

add_action('get_header', 'my_filter_head');

function my_filter_head() {
  remove_action('wp_head', '_admin_bar_bump_cb');
}

/*
    Adding Style and Script files into the theme
*/
function customThemeEnqueues(){
    wp_enqueue_script('jquery');
    $options = get_option( 'apikey_options' );
    wp_enqueue_style('fontAwesome5', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css', array(), '1.0.0', 'all');
    wp_enqueue_script('google_jsFront', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key='.$options['apikey_field_google'].'&libraries=places', array(), '', true );
    wp_enqueue_script('momentScript', get_template_directory_uri() . '/assets/js/moment.js', array(), '1.0.0', true);

    wp_enqueue_script('popperjs', get_template_directory_uri() . '/assets/js/popper.min.js', array(), '1.0.0', true);
    wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '4.1.3', true);

    wp_enqueue_style('masterStyle', get_template_directory_uri() . '/assets/css/front/style.css', array(), '1.0.0', 'all');

    wp_enqueue_script('icalScript', get_template_directory_uri() . '/assets/js/ics.min.js', array(), '1.0.0', true);
    wp_enqueue_script('customScript', get_template_directory_uri() . '/assets/js/script.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'customThemeEnqueues', 11);

/*
    Adding style and script files into the admin for the theme
*/
function admin_my_enqueue() {

    wp_enqueue_style('fontAwesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), '1.0.0', 'all');

    wp_enqueue_style('adminStyle', get_template_directory_uri() . '/assets/css/admin/admin.css', array(), '1.0.0', 'all');
    wp_enqueue_script('momentScript', get_template_directory_uri() . '/assets/js/moment.js', array(), '1.0.0', true);

    wp_enqueue_style('datePickerStyle', get_template_directory_uri() . '/assets/datepicker/datetimepicker.css', array(), '1.0.0', 'all');
    wp_enqueue_script('datePickerScript', get_template_directory_uri() . '/assets/datepicker/datetimepicker.js', array(), '1.0.0', true);

    wp_enqueue_script('adminScript', get_template_directory_uri() . '/assets/js/admin.js', array('jquery'), '1.0.0', true);

    global $metaboxes;

    $formats = array();
    foreach ($metaboxes as $id => $metabox) {
        if($metabox['display_condition']){
            $formats[$metabox['display_condition']] = $id;
        }
    }
    wp_localize_script('adminScript', 'formats', array(
        'allFormats' => $formats,
        'directory' => get_template_directory_uri()
    ));

    $options = get_option( 'apikey_options' );
    wp_enqueue_script( 'google_js', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key='.$options['apikey_field_google'].'&libraries=places', array(), '', true );
    wp_enqueue_script('eventScript', get_template_directory_uri() . '/assets/js/eventBrite.js', array('jquery'), '1.0.0', true);

    if (is_edit_page('new')){
        wp_localize_script('eventScript', 'variables', array(
            'type' => 'new',
            'eventBriteKey' => $options['apikey_field_eventBrite'],
            'currentEventID' => ''
        ));
    } else {
        global $post;
        $id = $post->ID;
        wp_localize_script('eventScript', 'variables', array(
            'type' => 'edit',
            'eventBriteKey' => $options['apikey_field_eventBrite'],
            'currentEventID' => get_post_meta($id, 'selectEvent', true)
        ));
    }
}
add_action('admin_enqueue_scripts', 'admin_my_enqueue');

function customThemeSupport(){
    //Declares the menus which are present in the theme
    add_theme_support('menus');
    register_nav_menu('header_navigation', 'This is the main navigation at the top of the page');
    register_nav_menu('footer_navigation', 'This is the secondary navigation in the footer section of the page');

    add_theme_support( 'custom-logo', array(
        'height'      => 150,
        'width'      => 150,
        'flex-width'  => true,
        'flex-height'  => true,
    ));

    add_theme_support( 'post-formats', array('audio', 'image', 'video' , 'link') );

    add_theme_support( 'post-thumbnails' );
}
add_action('init', 'customThemeSupport');

/*
    Remove the editor on the Home Page
*/
function hide_editor() {
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    $frontID = get_option('page_on_front');

    if( !isset( $post_id ) ) return;
    if( !isset( $frontID ) ) return;


    if($frontID == $post_id){
        remove_post_type_support('page', 'editor');
        add_action( 'edit_form_after_title', 'add_warning_notice' );
    }

    function add_warning_notice(){
        echo '<div class="notice notice-warning inline">
                <p>' . __( 'You are currently editing the page that you have set as your Home Page.' ) . '</p>
                <p>' . __( 'Go to your customizer to change the message which appears on the Home Page.' ) . '</p>
            </div>';
    }

}
add_action( 'admin_init', 'hide_editor' );

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

/*
    Adding the custom settings section
*/
require get_parent_theme_file_path('/customizer/custom-settings.php');
/*
    Adding the custom post types section
*/
require get_parent_theme_file_path('/customizer/custom-post-types.php');
/*
    Adding the customize section
*/
require get_parent_theme_file_path('/customizer/custom-fields.php');
/*
    Adding the customize section
*/
require get_parent_theme_file_path('/customizer/customizer.php');
/*
    Adding Bootstrap nav walker
*/
require get_parent_theme_file_path('/customizer/walkers/class-wp-bootstrap-navwalker.php');
require get_parent_theme_file_path('/customizer/walkers/class-wp-dropdown-child.php');


// Add to existing function.php file

// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'df_disable_comments_post_types_support');

// Close comments on the front-end
function df_disable_comments_status() {
	return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function df_disable_comments_admin_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('init', 'df_disable_comments_admin_bar');

// Remove tags support from posts
function myprefix_unregister_tags() {
    unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'myprefix_unregister_tags');
