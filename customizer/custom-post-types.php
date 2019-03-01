<?php


function events_init() {
    $labels = array(
        'name'               => _x( 'Events', 'whtn' ),
        'singular_name'      => _x( 'Event', 'whtn' ),
        'menu_name'          => _x( 'Events', 'whtn' ),
        'name_admin_bar'     => _x( 'Event', 'whtn' ),
        'add_new'            => _x( 'Add a new Event', 'whtn' ),
        'add_new_item'       => __( 'Add a new Event', 'whtn' ),
        'new_item'           => __( 'New Event', 'whtn' ),
        'edit_item'          => __( 'Edit Event', 'whtn' ),
        'view_item'          => __( 'View Event', 'whtn' ),
        'all_items'          => __( 'All Events', 'whtn' ),
        'search_items'       => __( 'Search Events', 'whtn' ),
        'parent_item_colon'  => __( 'Parent Event:', 'whtn' ),
        'not_found'          => __( 'No Events found.', 'whtn' ),
        'not_found_in_trash' => __( 'No Events found in Trash.', 'whtn' )
    );
    $args = array(
      'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'query_var' => true,
        'menu_icon' => 'dashicons-tickets-alt',
        'supports' => array(
            'title')
        );
    register_post_type( 'event', $args );
}
add_action( 'init', 'events_init' );

function my_admin_enqueue_scripts() {
    if ( 'event' == get_post_type() )
        wp_dequeue_script( 'autosave' );
}
add_action( 'admin_enqueue_scripts', 'my_admin_enqueue_scripts' );
